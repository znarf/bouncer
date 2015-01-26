<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Backend;

use Redis as PhpRedis;

use Bouncer\Exception;

class Redis extends AbstractBackend
{

    protected $client;

    protected $params = [];

    protected $redisOptions = [
        PhpRedis::OPT_SERIALIZER => PhpRedis::SERIALIZER_PHP
    ];

    /**
     * @param PhpRedis|array $params
     * @throws Exception
     */
    public function __construct($params = null)
    {
        // Client Injection
        if (is_object($params) && $params instanceof PhpRedis) {
            $this->setClient($params);
        }

        // Options
        elseif (is_array($params)) {
            $this->params = $params;
        }

        // Unsupported
        elseif (isset($params)) {
            throw new Exception('Unsupported constructor params.');
        }
    }

    /**
     * @return PhpRedis
     */
    public function getClient()
    {
        if ($this->client) {
            return $this->client;
        }

        $phpRedis = new PhpRedis();
        foreach ($this->params['servers'] as $server) {
            $phpRedis->connect($server['host'], $server['port'], $server['timeout']);
        }

        $this->setClient($phpRedis);

        return $phpRedis;
    }

    /**
     * @param PhpRedis $client
     */
    public function setClient($client)
    {
        $this->client = $client;
        foreach ($this->redisOptions as $name => $value) {
            $this->client->setOption($name, $value);
        }
        return $this;
    }

    public function close()
    {
        if ($this->client) {
            $this->client->close();
            $this->client = null;
        }
    }

    public function get($keyname)
    {
        // echo "get:{$keyname}\n";
        return $this->getClient()->get($keyname);
    }

    public function set($keyname, $value)
    {
        // echo "set:{$keyname}\n";
        return $this->getClient()->set($keyname, $value);
    }

    public function index($indexKey, $value)
    {
        // echo "index:{$indexKey}:{$value}\n";
        return $this->getClient()->zAdd($indexKey, time(), $value);
    }

    public function indexAgent($agent, $namespace = null)
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        $this->index($indexKey, $agent);
    }

    public function indexAgentFingerprint($agent, $fingerprint, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        $this->index($indexKey, $agent);
    }

    public function indexAgentUa($agent, $hua, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$hua" : "agents-$hua-$namespace";
        $this->index($indexKey, $agent);
    }

    public function indexAgentHost($agent, $haddr, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        $this->index($indexKey, $agent);
    }

    public function getAgentsIndex($namespace = null)
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        return $this->getClient()->zRevRange($indexKey, 0, 10000);
    }

    public function getAgentsIndexFingerprint($fingerprint, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        return $this->getClient()->zRevRange($indexKey, 0, 10000);
    }

    public function getAgentsIndexUa($hua, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$hua" : "agents-$hua-$namespace";
        return $this->getClient()->zRevRange($indexKey, 0, 10000);
    }

    public function getAgentsIndexHost($haddr, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        return $this->getClient()->zRevRange($indexKey, 0, 10000);
    }

    public function countAgentsFingerprint($fingerprint, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        return $this->getClient()->zCard($indexKey);
    }

    public function countAgentsUa($hua, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$hua" : "agents-$hua-$namespace";
        return $this->getClient()->zCard($indexKey);
    }

    public function countAgentsHost($haddr, $namespace = null)
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        return $this->getClient()->zCard($indexKey);
    }

    public function indexConnectionWithIndexKey($indexKey, $connectionKey)
    {
        $this->getClient()->lPush($indexKey, $connectionKey);
    }

    public function getConnectionsWithIndexKey($indexKey)
    {
        $keys = $this->getClient()->lRange($indexKey, 0, 10000);
        if (empty($keys)) {
            return [];
        }
        $connections = [];
        foreach ($keys as $key) {
            $connections[$key] = $this->getConnection($key);
        }
        return $connections;
    }

    public function indexConnection($key, $namespace = null)
    {
        $connectionsKey = empty($namespace) ? "connections" : "connections-$namespace";
        $this->indexConnectionWithIndexKey($connectionsKey, $key);
    }

    public function indexConnectionAgent($key, $agent, $namespace = null)
    {
        $agentConnectionsKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $this->indexConnectionWithIndexKey($agentConnectionsKey, $key);
    }

    public function indexConnectionHost($key, $haddr, $namespace = null)
    {
        $connectionsKey = empty($namespace) ? "connections-$haddr" : "connections-$haddr-$namespace";
        $this->client->lPush($connectionsKey, $key);
    }

    public function getConnections($namespace = null)
    {
        $indexKey = empty($namespace) ? "connections" : "connections-$namespace";
        return $this->getConnectionsWithIndexKey($indexKey);
    }

    public function getHostConnections($haddr, $namespace = null)
    {
        $indexKey = empty($namespace) ? "connections-$haddr" : "connections-$namespace-$haddr";
        return $this->getConnectionsWithIndexKey($indexKey);
    }

    public function getAgentConnections($agent, $namespace = null)
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        return $this->getConnectionsWithIndexKey($indexKey);
    }

    public function getLastAgentConnection($agent, $namespace = null)
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $key = $this->getClient()->lGet($indexKey, 0);
        return $this->getConnection($key);
    }

    public function getFirstAgentConnection($agent, $namespace = null)
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $key = $this->getClient()->lGet($indexKey, -1);
        return $this->getConnection($key);
    }

    public function countAgentConnections($agent, $namespace = null)
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        return $this->getClient()->lSize($indexKey);
    }

}
