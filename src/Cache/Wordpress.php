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

class Wordpress extends AbstractCache
{

    public function get($key)
    {
        return get_transient($key);
    }

    public function set($key, $value, $ttl = 0)
    {
        set_transient($key, $value, $ttl);
    }

}
