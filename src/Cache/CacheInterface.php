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
 * Interface that all Bouncer Caches must implement
 *
 * @author François Hodierne <francois@hodierne.net>
 */
interface CacheInterface
{

    /**
     * Retrieve an item from a cache backend
     *
     * @param string $key The key to fetch.
     *
     * @return string|object|null
     */
    public function get($key);

    /**
     * Store an item in a cache backend
     *
     * @param string $key The key that will be associated with the item.
     * @param string|object $value The variable to store.
     * @param int $ttl Expiration time of the item.
     */
    public function set($key, $value, $ttl = 0);

    /**
     * Remove an item from a cache backend
     *
     * @param string $key The key to remove.
     */
    public function delete($key);

    /**
     * Delete expired cache items from cache backend
     */
    public function clean();

    /**
     * Delete all cache items from cache backend
     */
    public function flush();

}
