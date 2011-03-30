<?php

class Bouncer
{

    const NICE = 'nice';
    const NEUTRAL = 'neutral';
    const SUSPICIOUS = 'suspicious';
    const BAD = 'bad';

    const ROBOT = 'robot';
    const BROWSER = 'browser';
    const UNKNOWN = 'unknown';

    protected static $_prefix = '';

    protected static $_backend = 'memcache';
    protected static $_backendInstance = null;

    protected static $_challenged = false;

    public static $known_browsers = array('explorer', 'firefox', 'safari', 'chrome', 'opera');

    public static $identity_headers = array('User-Agent', 'Accept', 'Accept-Charset', 'Accept-Language', 'Accept-Encoding', 'From');

    protected static $_rules = array(
        'agent_infos' => array(),
        'ip_infos' => array(),
        'browser_identity' => array(),
        'robot_identity' => array(),
        'request' => array()
    );

    protected static $_namespaces = array(
        ''
    );

    protected static $_servers = array();

    public static function run(array $options = array())
    {
        self::setOptions($options);
        self::load();
        self::bounce();
    }

    public static function load()
    {
        require_once dirname(__FILE__) . '/Rules/Bbclone.php';
        Bouncer_Rules_Bbclone::load();
        require_once dirname(__FILE__) . '/Rules/Basic.php';
        Bouncer_Rules_Basic::load();
        require_once dirname(__FILE__) . '/Rules/Browser.php';
        Bouncer_Rules_Browser::load();
        require_once dirname(__FILE__) . '/Rules/Robot.php';
        Bouncer_Rules_Robot::load();
        require_once dirname(__FILE__) . '/Rules/Request.php';
        Bouncer_Rules_Request::load();
        require_once dirname(__FILE__) . '/Rules/Fingerprint.php';
        Bouncer_Rules_Fingerprint::load();
        require_once dirname(__FILE__) . '/Rules/Network.php';
        Bouncer_Rules_Network::load();
        require_once dirname(__FILE__) . '/Rules/Geoip.php';
        Bouncer_Rules_Geoip::load();
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

    protected static function getAddr()
    {
        $addr = $_SERVER['REMOTE_ADDR'];

        // Local Proxy
        if ($addr === '127.0.0.1' ||
            $addr == '::1' ||
            strpos($addr, '172.') === 0 ||
            strpos($addr, '192.') === 0 ||
            strpos($addr, '10.')  === 0) {
                $headers = self::getHeaders();
                if (isset($headers['X-Forwarded-For'])) {
                    return $headers['X-Forwarded-For'];
                }
        }

        // Opera Mini
        if (strpos($addr, '64.255')  === 0 ||
            strpos($addr, '80.239')  === 0 ||
            strpos($addr, '82.145')  === 0 ||
            strpos($addr, '94.246')  === 0 ||
            strpos($addr, '195.189') === 0) {
                 $headers = self::getHeaders();
                 // TODO: case insensitive, split multiple value
                 if (isset($headers['x-forwarded-for'])) {
                     return $headers['x-forwarded-for'];
                 }
         }

         return $addr;
    }

    protected static function getUserAgent()
    {
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            return $_SERVER['HTTP_USER_AGENT'];
        }
        return '';
    }

    protected static function identity()
    {
        $addr = self::getAddr();
        $user_agent = self::getUserAgent();

        $id = isset($_COOKIE['bouncer-identity']) ? $_COOKIE['bouncer-identity'] : self::hash($addr . ':' . $user_agent);

        $identity = self::backend()->getIdentity($id);

        if (isset($identity)) {
            // keep identity if agent change or ip change, but not if both change
            if ($identity['addr'] == $addr || $identity['user_agent'] == $user_agent) {
                if ($identity['addr'] != $addr) {
                    $ip = self::getIpInfos($addr);
                    $identity = array_merge($identity, $ip);
                    self::backend()->setIdentity($id, $identity);
                } else if ($identity['user_agent'] != $user_agent) {
                    $agent = self::getAgentInfos($user_agent);
                    $headers = self::getHeaders(self::$identity_headers);
                    $fingerprint = self::fingerprint($headers);
                    $identity = array_merge($identity, $agent, compact('headers', 'fingerprint'));
                    self::backend()->setIdentity($id, $identity);
                }
                return $identity;
            }
        }

        $id = isset($_COOKIE['bouncer-identity']) ? self::hash($addr . ':' . $user_agent) : $id;

        $headers = self::getHeaders(self::$identity_headers);
        $fingerprint = self::fingerprint($headers);

        $agent = self::getAgentInfos($user_agent);

        $ip = self::getIpInfos($addr);

        $identity = array_merge(compact('id', 'headers', 'fingerprint'), $agent, $ip);

        self::backend()->setIdentity($id, $identity);

        return $identity;
    }

