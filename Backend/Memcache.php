<?php

class Bouncer_Backend_Memcache
{

    protected static $_prefix = null;

    public static $memcache = null;

    private static $cache = array();

    public function __construct($options)
    {
        if (isset($options['prefix'])) {
            self::$_prefix = $options['prefix'];
        }
    }

    public static function memcache()
    {
        if (empty(self::$memcache)) {
            if (class_exists('Memcache')) {
                $memcache = new Memcache();
                $memcache->addServer('127.0.0.1');
                self::$memcache = $memcache;
            }
        }
        return self::$memcache;
    }

    public static function clean()
    {
        if (isset(self::$memcache)) {
            self::$memcache->close();
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
        return $memcache->set($key, $value, null, $expire);
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

    public static function storeConnection($connection)
    {
        $key = uniqid();
        self::set("connection-" . $key, $connection);
        return $key;
    }

    public static function indexConnection($key, $agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";

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
            $identity['count'] = empty($identity['count']) ? count($chunks[1]) : $identity['count'] + count($chunks[1]);
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
        $identity = self::getIdentity($agent);
        $connections = self::get($indexKey);
        $count = count($connections);
        if (!empty($identity['count'])) {
            $count += (int)$identity['count'];
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
