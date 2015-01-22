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

use Memcache as PhpMemcache;
use Memcached as PhpMemcached;

use Bouncer\Exception;

class Memcache extends AbstractBackend
{

    protected $client = null;

    protected $_prefix = null;

    protected $_servers = array('127.0.0.1');

    protected $cache = [];

    public function __construct($options  = null)
    {
        // Client Injection
        if (is_object($options)) {
            $this->client = $options;
            return;
        }

        if (isset($options['prefix'])) {
            $this->_prefix = $options['prefix'];
        }
        if (isset($options['servers'])) {
            $this->_servers = $options['servers'];
        }
    }

    /**
     * @return PhpMemcache|PhpMemcached
     */
    public function getClient()
    {
        if (empty($this->client)) {
            if (class_exists('PhpMemcache')) {
                $client = new PhpMemcache();
            } elseif (class_exists('PhpMemcached')) {
                $client = new PhpMemcached();
            }
            if (isset($client)) {
                foreach ($this->_servers as $server) {
                    $server = trim($server);
                    if (strpos($server, ':')) {
                        list($server, $port) = explode(':', $server);
                    }
                    $port = empty($port) ? 11211 : intval($port);
                    $client->addServer($server, $port);
                }
                $this->client = $client;
            }
        }
        return $this->client;
    }

    public function getApi()
    {
        $client = $this->getClient();
        if ($client instanceof PhpMemcached) {
            return 'memcached';
        } else {
            return 'memcache';
        }
    }

    public function close()
    {
        if (isset($this->client)) {
            if ($this->getApi() == 'memcache') {
                $this->client->close();
            }
            $this->client = null;
        }
    }

    public function get($key)
    {
        $client = $this->getClient();
        if (empty($client)) {
            return;
        }
        if (!empty($this->_prefix)) {
            $key = $this->_prefix . '-' . $key;
        }
        if (empty($this->cache[$key])) {
            $this->cache[$key] = $client->get($key);
        }
        return $this->cache[$key];
    }

    public function set($key, $value, $expire = 0)
    {
        $client = $this->getClient();
        if (empty($client)) {
            return;
        }
        if (!empty($this->_prefix)) {
            $key = $this->_prefix . '-' . $key;
        }
        $this->cache[$key] = $value;
        if ($this->getApi() == 'memcache') {
            return $client->set($key, $value, null, $expire);
        } else {
            return $client->set($key, $value, $expire);
        }
    }

    public function indexAgent($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";

        // Index agent
        $agents = $this->get($indexKey);
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
        $this->set($indexKey, $agents);
    }

    public function getAgentsIndex($namespace = '')
    {
        $indexKey = empty($namespace) ? 'agents' : "agents-$namespace";
        $agents = $this->get($indexKey);
        return $agents;
    }

    public function getAgentsIndexFingerprint($fingerprint, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$fingerprint" : "agents-$fingerprint-$namespace";
        $agentsIndex = $this->get($indexKey);
        return $agentsIndex;
    }

    public function getAgentsIndexHost($haddr, $namespace = '')
    {
        $indexKey = empty($namespace) ? "agents-$haddr" : "agents-$haddr-$namespace";
        $agentsIndex = $this->get($indexKey);
        return $agentsIndex;
    }

    public function countAgentsFingerprint($fingerprint, $namespace = '')
    {
        return 0;
    }

    public function countAgentsHost($haddr, $namespace = '')
    {
        return 0;
    }

    public function indexConnection($key, $agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $countKey = empty($namespace) ? "count" : "count-$namespace";

        // Add connection to agent connection index
        $connections = $this->get($indexKey);
        if (empty($connections)) {
            $connections = array();
        }
        if (count($connections) >= 250) {
            $chunks = array_chunk($connections, 200);
            $connections = $chunks[0];
            // update count
            $identity = $this->getIdentity($agent);
            $identity[$countKey] = empty($identity[$countKey]) ? count($chunks[1]) : $identity[$countKey] + count($chunks[1]);
            $this->setIdentity($agent, $identity);
        }
        array_unshift($connections, $key);
        $this->set($indexKey, $connections);
    }

    public function getAgentConnections($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $result = array();
        $connections = $this->get($indexKey);
        if (empty($connections)) {
            return null;
        }
        foreach ($connections as $key) {
            $result[$key] = $this->get("connection-" . $key);
        }
        return $result;
    }

    public function getLastAgentConnection($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $connections = $this->get($indexKey);
        if (empty($connections)) {
            return null;
        }
        foreach ($connections as $key) {
            $connection = $this->get("connection-" . $key);
            if ($connection) {
                return $connection;
            }
        }
    }

    public function getFirstAgentConnection($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $connections = $this->get($indexKey);
        $connections = array_reverse($connections);
        if (empty($connections)) {
            return null;
        }
        foreach ($connections as $key) {
            $connection = $this->get("connection-" . $key);
            if ($connection) {
                return $connection;
            }
        }
    }

    public function countAgentConnections($agent, $namespace = '')
    {
        $indexKey = empty($namespace) ? "connections-$agent" : "connections-$namespace-$agent";
        $countKey = empty($namespace) ? "count" : "count-$namespace";
        $identity = $this->getIdentity($agent);
        $connections = $this->get($indexKey);
        $count = count($connections);
        if (!empty($identity[$countKey])) {
            $count += (int)$identity[$countKey];
        }
        return $count;
    }

}
