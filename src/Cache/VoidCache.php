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
 * Cache nothing
 *
 * @author François Hodierne <francois@hodierne.net>
 */
class VoidCache extends AbstractCache
{

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value, $ttl = 0)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function delete($key)
    {
    }

}
