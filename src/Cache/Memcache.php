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

    protected $client = null;

    protected $prefix = null;

    protected $cache = array();

    public function __construct(array $options = array())
    {
        if (!empty($options['client'])) {
            $this->setClient($options['client']);
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
            $key = $this->prefix . '-' . $key;
        }
        if (empty($this->cache[$key])) {
            $this->cache[$key] = $client->get($key);
        }
        return $this->cache[$key];
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value, $expire = 0)
    {
        $client = $this->getClient();
        if (empty($client)) {
            return;
        }
        if (!empty($this->prefix)) {
            $key = $this->prefix . '-' . $key;
        }
        $this->cache[$key] = $value;
        if ($client instanceof PhpMemcache) {
            return $client->set($key, $value, null, $expire);
        } else {
            return $client->set($key, $value, $expire);
        }
    }

}
