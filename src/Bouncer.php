<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer;

class Bouncer
{

    const NICE       = 'nice';
    const NEUTRAL    = 'neutral';
    const SUSPICIOUS = 'suspicious';
    const BAD        = 'bad';

    const ROBOT      = 'robot';
    const BROWSER    = 'browser';
    const UNKNOWN    = 'unknown';

    protected static $backend;

    protected static $started = false;

    protected static $ended = false;

    protected static $_throttle = 0;

    protected static $request;

    public static $known_browsers = array(
        'explorer',
        'firefox',
        'safari',
        'chrome',
        'opera',
    );

    public static $identity_headers = array(
        'User-Agent',
        'Accept',
        'Accept-Charset',
        'Accept-Language',
        'Accept-Encoding',
        'From',
        'Dnt',
    );

    protected static $_rules = array(
        'identity_infos'   => array(),
        'agent_infos'      => array(),
        'ip_infos'         => array(),
        'browser_identity' => array(),
        'robot_identity'   => array(),
        'request'          => array(),
    );

    protected static $namespaces = array(
        'default'
    );

    protected static $_connection = null;

    protected static $_connectionKey = null;

    public function __construct($backend = null)
    {
        if ($backend) {
            self::$backend = $backend;
        }
    }

    public static function setOptions(array $options = array())
    {
        if (isset($options['namespaces'])) {
            self::$namespaces = $options['namespaces'];
        }
    }

    public static function getBackend()
    {
        if (empty(self::$backend)) {
            throw new Exception('No backend available.');
        }
        return self::$backend;
    }

    public static function run(array $options = array(), $type = 'default')
    {
        static::start();
        static::setOptions($options);
        if ($type == 'cloud') {
            \Bouncer\Rules\Cloud::load();
            \Bouncer\Rules\Defaults::load();
        } else {
            \Bouncer\Rules\Defaults::load();
            \Bouncer\Rules\Bbclone::load();
            \Bouncer\Rules\Geoip::load();
            \Bouncer\Rules\Browser::load();
            \Bouncer\Rules\Robot::load();
            \Bouncer\Rules\Request::load();
            \Bouncer\Rules\Fingerprint::load();
        }
        static::bounce();
    }

     /* Identity Management */

    public static function getIdentity()
    {
        $backend = self::getBackend();

        $addr  = self::getRequest()->getAddr();
        $haddr = self::hash($addr);

        $ua    = self::getRequest()->getUserAgent();
        $hua   = self::hash($ua);

        $headers = self::getRequest()->getHeaders(self::$identity_headers);

        $id = isset($_COOKIE['bouncer-identity']) ? $_COOKIE['bouncer-identity'] : self::hash($haddr . $hua);

        // Try to get identity from the backend
        $identity = $backend->getIdentity($id);

        // Identity already registered in the backend
        if (!empty($identity)) {
            // Keep identity if 'ua' or 'addr' change, but not if both change
            if ($identity['haddr'] == $haddr || $identity['hua'] == $hua) {
                if ($identity['haddr'] != $haddr) {
                    $identity['addr']  = $addr;
                    $identity['haddr'] = $haddr;
                    $identity = self::getIdentityInfos($identity);
                    $identity = self::getIpInfos($identity);
                    $backend->setIdentity($id, $identity);
                } elseif ($identity['hua'] != $hua) {
                    $identity['ua']  = $ua;
                    $identity['hua'] = $hua;
                    $identity['headers'] = $headers;
                    $identity = self::getIdentityInfos($identity);
                    $identity = self::getAgentInfos($identity);
                    $backend->setIdentity($id, $identity);
                }
                return $identity;
            }
        }

        // Build Basic Identity array
        $identity = array(
            'id'      => self::hash($haddr . $hua),
            'ua'      => $ua,
            'hua'     => $hua,
            'addr'    => $addr,
            'haddr'   => $haddr,
            'headers' => $headers,
        );

        // Process Rules
        $identity = self::getIdentityInfos($identity);
        $identity = self::getAgentInfos($identity);
        $identity = self::getIpInfos($identity);

        // Store Identity in the Backend
        $backend->setIdentity($id, $identity);

        return $identity;
    }

    protected static function getInfos($ruleset, $identity)
    {
        $rules = self::$_rules[$ruleset];
        foreach ($rules as $func) {
            $identity = call_user_func_array($func, array($identity));
        }
        return $identity;
    }

    protected static function getIdentityInfos($identity)
    {
        return self::getInfos('identity_infos', $identity);
    }

    protected static function getAgentInfos($identity)
    {
        return self::getInfos('agent_infos', $identity);
    }

    protected static function getIpInfos($identity)
    {
        return self::getInfos('ip_infos', $identity);
    }

    public static function getRequest()
    {
        if (isset(self::$request)) {
            return self::$request;
        }

        $request = Request::createFromGlobals();

        return self::$request = $request;
    }

