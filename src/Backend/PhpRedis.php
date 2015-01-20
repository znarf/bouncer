<?php

namespace Bouncer\Backend;

use Redis;

class PhpRedis
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

    public static function clean()
    {
        self::$_redis->close();
        self::$_redis = null;
    }

    public static function redis()
    {
        return self::$_redis;
    }

    public static function get($keyname)
    {
        return self::redis()->get($keyname);
    }

    public static function set($keyname, $value = null)
    {
        return self::redis()->set($keyname, $value);
    }

    public static function index($indexKey, $value)
    {
        return self::redis()->zAdd($indexKey, time(), $value);
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

    public static function indexAgentUa($agent, $hua, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$hua" : "agents-$hua-$namespace";
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
        return self::redis()->zRevRange($indexKey, 0, 10000);
    }

    public static function getAgentsIndexFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        return self::redis()->zRevRange($indexKey, 0, 10000);
    }

    public static function getAgentsIndexUa($hua, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$hua" : "agents-$hua-$namespace";
        return self::redis()->zRevRange($indexKey, 0, 10000);
    }

    public static function getAgentsIndexHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        return self::redis()->zRevRange($indexKey, 0, 10000);
    }

    public static function countAgentsFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        return self::redis()->zCard($indexKey);
    }

    public static function countAgentsUa($hua, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$hua" : "agents-$hua-$namespace";
        return self::redis()->zCard($indexKey);
    }

    public static function countAgentsHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        return self::redis()->zCard($indexKey);
    }

    public static function storeConnection($connection)
    {
        $key = uniqid();
        self::set("connection-" . $key, $connection);
        return $key;
    }

    public static function indexConnectionWithIndexKey($indexKey, $connectionKey)
    {
        self::redis()->lPush($indexKey, $connectionKey);
    }

    public static function getConnectionsWithIndexKey($indexKey)
    {
        $keys = self::redis()->lRange($indexKey, 0, 10000);
        if (empty($keys)) {
            return array();
        }
        $connections = array();
        foreach ($keys as $key) {
            $connections[$key] = self::getConnection($key);
        }
        return $connections;
    }

    public static function indexConnection($key, $agent, $namespace = '')
    {
        $connectionsKey = empty($namespace) ? "connections" : "connections-$namespace";
        self::indexConnectionWithIndexKey($connectionsKey, $key);

        $agentConnectionsKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        self::indexConnectionWithIndexKey($agentConnectionsKey, $key);
    }

    public static function indexConnectionHost($key, $haddr, $namespace = '')
    {
        $connectionsKey = empty($namespace) ? "connections-$haddr" : "connections-$haddr-$namespace";
        self::$_redis->lPush($connectionsKey, $key);
    }

    public static function getConnections($namespace = '')
    {
        $indexKey = empty($namespace) ? "connections" : "connections-$namespace";
        return self::getConnectionsWithIndexKey($indexKey);
    }

    public static function getHostConnections($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$haddr" : "connections-$namespace-$haddr";
        return self::getConnectionsWithIndexKey($indexKey);
    }

    public static function getAgentConnections($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        return self::getConnectionsWithIndexKey($indexKey);
    }

    public static function getConnection($id)
    {
        $connection = self::get("connection-" . $id);
        $connection['id'] = $id;
        return $connection;
    }

    public static function getLastAgentConnection($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $key  = self::redis()->lGet($indexKey, 0);
        return self::getConnection($key);
    }

    public static function getFirstAgentConnection($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $key  = self::redis()->lGet($indexKey, -1);
        return self::getConnection($key);
    }

    public static function countAgentConnections($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        return self::redis()->lSize($indexKey);
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
