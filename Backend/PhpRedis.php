<?php

class Bouncer_Backend_PhpRedis
{

    protected static $_redis = null;

    protected static $_keys = array();

    public function __construct(array $options = array())
    {
        $defaults = array(
            'servers' => array(array('host' => '127.0.0.1', 'port' => 6379, 'timeout' => 1))
        );
        $options = array_merge($defaults, $options);

        self::$_redis = new Redis();
        foreach ($options['servers'] as $server) {
          self::$_redis->connect($server['host'], $server['port'], $server['timeout']);
        }
        self::$_redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
    }

    public function clean()
    {
        self::$_redis->close();
        self::$_redis = null;
    }

    public static function get($keyname)
    {
        if (empty(self::$_keys[$keyname])) {
            self::$_keys[$keyname] = self::$_redis->get($keyname);
        }
        return self::$_keys[$keyname];
    }

    public static function set($keyname, $value = null)
    {
        self::$_keys[$keyname] = $value;
        return self::$_redis->set($keyname, $value);
    }

    public static function index($indexKey, $value)
    {
        return self::$_redis->zAdd($indexKey, time(), $value);
    }

    public static function indexAgent($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        self::index($indexKey, $agent);
    }

    public static function indexAgentFingerprint($agent, $fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        self::index($indexKey, $agent);
    }

    public static function indexAgentHost($agent, $haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        self::index($indexKey, $agent);
    }

    public static function getAgentsIndex($namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        return self::$_redis->zRevRange($indexKey, 0, 10000);
    }

    public static function getAgentsIndexFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        return self::$_redis->zRevRange($indexKey, 0, 10000);
    }

    public static function getAgentsIndexHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        return self::$_redis->zRevRange($indexKey, 0, 10000);
    }

    public static function countAgentsFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        return self::$_redis->zCard($indexKey);
    }

    public static function countAgentsHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        return self::$_redis->zCard($indexKey);
    }

    public static function storeConnection($connection)
    {
        $key = uniqid();
        self::set("connection-" . $key, $connection);
        return $key;
    }

    public static function indexConnection($key, $agent, $namespace = '')
    {
        $connectionsKey = empty($namespace) ? "connections" : "connections-$namespace";
        self::$_redis->lPush($connectionsKey, $key);

        $agentConnectionsKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        self::$_redis->lPush($agentConnectionsKey, $key);
    }

    public static function getConnections($namespace = '')
    {
        $connectionsKey = empty($namespace) ? "connections" : "connections-$namespace";
        $keys = self::$_redis->lRange($connectionsKey, 0, 250);
        $result = array();
        if (empty($keys)) {
            return null;
        }
        foreach ($keys as $key) {
            $result[$key] = self::get("connection-" . $key);
        }
        return $result;
    }

    public static function getAgentConnections($agent, $namespace = '')
    {
        $agentConnectionsKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $keys = self::$_redis->lRange($agentConnectionsKey, 0, 250);
        $result = array();
        if (empty($keys)) {
            return null;
        }
        foreach ($keys as $key) {
            $result[$key] = self::get("connection-" . $key);
        }
        return $result;
    }

    public static function getLastAgentConnection($agent, $namespace = '')
    {
        $agentConnectionsKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $key  = self::$_redis->lGet($agentConnectionsKey, 0);
        return self::get("connection-" . $key);
    }

    public static function getFirstAgentConnection($agent, $namespace = '')
    {
        $agentConnectionsKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $key  = self::$_redis->lGet($agentConnectionsKey, -1);
        return self::get("connection-" . $key);
    }

    public static function countAgentConnections($agent, $namespace = '')
    {
        $agentConnectionsKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        return self::$_redis->lSize($agentConnectionsKey);
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
