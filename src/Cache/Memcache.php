<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Cache;

use Memcache as PhpMemcache;
use Memcached as PhpMemcached;

use Bouncer\Exception;

class Memcache extends AbstractCache
{

    /**
     * @var PhpMemcache|PhpMemcached
     */
    protected $client = null;

    /**
     * @var string
     */
    protected $prefix = null;

    /**
     * @var array
     */
    protected $cache = array();

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (isset($options['client']) && is_object($options['client'])) {
            $this->client = $options['client'];
        }
        if (isset($options['prefix']) && is_string($options['prefix'])) {
            $this->prefix = $options['prefix'];
        }
    }

    /**
     * @return PhpMemcache|PhpMemcached
     */
    public function getClient()
    {
        if (empty($this->client)) {
           throw new Exception('No client available.');
        }

        return $this->client;
    }

    /**
     * @param PhpMemcache|PhpMemcached
     *
     * @return PhpMemcache|PhpMemcached
     */
    public function setClient($client)
    {
        return $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
        $client = $this->getClient();
        if (empty($client)) {
            return;
        }
        if (!empty($this->prefix)) {
            $key = $this->prefix . '_' . $key;
        }
        if (empty($this->cache[$key])) {
            $this->cache[$key] = $client->get($key);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value, $ttl = 0)
    {
        $client = $this->getClient();
        if (empty($client)) {
            return;
        }
        if (!empty($this->prefix)) {
            $key = $this->prefix . '_' . $key;
        }
        $this->cache[$key] = $value;
        if ($client instanceof PhpMemcache) {
            return $client->set($key, $value, null, $ttl);
        } else {
            return $client->set($key, $value, $ttl);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key)
    {
        $client = $this->getClient();
        if (empty($client)) {
            return;
        }
        if (!empty($this->prefix)) {
            $key = $this->prefix . '_' . $key;
        }
        if (isset($this->cache[$key])) {
            unset($this->cache[$key]);
        }
        return $client->delete($key);
    }

}
