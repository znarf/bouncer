<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer;

class Resource
{

    protected $attributes = array();

    public function __construct($attributes = null)
    {
        if (!empty($attributes)) {
            $this->setAttributes($attributes);
        }
    }

    public function setAttributes($attributes = array())
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
        $setMethod = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        if (method_exists($this, $setMethod)) {
            $this->$setMethod($value);
        }
    }

    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->attributes);
    }

    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
    }

}