    public static function bounce()
    {
        $identity = self::getIdentity();

        if (empty($identity) || empty($identity['id'])) {
            return;
        }

        $request = self::getRequest()->toArray();

        // Analyse Identity
        list($identity, $result) = self::analyse($identity, $request);

        // Log Connection
        // (should only be done at the end, right ?)
        self::log($identity, $request, $result);

        // Set Bouncer Cookie
        if (empty($_COOKIE['bouncer-identity']) || $_COOKIE['bouncer-identity'] != $identity['id']) {
            setcookie('bouncer-identity', $identity['id'], time()+60*60*24*365 , '/');
        }

        // Process
        list($status, $score) = $result;
        switch ($status) {
            case self::BAD:
                $throttle = rand(1000*1000, 2000*1000);
                self::$_throttle = $throttle;
                usleep($throttle);
                static::unavailable();
                break;
            case self::SUSPICIOUS:
                $throttle = rand(500*1000, 2000*1000);
                self::$_throttle = $throttle;
                usleep($throttle);
                break;
            case self::NEUTRAL:
                if ($identity['agent_type'] == self::ROBOT) {
                    $throttle = rand(250*1000, 1000*1000);
                    self::$_throttle = $throttle;
                    usleep($throttle);
                }
                break;
            case self::NICE:
            default:
                break;
        }

        // End
        register_shutdown_function(array('\Bouncer\Bouncer', 'end'));
    }

    protected static function analyse($identity, $request)
    {
        // Initial identity id
        $id = $identity['id'];

        // Analyse Agent Identity Infos
        $analyseCacheKey = 'analyse-' . $id;
        if (!$result = self::get($analyseCacheKey)) {
            list($identity, $result) = self::analyseIdentity($identity);
            self::set($analyseCacheKey, $result, (60 * 60 * 12));
        }

        // Consolidate bots IDs
        if ($identity['agent_type'] == self::ROBOT && $result[1] >= 1) {
            // don't consolidate rss-atom entries
            if ($identity['id'] != 'rss-atom') {
                $identity['id'] = $identity['agent_name'];
            }
        }

        // Analysis resulted in a new identity id, we store it
        if ($identity['id'] != $id) {
            $id = $identity['id'];
            if (!self::getBackend()->getIdentity($id)) {
                self::getBackend()->setIdentity($id, $identity);
            }
        }

        // Additionaly parse request if result is ambigous
        if ($identity['agent_type'] != self::ROBOT && $result[1] < 15 && $result[1] >= -15) {
            $result = self::analyseRequest($identity, $request, $result);
        } elseif ($identity['agent_type'] == self::ROBOT && $result[1] < 1) {
            $result = self::analyseRequest($identity, $request, $result);
        }

        return array($identity, $result);
    }

    public static function analyseIdentity($identity, $request = array())
    {
        if ($identity['agent_type'] == self::BROWSER) {
            $rules = self::$_rules['browser_identity'];
        } else {
            $rules = self::$_rules['robot_identity'];
        }
        $result = self::processRules($rules, $identity, $request);
        return array($identity, $result);
    }

    public static function analyseRequest($identity, $request, $result = array())
    {
        $rules = self::$_rules['request'];
        $result = self::processRules($rules, $identity, $request, $result);
        return $result;
    }

    public static function addRule($type, $function)
    {
        if (empty(self::$_rules[$type])) {
            self::$_rules[$type] = array();
        }
        self::$_rules[$type][] = $function;
    }

    public static function processRules($rules, $identity, $request, $result = array())
    {
        if (empty($result)) {
            $result = array(self::NEUTRAL, 0, array());
        }

        list($status, $score, $details) = $result;

        foreach ($rules as $func) {
            $scores = call_user_func_array($func, array($identity, $request));
            if (isset($scores) && is_array($scores)) {
                foreach ($scores as $detail) {
                    $details[] = $detail;
                    list($value, $message) = $detail;
                    $score += $value;
                }
            }
        }

        if ($score >= 10) {
            $result = array(self::NICE, $score, $details);
        } elseif ($score <= -10) {
            $result = array(self::BAD, $score, $details);
        } elseif ($score <= -5) {
            $result = array(self::SUSPICIOUS, $score, $details);
        } else {
            $result = array(self::NEUTRAL, $score, $details);
        }

        return $result;
    }

    protected static function log($identity, $request, $result)
    {
        $connection = $request;
        $connection['identity'] = $identity['id'];
        $connection['time']     = time();
        $connection['start']    = microtime(true);
        $connection['status']   = $result[0];
        $connection['score']    = $result[1];

        // Log connection
        self::$_connection = $connection;
        self::$_connectionKey = $connection['id'] = self::getBackend()->storeConnection($connection);

        // Index Identity + Connection
        foreach (self::$namespaces as $namespace) {
            // Identity
            $this->indexIdentity($identity, $namespace);
            // Connection
            $this->indexConnection($connection, $identity, $namespace);
        }
    }

