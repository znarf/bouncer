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

/**
 * Base Cache class providing the Cache structure
 *
 * @author François Hodierne <francois@hodierne.net>
 */
abstract class AbstractCache implements CacheInterface
{

    protected $prefix = 'bouncer';

    /**
     * {@inheritDoc}
     */
    public function clean()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function flush()
    {
    }

    /**
     * Return an Identity object from cache
     *
     * @param string $id identifier for the identity
     *
     * @return object|null
     */
    public function getIdentity($id)
    {
        return $this->get("{$this->prefix}_identity_{$id}");
    }

    /**
     * Store an Identity object in cache
     *
     * @param string $id        identifier for the identity
     * @param object $identity  identity object
     */
    public function setIdentity($id, $identity)
    {
        return $this->set("{$this->prefix}_identity_{$id}", $identity, 60 * 60 * 6);
    }

    /**
     * Remove an Identity object from cache
     *
     * @param string $id        identifier for the identity
     */
    public function deleteIdentity($id)
    {
        return $this->delete("{$this->prefix}_identity_{$id}");
    }

}
