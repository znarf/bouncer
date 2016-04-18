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

    // /**
    //  * The Language Code (extract from Accept-Language)
    //  *
    //  * @var string
    //  */
    // protected $language;

    // /**
    //  * The Country Code (extract from Accept-Language)
    //  *
    //  * @var string
    //  */
    // protected $countryCode;

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
        $this->id = Fingerprint::generate($this->headers);
    }

    // public function getLanguage()
    // {
    //     return $this->language;
    // }

    // public function setLanguage($language)
    // {
    //     return $this->language = $language;
    // }

    // public function getCountryCode()
    // {
    //     return $this->countryCode;
    // }

    // public function setCountryCode($countryCode)
    // {
    //     return $this->countryCode = $countryCode;
    // }

    public function getLanguage()
    {
        return $this->getAttribute('language');
    }

    public function getCountryCode()
    {
        return $this->getAttribute('country_code');
    }

}