    protected static function indexIdentity($identity, $namespace = null)
    {
        $backend = self::getBackend();

        // Add agent/identity to global index
        if (method_exists($backend, 'indexAgent')) {
            $backend->indexAgent($identity['id'], $namespace);
        }
        // Add agent/identity to fingerprint index
        if (method_exists($backend, 'indexAgentFingerprint')) {
            $backend->indexAgentFingerprint($identity['id'], $identity['fingerprint'], $namespace);
        }
        // Add agent/identity to ua index
        if (method_exists($backend, 'indexAgentUa')) {
            $backend->indexAgentUa($identity['id'], $identity['hua'], $namespace);
        }
        // Add agent/identity to addr/host index
        if (method_exists($backend, 'indexAgentHost')) {
            $backend->indexAgentHost($identity['id'], $identity['haddr'], $namespace);
        }
    }

    protected static function indexConnection($connection, $identity, $namespace = null)
    {
        $backend = self::getBackend();

        // Add connection to global index
        if (method_exists($backend, 'indexConnection')) {
            $backend->indexConnection($connection['id'], $namespace);
        }
        // Add connection to agent/identity index
        if (method_exists($backend, 'indexConnectionAgent')) {
            $backend->indexConnectionAgent($connection['id'], $identity['id'], $namespace);
        }
        // Add connection to addr/host index
        if (method_exists($backend, 'indexConnectionHost')) {
            $backend->indexConnectionHost($connection['id'], $identity['haddr'], $namespace);
        }
    }

    protected static function indexConnectionExtra($connectionKey, $connection, $namespace = null)
    {
        $backend = self::getBackend();

        // Index non 200 queries
        if (isset($connection['code']) && $connection['code'] != 200) {
          $not200IndexKey = empty($namespace) ? "connections-not200" : "connections-not200-$namespace";
          $backend->indexConnectionWithIndexKey($not200IndexKey, $connectionKey);
        }
        // Index non GET queries
        if (isset($connection['method']) && $connection['method'] != 'GET') {
          $notGetIndexKey = empty($namespace) ? "connections-notGET" : "connections-notGET-$namespace";
          $backend->indexConnectionWithIndexKey($notGetIndexKey, $connectionKey);
        }
        // Index slow & very slow queries
        if (isset($connection['exec_time']) && $connection['exec_time'] >= 0.25) {
          $slowIndexKey = empty($namespace) ? "connections-slow" : "connections-slow-$namespace";
          $backend->indexConnectionWithIndexKey($slowIndexKey, $connectionKey);
          if ($connection['exec_time'] >= 2.5) {
            $verySlowIndexKey = empty($namespace) ? "connections-veryslow" : "connections-veryslow-$namespace";
            $backend->indexConnectionWithIndexKey($verySlowIndexKey, $connectionKey);
          }
        }
    }

    protected static function ban()
    {
        $code = '403';
        $msg = 'Forbidden';
        header("HTTP/1.0 $code $msg");
        header("Status: $code $msg");
        echo $msg;
        self::end();
        exit;
    }

    protected static function unavailable()
    {
        $code = '503';
        $msg = 'Service Unavailable';
        header("HTTP/1.0 $code $msg");
        header("Status: $code $msg");
        echo $msg;
        self::end();
        exit;
    }

    public static function start()
    {
        // Already started (skip it)
        if (self::$started === true) {
            return;
        }

        self::$started = true;
        self::$_connection['start'] = microtime(true);
    }

    public static function end()
    {
        // Already ended (skip it)
        if (self::$ended === true) {
            return;
        }

        // Connection not available (run failed)
        if (empty(self::$_connection)) {
          return;
        }

        self::$_connection['end'] = microtime(true);
        self::$_connection['exec_time'] = round(self::$_connection['end'] - self::$_connection['start'] - (self::$_throttle / 1000000), 3);
        self::$_connection['memory'] = memory_get_peak_usage();
        self::$_connection['code'] = http_response_code();

        try {
          self::getBackend()->set("connection-" . self::$_connectionKey, self::$_connection);
          foreach (self::$namespaces as $ns) {
            self::indexConnectionExtra(self::$_connectionKey, self::$_connection, $ns);
          }
          self::getBackend()->close();
        } catch (Exception $e) {
        }

        self::$ended = true;
    }

    // Utils

    public static function fingerprint($array)
    {
        ksort($array);
        $string = '';
        foreach ($array as $key => $value) {
            $string .= "$key:$value;";
        }
        return self::hash($string);
    }

    public static function hash($string)
    {
        return md5($string);
    }

    // Challenge

    public static function challenge()
    {
        Challenge::challenge();
    }

    // Backend Shortcuts

    public static function get($key)
    {
        return self::getBackend()->get($key);
    }

    public static function set($key, $value)
    {
        return self::getBackend()->set($key, $value);
    }

    // Stats

    public static function stats(array $options = array())
    {
        static::setOptions($options);
        static::load();
        Stats::setOptions($options);
        Stats::css();
        if (empty($_GET['agent']) && empty($_GET['connection']) && empty($_GET['stats'])) {
            Stats::search();
        }
        Stats::stats();
    }

}
