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
 * Use APC or APCu to provide cache.
 *
 * @author François Hodierne <francois@hodierne.net>
 */
class Apc extends AbstractCache
{

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
        return apc_fetch($key);
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value, $ttl = 0)
    {
        return apc_store($key, $value, $ttl);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key)
    {
        return apc_delete($key);
    }

}
