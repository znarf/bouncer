<?php

class Bouncer_Backend_Memcache
{

    protected static $_prefix = null;

    protected static $_servers = array('127.0.0.1');

    public static $memcache = null;

    private static $cache = array();

    public function __construct(array $options = array())
    {
        if (isset($options['prefix'])) {
            self::$_prefix = $options['prefix'];
        }
        if (isset($options['servers'])) {
            self::$_servers = $options['servers'];
        }
    }

    public static function memcache()
    {
        if (empty(self::$memcache)) {
            if (class_exists('Memcache')) {
                $memcache = new Memcache();
            } elseif (class_exists('Memcached')) {
                $memcache = new Memcached();
            }
            if (isset($memcache)) {
                foreach (self::$_servers as $server) {
                    $server = trim($server);
                    if (strpos($server, ':')) {
                        list($server, $port) = explode(':', $server);
                    }
                    $port = empty($port) ? 11211 : intval($port);
                    $memcache->addServer($server, $port);
                }
                self::$memcache = $memcache;
            }
        }
        return self::$memcache;
    }

    public static function api()
    {
        $memcache = self::memcache();
        if ($memcache instanceof Memcached) {
            return 'memcached';
        }
        return 'memcache';
    }

    public static function clean()
    {
        if (isset(self::$memcache)) {
            if (self::api() == 'memcache') {
                self::$memcache->close();
            }
            self::$memcache = null;
        }
    }

    public static function get($key)
    {
        $memcache = self::memcache();
        if (empty($memcache)) {
            return false;
        }
        if (!empty(self::$_prefix)) {
            $key = self::$_prefix . '-' . $key;
        }
        if (empty(self::$cache[$key])) {
            self::$cache[$key] = $memcache->get($key);
        }
        return self::$cache[$key];
    }

    public static function set($key, $value, $expire = 0)
    {
        $memcache = self::memcache();
        if (empty($memcache)) {
            return false;
        }
        if (!empty(self::$_prefix)) {
            $key = self::$_prefix . '-' . $key;
        }
        self::$cache[$key] = $value;
        if (self::api() == 'memcache') {
            return $memcache->set($key, $value, null, $expire);
        }
        return $memcache->set($key, $value, $expire);
    }

    public static function indexAgent($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";

        // Index agent
        $agents = self::get($indexKey);
        if (empty($agents)) {
            $agents = array();
        }
        $key = array_search($agent, $agents);
        if ($key !== false) {
            unset($agents[$key]);
        }
        if (count($agents) > 2500) {
            $chunks = array_chunk($agents, 2000);
            $agents = $chunks[0];
        }
        array_unshift($agents, $agent);
        self::set($indexKey, $agents);
    }

    public static function getAgentsIndex($namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        $agents = self::get($indexKey);
        return $agents;
    }

    public static function getAgentsIndexFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        $agentsIndex = self::get($indexKey);
        return $agentsIndex;
    }

    public static function getAgentsIndexHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        $agentsIndex = self::get($indexKey);
        return $agentsIndex;
    }

    public static function countAgentsFingerprint($fingerprint, $namespace = '')
    {
        return 0;
    }

    public static function countAgentsHost($haddr, $namespace = '')
    {
        return 0;
    }

    public static function storeConnection($connection)
    {
        $key = uniqid();
        self::set("connection-" . $key, $connection);
        return $key;
    }

    public static function indexConnection($key, $agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $countKey = empty($namespace) ? "count" : "count-$namespace";

        // Add connection to agent connection index
        $connections = self::get($indexKey);
        if (empty($connections)) {
            $connections = array();
        }
        if (count($connections) >= 250) {
            $chunks = array_chunk($connections, 200);
            $connections = $chunks[0];
            // update count
            $identity = self::getIdentity($agent);
            $identity[$countKey] = empty($identity[$countKey]) ? count($chunks[1]) : $identity[$countKey] + count($chunks[1]);
            self::setIdentity($agent, $identity);
        }
        array_unshift($connections, $key);
        self::set($indexKey, $connections);
    }

    public static function getAgentConnections($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $result = array();
        $connections = self::get($indexKey);
        if (empty($connections)) {
            return null;
        }
        foreach ($connections as $key) {
            $result[$key] = self::get("connection-" . $key);
        }
        return $result;
    }

    public static function getLastAgentConnection($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $connections = self::get($indexKey);
        if (empty($connections)) {
            return null;
        }
        foreach ($connections as $key) {
            $connection = self::get("connection-" . $key);
            if ($connection) {
                return $connection;
            }
        }
    }

    public static function getFirstAgentConnection($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $connections = self::get($indexKey);
        $connections = array_reverse($connections);
        if (empty($connections)) {
            return null;
        }
        foreach ($connections as $key) {
            $connection = self::get("connection-" . $key);
            if ($connection) {
                return $connection;
            }
        }
    }

    public static function countAgentConnections($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $countKey = empty($namespace) ? "count" : "count-$namespace";
        $identity = self::getIdentity($agent);
        $connections = self::get($indexKey);
        $count = count($connections);
        if (!empty($identity[$countKey])) {
            $count += (int)$identity[$countKey];
        }
        return $count;
    }

    public static function setIdentity($id, $identity)
    {
        return self::set("identity-$id", $identity);
    }

    public static function getIdentity($id)
    {
        return self::get("identity-$id");
    }

}
