<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Resource;

use Bouncer\Bouncer;
use Bouncer\Resource;

class Address extends Resource
{

    protected $id;

    protected $value;

    protected $hostname;

    /**
     * @param array|string $attributes
     */
    public function __construct($attributes = null)
    {
        if (is_string($attributes)) {
            $this->setValue($attributes);
        } elseif (is_array($attributes)) {
            parent::__construct($attributes);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        $this->id = Bouncer::hash($this->value);
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }

    public function getReverse()
    {
        return $this->getAttribute('reverse');
    }

    public function getAsNumber()
    {
        return $this->getAttribute('as_number');
    }

    public function getNetworkName()
    {
        return $this->getAttribute('network_name');
    }

    public function getCountryCode()
    {
        return $this->getAttribute('country_code');
    }

    public function getFlags()
    {
        return $this->getAttribute('flags');
    }

}
