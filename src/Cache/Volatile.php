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

class Volatile extends AbstractCache
{

    public function get($key) {}

    public function set($key, $value, $expire = 0) {}

}
