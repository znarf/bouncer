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

    protected $_prefix = null;

    protected $cache = array();

    public function __construct($options  = null)
    {
        // Client Injection
        if (is_object($options)) {
            $this->client = $options;
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
     * @return string memcached|memcache
     */
    public function getApi()
    {
        $client = $this->getClient();
        if ($client instanceof PhpMemcached) {
            return 'memcached';
        } elseif ($client instanceof PhpMemcache) {
            return 'memcache';
        } else {
            throw new Exception('Unsupported client.');
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

    /**
     * {@inheritDoc}
     */
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

    /**
     * {@inheritDoc}
     */
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

}
