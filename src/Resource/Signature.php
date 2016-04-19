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

use Bouncer\Hash;
use Bouncer\Resource;

class Signature extends Resource
{

    /**
     * The unique id
     *
     * @var string
     */
    protected $id;

    /**
     * The HTTP headers (used to compute the signature)
     *
     * @var array
     */
    protected $headers;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
        $this->id = Hash::headers($this->headers);
    }

    public function getLanguage()
    {
        return $this->getAttribute('language');
    }

    public function getCountryCode()
    {
        return $this->getAttribute('country_code');
    }

}
