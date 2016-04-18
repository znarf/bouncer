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

  public function get($key);

  public function set($key, $value, $ttl = 0);

}
