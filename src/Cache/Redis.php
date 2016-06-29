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

use Redis as PhpRedis;

use Bouncer\Exception;

class Redis extends AbstractCache
{

    protected $client;

    protected $params = array();

    protected $redisOptions = [
        PhpRedis::OPT_SERIALIZER => PhpRedis::SERIALIZER_PHP
    ];

    /**
     * @param PhpRedis $params
     */
    public function __construct($params = null)
    {
        // Client Injection
        if (is_object($params) && $params instanceof PhpRedis) {
            $this->setClient($params);
        }
    }

    /**
     * @return PhpRedis
     *
     * @throws Exception
     */
    public function getClient()
    {
        if (empty($this->client)) {
           throw new Exception('No client available.');
        }
        return $this->client;
    }

    /**
     * @param PhpRedis $client
     */
    public function setClient(PhpRedis $client)
    {
        $this->client = $client;
        foreach ($this->redisOptions as $name => $value) {
            $this->client->setOption($name, $value);
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
        return $this->getClient()->get($key);
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value, $ttl = 0)
    {
        return $this->getClient()->set($key, $value, $ttl);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key)
    {
        return $this->getClient()->delete($key);
    }
}
