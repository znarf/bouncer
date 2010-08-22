<?php

require_once 'Rediska.php';
require_once 'Rediska/Key.php';
require_once 'Rediska/Key/List.php';
require_once 'Rediska/Key/Set.php';

class Bouncer_Backend_Redis
{

    protected static $_rediska = null;

    public function __construct(array $options = array())
    {
        $defaults = array(
            'servers' => array(array('host' => '127.0.0.1'))
        );
        $options = array_merge($options, $defaults);
        self::$_rediska = new Rediska($options);
    }

    public function clean()
    {
        self::$_rediska = null;
    }

    public static function get($keyname)
    {
        $key = new Rediska_Key($keyname);
        return $key->getValue();
    }

    public static function set($keyname, $value = null)
    {
        $key = new Rediska_Key($keyname);
        return $key->setValue($value);
    }

    public static function indexAgent($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        $agentsIndex->remove($agent);
        $agentsIndex->prepend($agent);
    }

    public static function indexAgentFingerprint($agent, $fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        $agentsIndex->remove($agent);
        $agentsIndex->prepend($agent);
    }

    public static function indexAgentHost($agent, $haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        $agentsIndex->remove($agent);
        $agentsIndex->prepend($agent);
    }

    public static function getAgentsIndex($namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        return $agentsIndex->toArray(0, 10000);
    }

    public static function getAgentsIndexFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        return $agentsIndex->toArray(0, 10000);
    }

    public static function getAgentsIndexHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        return $agentsIndex->toArray(0, 10000);
    }

    public static function countAgentsFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        return count($agentsIndex);
    }

    public static function countAgentsHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        $agentsIndex = new Rediska_Key_List($indexKey);
        return count($agentsIndex);
    }

    public static function storeConnection($connection)
    {
        $key = uniqid();
        self::set("connection-" . $key, $connection);
        return $key;
    }

    public static function getConnectionsKeyList($namespace = '')
    {
        $key = empty($namespace) ? "connections" : "connections-$namespace";
        return new Rediska_Key_List($key);
    }

    public static function getAgentConnectionsKeyList($agent, $namespace = '')
    {
        $key = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        return new Rediska_Key_List($key);
    }

    public static function indexConnection($key, $agent, $namespace = '')
    {
        $connections = self::getConnectionsKeyList($namespace);
        $connections->prepend($key);

        $agentConnections = self::getAgentConnectionsKeyList($agent, $namespace);
        $agentConnections->prepend($key);
    }

    public static function getAgentConnections($agent, $namespace = '')
    {
        $connections = self::getAgentConnectionsKeyList($agent, $namespace);
        $keys = $connections->toArray(0, 250);
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
        $connections = self::getAgentConnectionsKeyList($agent, $namespace);
        $key = $connections[0];
        return self::get("connection-" . $key);
    }

    public static function getFirstAgentConnection($agent, $namespace = '')
    {
        $connections = self::getAgentConnectionsKeyList($agent, $namespace);
        $key = $connections[-1];
        return self::get("connection-" . $key);
    }

    public static function countAgentConnections($agent, $namespace = '')
    {
        $connections = self::getAgentConnectionsKeyList($agent, $namespace);
        return count($connections);
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
