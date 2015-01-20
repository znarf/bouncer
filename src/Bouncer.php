<?php

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

    protected static $_prefix = '';

    protected static $_backend = 'memcache';
    protected static $_backendInstance = null;

    protected static $_ended = false;

    protected static $_throttle = 0;

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

    protected static $_namespaces = array(
        ''
    );

    protected static $_servers = array();

    protected static $_connection = null;

    protected static $_connectionKey = null;

    public static function run(array $options = array(), $type = 'default')
    {
        static::setOptions($options);
        if ($type == 'cloud') {
            require_once dirname(__FILE__) . '/Rules/Cloud.php';
            \Bouncer\Rules\Cloud::load();
            require_once dirname(__FILE__) . '/Rules/Defaults.php';
            \Bouncer\Rules\Defaults::load();
        } else {
            static::load();
        }
        static::bounce();
    }

    public static function load()
    {
        require_once dirname(__FILE__) . '/Rules/Defaults.php';
        \Bouncer\Rules\Defaults::load();
        require_once dirname(__FILE__) . '/Rules/Bbclone.php';
        \Bouncer\Rules\Bbclone::load();
        require_once dirname(__FILE__) . '/Rules/Geoip.php';
        \Bouncer\Rules\Geoip::load();
        require_once dirname(__FILE__) . '/Rules/Browser.php';
        \Bouncer\Rules\Browser::load();
        require_once dirname(__FILE__) . '/Rules/Robot.php';
        \Bouncer\Rules\Robot::load();
        require_once dirname(__FILE__) . '/Rules/Request.php';
        \Bouncer\Rules\Request::load();
        require_once dirname(__FILE__) . '/Rules/Fingerprint.php';
        \Bouncer\Rules\Fingerprint::load();
    }

    public static function setOptions(array $options = array())
    {
        if (isset($options['prefix'])) {
            self::$_prefix = $options['prefix'];
        }
        if (isset($options['backend'])) {
            self::$_backend = $options['backend'];
        }
        if (isset($options['namespaces'])) {
            self::$_namespaces = $options['namespaces'];
        }
        if (isset($options['servers'])) {
            self::$_servers = $options['servers'];
        }
    }

    public static function isAddrPublic($addr)
    {
        if ($addr === '127.0.0.1' || $addr == '::1') {
            return false;
        } elseif (strpos($addr, '172.') === 0 || strpos($addr, '192.') === 0 || strpos($addr, '10.') === 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function getAddr()
    {
        $addr = $_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $forwarded_for = array_map('trim', explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
            $forwarded_for = array_filter($forwarded_for, array('self', 'isAddrPublic'));
            $forwarded_for = array_diff($forwarded_for, array($addr));
        }

        // Non-Public Address
        if (!self::isAddrPublic($addr)) {
            if (!empty($forwarded_for)) {
                $addr = array_pop($forwarded_for);
            }
        }

        // Trusted Proxies (example)
        if ($addr == '78.109.84.222') {
            if (!empty($forwarded_for)) {
                $addr = array_pop($forwarded_for);
            }
        }

        return $addr;
    }

    public static function identity()
    {
        $addr  = self::getAddr();
        $haddr = self::hash($addr);

        $ua    = self::getUserAgent();
        $hua   = self::hash($ua);

        $headers = self::getHeaders(self::$identity_headers);

        $id = isset($_COOKIE['bouncer-identity']) ? $_COOKIE['bouncer-identity'] : self::hash($haddr . $hua);

        // Get identity from Backend
        $identity = self::backend()->getIdentity($id);

        // Identity already registered in the backend
        if (!empty($identity)) {
            // Keep identity if 'ua' or 'addr' change, but not if both change
            if ($identity['addr'] == $addr || $identity['ua'] == $ua) {
                if ($identity['addr'] != $addr) {
                    $identity['addr'] = $addr;
                    $identity = self::getIdentityInfos($identity);
                    $identity = self::getAgentInfos($identity);
                    self::backend()->setIdentity($id, $identity);
                } elseif ($identity['ua'] != $ua) {
                    $identity['ua'] = $ua;
                    $identity['headers'] = $headers;
                    $identity = self::getIdentityInfos($identity);
                    $identity = self::getAgentInfos($identity);
                    self::backend()->setIdentity($id, $identity);
                }
                return $identity;
            }
        }

        // Build Identity
        $identity = array(
            'id'      => self::hash($haddr . $hua),
            'ua'      => $ua,
            'hua'     => $hua,
            'addr'    => $addr,
            'haddr'   => $haddr,
            'headers' => $headers,
        );

        $identity = self::getIdentityInfos($identity);
        $identity = self::getAgentInfos($identity);
        $identity = self::getIpInfos($identity);

        // Store Identity in the Backend
        self::backend()->setIdentity($id, $identity);

        return $identity;
    }

    protected static function getIdentityInfos($identity)
    {
        $rules = self::$_rules['identity_infos'];
        foreach ($rules as $func) {
            $identity = call_user_func_array($func, array($identity));
        }
        return $identity;
    }

    protected static function getAgentInfos($identity)
    {
        $rules = self::$_rules['agent_infos'];
        foreach ($rules as $func) {
            $identity = call_user_func_array($func, array($identity));
        }
        return $identity;
    }

    protected static function getIpInfos($identity)
    {
        $rules = self::$_rules['ip_infos'];
        foreach ($rules as $func) {
            $identity = call_user_func_array($func, array($identity));
        }
        return $identity;
    }

    public static function getHeader($name)
    {
        $key = 'HTTP_' . str_replace('-', '_', strtoupper($name));
        return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
    }

    public static function getAllHeaders($ignore = array())
    {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                if (!in_array($key, $ignore)) {
                    $headers[$key] = $value;
                }
            }
        }
        return $headers;
    }

    public static function getHeaders($names = array())
    {
        $headers = array();
        foreach ($names as $name) {
            $headers[$name] = self::getHeader($name);
        }
        return array_filter($headers);
    }

    public static function getUserAgent()
    {
        $userAgent = self::getHeader('User-Agent');
        return $userAgent ? $userAgent : '';
    }

    protected static function request()
    {
        $request = array();
        $request['method'] = strtoupper($_SERVER['REQUEST_METHOD']);
        $request['server'] = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        // Uri
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, '?')) {
            $split = explode('?', $uri);
            $request['uri'] = $split[0];
        } else {
            $request['uri'] = $uri;
        }
        // Headers
        $ignore = array_merge(array('Host', 'Cookie'), self::$identity_headers);
        $request['headers'] = self::getAllHeaders($ignore);
        // Parameters
        if (!empty($_GET)) {
            $request['get'] = array_keys($_GET);
        }
        if (!empty($_POST)) {
            $request['post'] = array_keys($_POST);
        }
        if (!empty($_COOKIE)) {
            $request['cookie'] = array_keys($_COOKIE);
        }
        return $request;
    }

    public static function bounce()
    {
        if (isset($_GET['bouncer-challenge'])) {
            self::challenge();
            return;
        }

        $identity = self::identity();
        if (empty($identity) || empty($identity['id'])) {
            return;
        }

        $request = self::request();

        // Analyse Identity
        list($identity, $result) = self::analyse($identity, $request);

        // Log Connection
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
            if (!self::getIdentity($id)) {
                self::setIdentity($id, $identity);
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
        self::$_connectionKey = self::backend()->storeConnection($connection);

        // For Indexing
        $agent       = $identity['id'];
        $hua         = $identity['hua'];
        $haddr       = $identity['haddr'];
        $fingerprint = $identity['fingerprint'];

        // Index
        foreach (self::$_namespaces as $ns) {
            $backend = self::backend();
            // Add agent to global index
            if (method_exists($backend, 'indexAgent')) {
                $backend->indexAgent($agent, $ns);
            }
            // Add agent to fingerprint index
            if (method_exists($backend, 'indexAgentFingerprint')) {
                $backend->indexAgentFingerprint($agent, $fingerprint, $ns);
            }
            // Add agent to ua index
            if (method_exists($backend, 'indexAgentUa')) {
                $backend->indexAgentUa($agent, $hua, $ns);
            }
            // Add agent to addr/host index
            if (method_exists($backend, 'indexAgentHost')) {
                $backend->indexAgentHost($agent, $haddr, $ns);
            }
            // Add connection to global index
            // AND add connection to agent index
            if (method_exists($backend, 'indexConnection')) {
                $backend->indexConnection(self::$_connectionKey, $agent, $ns);
            }
            // Add connection to addr/host index
            if (method_exists($backend, 'indexConnectionHost')) {
                $backend->indexConnectionHost(self::$_connectionKey, $haddr, $ns);
            }
        }
    }

    protected static function indexConnectionExtra($connectionKey, $connection, $ns = '')
    {
        // Index non 200 queries
        if (isset($connection['code']) && $connection['code'] != 200) {
          $not200IndexKey = empty($ns) ? "connections-not200" : "connections-not200-$ns";
          self::backend()->indexConnectionWithIndexKey($not200IndexKey, $connectionKey);
        }
        // Index non GET queries
        if (isset($connection['method']) && $connection['method'] != 'GET') {
          $notGetIndexKey = empty($ns) ? "connections-notGET" : "connections-notGET-$ns";
          self::backend()->indexConnectionWithIndexKey($notGetIndexKey, $connectionKey);
        }
        // Index slow & very slow queries
        if (isset($connection['exec_time']) && $connection['exec_time'] >= 0.25) {
          $slowIndexKey = empty($ns) ? "connections-slow" : "connections-slow-$ns";
          self::backend()->indexConnectionWithIndexKey($slowIndexKey, $connectionKey);
          if ($connection['exec_time'] >= 2.5) {
            $verySlowIndexKey = empty($ns) ? "connections-veryslow" : "connections-veryslow-$ns";
            self::backend()->indexConnectionWithIndexKey($verySlowIndexKey, $connectionKey);
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

    public static function end()
    {
        // Already ended (skip it)
        if (self::$_ended === true) {
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
          self::backend()->set("connection-" . self::$_connectionKey, self::$_connection);
          foreach (self::$_namespaces as $ns) {
            self::indexConnectionExtra(self::$_connectionKey, self::$_connection, $ns);
          }
          self::backend()->clean();
        } catch (Exception $e) {
        }

        self::$_ended = true;
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
        require_once dirname(__FILE__) . '/Challenge.php';
        Challenge::challenge();
    }

    // Backend

    public static function backend()
    {
        if (empty(self::$_backendInstance)) {
            switch (self::$_backend) {
                case 'memcache':
                    require_once dirname(__FILE__) . '/Backend/Memcache.php';
                    $options = array('prefix' => self::$_prefix);
                    if (!empty(self::$_servers)) {
                        $options['servers'] = self::$_servers;
                    }
                    self::$_backendInstance = new \Bouncer\Backend\Memcache($options);
                    break;
                case 'redis':
                case 'phpredis':
                    $options = array('namespace' => self::$_prefix);
                    if (!empty(self::$_servers)) {
                        $options['servers'] = array();
                        foreach (self::$_servers as $host) {
                            if (strpos($host, '@')) {
                                list($password, $host) = explode('@', $host);
                                if (strpos($password, ':')) {
                                    list($username, $password) = explode(':', $password);
                                }
                            }
                            $port = 6379;
                            if (strpos($host, ':')) {
                                list($host, $port) = explode(':', $host);
                            }
                            $timeout = 1;
                            $readTimeout = 1;
                            $options['servers'][] = compact('host', 'port', 'username', 'password', 'timeout', 'readTimeout');
                        }
                    }
                    require_once dirname(__FILE__) . '/Backend/PhpRedis.php';
                    self::$_backendInstance = new \Bouncer\Backend\PhpRedis($options);
                    break;
            }
        }
        return self::$_backendInstance;
    }

    public static function get($key)
    {
        return self::backend()->get($key);
    }

    public static function set($key, $value)
    {
        return self::backend()->set($key, $value);
    }

    public static function getIdentity($id)
    {
        return self::backend()->getIdentity($id);
    }

    public static function setIdentity($id, $value)
    {
        return self::backend()->setIdentity($id, $value);
    }

    // Stats

    public static function stats(array $options = array())
    {
        static::setOptions($options);
        static::load();
        require_once dirname(__FILE__) . '/Stats.php';
        Stats::setOptions($options);
        Stats::css();
        if (empty($_GET['agent']) && empty($_GET['connection']) && empty($_GET['stats'])) {
            Stats::search();
        }
        Stats::stats();
    }

}
