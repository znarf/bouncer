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

    protected $rules = array(
        'identity_infos'   => array(),
        'agent_infos'      => array(),
        'ip_infos'         => array(),
        'browser_identity' => array(),
        'robot_identity'   => array(),
        'request'          => array(),
    );

    /**
     * @var \Bouncer\Backend\BackendInterface
     */
    protected $backend;

    /**
     * @var \Bouncer\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $identity;

    /**
     * @var array
     */
    protected $connection;

    /**
     * @var boolean
     */
    protected $started = false;

    /**
     * @var boolean
     */
    protected $ended   = false;

    protected $namespaces = array(
        'default'
    );

    public function __construct($options = [])
    {
        $this->setOptions($options);
    }

    public function setOptions($options = [])
    {
        if (isset($options['backend'])) {
            $this->backend = $options['backend'];
        }
        if (isset($options['logger'])) {
            $this->logger = $options['logger'];
        }
        if (isset($options['namespaces'])) {
            $this->namespaces = $options['namespaces'];
        }
    }

    public function loadRules($type = null)
    {
        if ($type == 'cloud') {
            \Bouncer\Rules\Cloud::load($this);
            \Bouncer\Rules\Defaults::load($this);
        } else {
            \Bouncer\Rules\Defaults::load($this);
            \Bouncer\Rules\Bbclone::load($this);
            \Bouncer\Rules\Geoip::load($this);
        }
    }

    public function addRule($type, $function)
    {
        if (empty($this->rules[$type])) {
            $this->rules[$type] = array();
        }
        $this->rules[$type][] = $function;
    }

    public function getIdentity()
    {
        if (isset($this->identity)) {
            return $this->identity;
        }

        $backend = $this->getBackend();
        $request = $this->getRequest();

        $addr  = $request->getAddr();
        $haddr = self::hash($addr);

        $ua    = $request->getUserAgent();
        $hua   = self::hash($ua);

        $headers = $request->getHeaders(self::$identity_headers);

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
                    $identity = $this->getIdentityInfos($identity);
                    $identity = $this->getIpInfos($identity);
                    $backend->setIdentity($id, $identity);
                } elseif ($identity['hua'] != $hua) {
                    $identity['ua']  = $ua;
                    $identity['hua'] = $hua;
                    $identity['headers'] = $headers;
                    $identity = $this->getIdentityInfos($identity);
                    $identity = $this->getAgentInfos($identity);
                    $backend->setIdentity($id, $identity);
                }
                return $identity;
            }
        }

        // Build Basic Identity array
        $identity = [
            'id'      => self::hash($haddr . $hua),
            'ua'      => $ua,
            'hua'     => $hua,
            'addr'    => $addr,
            'haddr'   => $haddr,
            'headers' => $headers,
            'score'   => 0,
            'status'  => self::NEUTRAL
        ];

        // Process Rules
        $identity = $this->getIdentityInfos($identity);
        $identity = $this->getAgentInfos($identity);
        $identity = $this->getIpInfos($identity);

        // Store Identity in the Backend
        $backend->setIdentity($id, $identity);

        // Set Bouncer Cookie
        if (empty($_COOKIE['bouncer-identity']) || $_COOKIE['bouncer-identity'] != $identity['id']) {
            setcookie('bouncer-identity', $identity['id'], time()+60*60*24*365 , '/');
        }

        return $identity;
    }

    public function getBackend()
    {
        if (empty($this->backend)) {
            throw new Exception('No backend available.');
        }

        return $this->backend;
    }

    public function getRequest()
    {
        if (isset($this->request)) {
            return $this->request;
        }

        $request = Request::createFromGlobals();

        return $this->request = $request;
    }

    public function getLogger()
    {
        if (empty($this->logger)) {
            // Use Backend as alternative?
            throw new Exception('No logger available.');
        }

        return $this->logger;
    }

    public function getConnection()
    {
        if (!$this->started) {
            // This will init connection
            $this->start();
        }

        return $this->connection;
    }

    protected function getInfos($ruleset, $identity)
    {
        $rules = $this->rules[$ruleset];
        foreach ($rules as $func) {
            $identity = call_user_func_array($func, array($identity));
        }
        return $identity;
    }

    protected function getIdentityInfos($identity)
    {
        return $this->getInfos('identity_infos', $identity);
    }

    protected function getIpInfos($identity)
    {
        return $this->getInfos('ip_infos', $identity);
    }

    protected function getAgentInfos($identity)
    {
        return $this->getInfos('agent_infos', $identity);
    }

    public function run(array $options = array(), $type = 'default')
    {
        $this->start();

        $this->setOptions($options);

        $this->loadRules($type);

        // Get Identity (likely from Cache, if not Process the rules)
        $identity = $this->getIdentity();

        // TODO: should now perform a scoring of the Request with Rules
        if ($identity['score'] >= 10) {
            $identity['status'] = self::NICE;
        } elseif ($identity['score'] <= -10) {
            $identity['status'] = self::BAD;
        } elseif ($identity['score'] <= -5) {
            $identity['status'] = self::SUSPICIOUS;
        } else {
            $identity['status'] = self::NEUTRAL;
        }

        // Exit with a 503, or slow down by sleeping
        $this->throttle();

        // Register End
        register_shutdown_function([$this, 'end'], true);
    }

    public function start()
    {
        // Already started, skip
        if ($this->started === true) {
            return;
        }

        if (empty($this->connection)) {
            $this->connection = [];
        }
        if (empty($this->connection['id'])) {
            $this->connection['id'] = uniqid();
        }
        if (empty($this->connection['time'])) {
            $this->connection['time'] = time();
        }
        if (empty($this->connection['start'])) {
            $this->connection['start'] = microtime(true);
        }

        $this->started = true;
    }

    public function throttle()
    {
        $identity = $this->getIdentity();

        switch ($identity['status']) {
            case self::BAD:
                // sleep 1 to 2 seconds then exit
                $throttle = rand(1000*1000, 2000*1000);
                usleep($throttle);
                $this->connection['throttle_time'] = round($throttle / 1000000, 3);
                $this->unavailable();
                break;
            case self::SUSPICIOUS:
                // sleep 0.5 to 2 seconds then continue
                $throttle = rand(500*1000, 2000*1000);
                usleep($throttle);
                $this->connection['throttle_time'] = round($throttle / 1000000, 3);
                break;
            case self::NEUTRAL:
                if ($identity['agent_type'] == self::ROBOT) {
                    $throttle = rand(250*1000, 1000*1000);
                    usleep($throttle);
                    $this->connection['throttle_time'] = round($throttle / 1000000, 3);
                }
                break;
            case self::NICE:
            default:
                break;
        }
    }

    public function end($close = false)
    {
        // Already ended, skip
        if ($this->ended === true) {
            return;
        }

        // $connection = $this->getConnection();

        // Add Performance data to the Connection
        $this->connection['end'] = microtime(true);
        $this->connection['memory_usage'] = memory_get_peak_usage();
        $this->connection['response_status'] = http_response_code();
        $this->connection['exec_time'] = round($this->connection['end'] - $this->connection['start'], 4);
        if (!empty($this->connection['throttle_time'])) {
             $this->connection['exec_time'] -= $this->connection['throttle_time'];
        }

        try {
            // Store the Connection
            $this->log();
            // Release Backend Connection
            if ($close) {
                $this->getBackend()->close();
            }
        } catch (Exception $e) {
            // Log Message
        }

        $this->ended = true;
    }

    protected function log($connection = null, $identity = null, $request = null)
    {
        if (empty($connection)) {
            $connection = $this->getConnection();
        }
        if (empty($identity)) {
            $identity = $this->getIdentity();
        }
        if (empty($request)) {
            $request = $this->getRequest();
        }

        $message = $request->__toString();

        $values = [];
        $values['connection'] = $connection;
        $values['request']    = $request->toArray();
        $values['identity']   = $identity;

        // $connection['identity'] = $this->getIdentity();
        // $connection['request'] = $this->getRequest()->toArray();

        // Log request
        $this->getLogger()->log($message, $values);
        // $this->getBackend()->storeConnection($connection);

        // Index Identity + Connection
        foreach ($this->namespaces as $namespace) {
            // Identity
            $this->indexIdentity($identity, $namespace);
            // Connection
            // $this->indexConnection($connection, $identity, $namespace);
            // Connection Extra
            // $this->indexConnectionExtra($connection, $namespace);
        }
    }

    // Index

    protected function indexIdentity($identity, $namespace = null)
    {
        $backend = $this->getBackend();

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

    protected function indexConnection($connection, $identity, $namespace = null)
    {
        $backend = $this->getBackend();

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

    protected function indexConnectionExtra($connection, $namespace = null)
    {
        $backend = self::getBackend();

        // Index non 200 queries
        if (isset($connection['code']) && $connection['code'] != 200) {
          $not200IndexKey = empty($namespace) ? "connections-not200" : "connections-not200-$namespace";
          $backend->indexConnectionWithIndexKey($not200IndexKey, $connection['id']);
        }
        // Index non GET queries
        if (isset($connection['method']) && $connection['method'] != 'GET') {
          $notGetIndexKey = empty($namespace) ? "connections-notGET" : "connections-notGET-$namespace";
          $backend->indexConnectionWithIndexKey($notGetIndexKey, $connection['id']);
        }
        // Index slow & very slow queries
        if (isset($connection['exec_time']) && $connection['exec_time'] >= 0.25) {
          $slowIndexKey = empty($namespace) ? "connections-slow" : "connections-slow-$namespace";
          $backend->indexConnectionWithIndexKey($slowIndexKey, $connection['id']);
          if ($connection['exec_time'] >= 2.5) {
            $verySlowIndexKey = empty($namespace) ? "connections-veryslow" : "connections-veryslow-$namespace";
            $backend->indexConnectionWithIndexKey($verySlowIndexKey, $connection['id']);
          }
        }
    }

    // Backend Shortcuts

    protected function get($key)
    {
        return $this->getBackend()->get($key);
    }

    protected function set($key, $value)
    {
        return $this->getBackend()->set($key, $value);
    }

    // Response Helpers

    public function ban()
    {
        $code = '403';
        $msg = 'Forbidden';
        header("HTTP/1.0 $code $msg");
        header("Status: $code $msg");
        echo $msg;
        $this->end();
        exit;
    }

    public function unavailable()
    {
        $code = '503';
        $msg = 'Service Unavailable';
        header("HTTP/1.0 $code $msg");
        header("Status: $code $msg");
        echo $msg;
        $this->end();
        exit;
    }

    // Static

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

}