    protected static function getAgentInfos($user_agent)
    {
        $signature = self::hash($user_agent);

        // Get From Backend
        $key = 'agent-infos-' . $signature;
        if ($agentInfos = self::get($key)) {
            return $agentInfos;
        }

        $agentInfos = array(
            'signature'  => $signature,
            'user_agent' => $user_agent,
            'name'       => 'unknown',
            'type'       => self::UNKNOWN
        );

        $rules = self::$_rules['agent_infos'];
        foreach ($rules as $func) {
            $agentInfos = call_user_func_array($func, array($agentInfos));
        }

        self::set($key, $agentInfos, (60 * 60 * 24));

        return $agentInfos;
    }


    protected static function getIpInfos($addr)
    {
        // Get From Backend
        $key = 'ip-infos-' . self::hash($addr);
        if ($ipInfos = self::get($key)) {
            return $ipInfos;
        }

        $ipInfos = array(
            'addr' => $addr,
            'host' => gethostbyaddr($addr),
        );

        $rules = self::$_rules['ip_infos'];
        foreach ($rules as $func) {
            $ipInfos = call_user_func_array($func, array($ipInfos));
        }

        self::set($key, $ipInfos, (60 * 60 * 24));

        return $ipInfos;
    }

    protected static function getHeaders($keys = array())
    {
        if (!is_callable('getallheaders')) {
            // from http://www.php.net/manual/en/function.getallheaders.php
            $headers = array();
            foreach ($_SERVER as $key => $value) {
                if (substr($key,0,5)=="HTTP_") {
                    $key = str_replace(" ","-",ucwords(strtolower(str_replace("_"," ",substr($key,5)))));
                    $headers[$key] = $value;
                }
            }
        } else {
            $headers = getallheaders();
        }
        // Filter
        if (!empty($keys)) {
            $keys = array_map('strtolower', $keys);
            foreach ($headers as $key => $value) {
                $ikey = strtolower($key);
                if (!in_array($ikey, $keys)) {
                    unset($headers[$key]);
                }
            }
        }
        return $headers;
    }

