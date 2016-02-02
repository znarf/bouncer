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

    public function getIdentity($id)
    {
        return $this->get("bouncer-identity-$id");
    }

    public function setIdentity($id, $identity)
    {
        return $this->set("bouncer-identity-$id", $identity, 86400);
    }

}