    protected static function request()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $server = $_SERVER['SERVER_NAME'];
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, '?')) {
            $split = explode('?', $uri);
            $uri = $split[0];
        }
        $headers = self::getHeaders();
        // Ignore Host + Agent headers
        $ignore = array_merge(array('Host'), self::$identity_headers);
        foreach ($ignore as $key) {
            unset($headers[$key]);
        }
        $request = compact('method', 'server', 'uri', 'headers');
        if (!empty($_GET)) {
            $request['GET'] = $_GET;
        }
        if (!empty($_POST)) {
            $request['POST'] = $_POST;
        }
        if (!empty($_COOKIE)) {
            $request['COOKIE'] = $_COOKIE;
        }
        return $request;
    }

    protected static function anonymise($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            if (empty($value)) {
                $result[$key] = '';
            } else {
                $result[$key] = sprintf("%u", crc32($value)) . '-' . strlen($value);
            }
        }
        return $result;
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

        // Release Backend Connection
        self::backend()->clean();

        // Set Bouncer Cookie
        if (empty($_COOKIE['bouncer-identity']) || $_COOKIE['bouncer-identity'] != $identity['id']) {
            setcookie('bouncer-identity', $identity['id'], time()+60*60*24*365 , '/');
        }

        // Process
        list($status, $score) = $result;
        switch ($status) {
            case self::BAD:
                $throttle = rand(1000*1000, 2000*1000);
                usleep($throttle);
                self::ban();
            case self::SUSPICIOUS:
                $throttle = rand(500*1000, 2000*1000);
                usleep($throttle);
            case self::NEUTRAL:
                if ($identity['type'] == Bouncer::ROBOT) {
                    $throttle = rand(250*1000, 1000*1000);
                    usleep($throttle);
                }
            case self::NICE:
            default:
                break;
        }
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
        if ($identity['type'] == self::ROBOT && $result[1] >= 1) {
            // don't consolidate rss-atom entries
            if ($identity['id'] != 'rss-atom') {
                $identity['id'] = $identity['name'];
            }
        }

        // Analysis resulted in a new identity id, we store it
        if ($identity['id'] != $id) {
            $id = $identity['id'];
            if (!self::getIdentity($id)) {
                self::setIdentity($id, $identity);
            }
        }

        // Additionaly parse request if result is ambigus
        if ($identity['type'] != self::ROBOT && $result[1] < 15 && $result[1] >= -15) {
            $result = self::analyseRequest($identity, $request, $result);
        } elseif ($identity['type'] == self::ROBOT && $result[1] < 1) {
            $result = self::analyseRequest($identity, $request, $result);
        }

        return array($identity, $result);
    }

    public static function analyseIdentity($identity, $request = array())
    {
        if ($identity['type'] == self::BROWSER) {
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
        } else if ($score <= -10) {
            $result = array(self::BAD, $score, $details);
        } else if ($score <= -5) {
            $result = array(self::SUSPICIOUS, $score, $details);
        } else {
            $result = array(self::NEUTRAL, $score, $details);
        }

        return $result;
    }

    protected static function log($identity, $request, $result)
    {
        $time = time();
        $agent = $identity['id'];
        $haddr = self::hash($identity['addr']);
        $fingerprint = $identity['fingerprint'];

        $connection = array();
        $connection['identity'] = $identity['id'];
        $connection['request'] = $request;
        $connection['time'] = $time;
        $connection['result'] = $result;

        // don't store connection details
        unset($connection['result'][2]);

        // Log connection
        $connectionKey = self::backend()->storeConnection($connection);

        foreach (self::$_namespaces as $ns) {
            $backend = self::backend();
            // Add agent to agents index
            $backend->indexAgent($agent, $ns);
            // Add agent to fingerprint agent index
            if (method_exists($backend, 'indexAgentFingerprint'))
                $backend->indexAgentFingerprint($agent, $fingerprint, $ns);
            // Add agent to host agent index
            if (method_exists($backend, 'indexAgentHost'))
                $backend->indexAgentHost($agent, $haddr, $ns);
            // Add connection to index
            self::backend()->indexConnection($connectionKey, $agent, $ns);
        }
    }

    protected static function ban()
    {
        header("HTTP/1.0 403 Forbidden");
        die('Forbidden');
    }

    protected static function unavailable()
    {
        header("HTTP/1.0 503 Service Unavailable");
        die('Service Unavailable');
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

    public static function ismd5($string)
    {
        return !empty($string) && preg_match('/^[a-f0-9]{32}$/', $string);
    }

    // Challenge

    public static function challenge()
    {
        if (isset($_GET['bouncer-identity']) && isset($_GET['bouncer-feature'])) {
            $id = $_GET['bouncer-identity'];
            $identity = self::backend()->getIdentity($id);
            if (isset($identity)) {
                if ($_GET['bouncer-feature'] == 'image') {
                    $identity['features']['image'] = $identity['features']['image'] + 2;
                    self::setIdentity($identity['id'], $identity);
                    header('Content-Type:image/gif');
                    echo base64_decode("R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");
                } elseif ($_GET['bouncer-feature'] == 'javascript') {
                    $identity['features']['javascript'] = $identity['features']['javascript'] + 2;
                    self::setIdentity($identity['id'], $identity);
                    header('Content-Type:image/gif');
                    echo base64_decode("R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");
                } elseif ($_GET['bouncer-feature'] == 'iframe') {
                    $identity['features']['iframe'] = $identity['features']['iframe'] + 2;
                    self::setIdentity($identity['id'], $identity);
                    header("Content-Type:text/html");
                    echo '<html><head><meta name="robots" content="noindex,nofollow"></head><body>ok cowboy</body></html>';
                } elseif ($_GET['bouncer-feature'] == 'link') {
                    $identity['features']['link'] = $identity['features']['link'] + 2;
                    self::setIdentity($identity['id'], $identity);
                    header("Content-Type:text/html");
                    echo '<html><head><meta name="robots" content="noindex,nofollow"></head><body>ok cowboy</body></html>';
                }
            }
            exit;
        }

        if (self::$_challenged == true) {
            return;
        }

        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        if ($method == 'HEAD' || $method == 'OPTIONS') {
            return;
        }

        if (isset($_SERVER['HTTP_X_MOZ'])) {
            return;
        }

        $identity = self::identity();
        if (empty($identity) || empty($identity['id'])) {
            return;
        }

        if ($identity['type'] == self::BROWSER) {
            $store = false;
            if (empty($identity['features'])) {
                $identity['features'] = array('iframe' => 0, 'javascript' => 0, 'image' => 0 /*, 'link' => 0 */);
            }
            // if (empty($identity['features']['link'])) {
            //     $identity['features']['link'] = 0;
            // }
            if ($identity['features']['image'] < 1 && $identity['features']['image'] > -5) {
                $url = '?bouncer-challenge=1&bouncer-identity=' . $identity['id']  . '&bouncer-feature=image&t=' . time();
                $style = 'position:absolute;border:0;width:1px;height:1px;left:0;top:0;background:red;';
                echo '<img style="' . $style . '" src="' . $url  . '"/>';
                $identity['features']['image'] = $identity['features']['image'] - 1;
                $store = true;
            }
            if ($identity['features']['iframe'] < 1 && $identity['features']['iframe'] > -5) {
                $url = '?bouncer-challenge=1&bouncer-identity=' . $identity['id']  . '&bouncer-feature=iframe&t=' . time();
                $style = 'position:absolute;border:0;width:1px;height:1px;left:2px;top:0;background:blue;';
                echo '<iframe style="' . $style . '" src="' . $url  . '"></iframe>';
                $identity['features']['iframe'] = $identity['features']['iframe'] - 1;
                $store = true;
            }
            if ($identity['features']['javascript'] < 1 && $identity['features']['javascript'] > -5) {
                $url = '?bouncer-challenge=1&bouncer-identity=' . $identity['id']  . '&bouncer-feature=javascript&t=' . time();
                $style = 'position:absolute;border:0;width:1px;height:1px;left:1px;top:0;background:lime;';
                echo '<script type="text/javascript">';
                echo 'document.write(\'<img style="' . $style . '" src="' . $url  . '"/>\');';
                echo '</script>';
                $identity['features']['javascript'] = $identity['features']['javascript'] - 1;
                $store = true;
            }
            // if ($identity['features']['link'] < 5 && $identity['features']['link'] > -5) {
            //     $url = '?bouncer-challenge=1&bouncer-identity=' . $identity['id']  . '&bouncer-feature=link&t=' . mktime();
            //     $style = 'display:block;position:absolute;border:0;width:1px;height:1px;left:3px;top:0;background:black;';
            //     echo '<a rel="nofollow" style="' . $style . '" href="' . $url  . '"><span style="display:none;">ok cowboy</span></a>';
            //     $identity['features']['link'] = $identity['features']['link'] - 1;
            //     $store = true;
            // }
            if ($store) {
                self::setIdentity($identity['id'], $identity);
            }
            self::$_challenged = true;
        }
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
                    self::$_backendInstance = new Bouncer_Backend_Memcache($options);
                    break;
                case 'redis':
                    require_once dirname(__FILE__) . '/Backend/Redis.php';
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
                            if (strpos($host, ':')) {
                                list($host, $port) = explode(':', $host);
                            }
                            $options['servers'][] = compact('host', 'port', 'username', 'password');
                        }
                    }
                    self::$_backendInstance = new Bouncer_Backend_Redis($options);
                    break;
            }
        }
        return self::$_backendInstance;
    }

    public static function get($key) { return self::backend()->get($key); }
    public static function set($key, $value) { return self::backend()->set($key, $value); }
    public static function getIdentity($id) { return self::backend()->getIdentity($id); }
    public static function setIdentity($id, $value) { return self::backend()->setIdentity($id, $value); }
    public static function getAgentsIndex($ns = '') { return self::backend()->getAgentsIndex($ns); }
    public static function getAgentsIndexFingerprint($fg, $ns = '') { return self::backend()->getAgentsIndexFingerprint($fg, $ns); }
    public static function getAgentsIndexHost($host, $ns = '') { return self::backend()->getAgentsIndexHost($host, $ns); }
    public static function countAgentsFingerprint($fg, $ns = '') { return self::backend()->countAgentsFingerprint($fg, $ns); }
    public static function countAgentsHost($host, $ns = '') { return self::backend()->countAgentsHost($host, $ns); }
    public static function getAgentConnections($agent, $ns = '') { return self::backend()->getAgentConnections($agent, $ns); }
    public static function getLastAgentConnection($agent, $ns = '') { return self::backend()->getLastAgentConnection($agent, $ns); }
    public static function getFirstAgentConnection($agent, $ns = '') { return self::backend()->getFirstAgentConnection($agent, $ns); }
    public static function countAgentConnections($agent, $ns = '') { return self::backend()->countAgentConnections($agent, $ns); }

    public static function stats(array $options = array())
    {
        self::setOptions($options);
        self::load();
        require_once dirname(__FILE__) . '/Stats.php';
        Bouncer_Stats::css();
        if (empty($_GET['agent']) && empty($_GET['connection']) && empty($_GET['stats'])) {
            Bouncer_Stats::search();
        }
        Bouncer_Stats::stats($options);
    }

}
