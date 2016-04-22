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

class Signature extends Resource
{

    /**
     * HTTP Headers used to compute the signature
     *
     * @var array
     */
    public static $signatureHeaders = array(
        'User-Agent',
        'Accept',
        'Accept-Charset',
        'Accept-Language',
        'Accept-Encoding',
        'From',
        'Dnt',
    );

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
        $this->id = self::hash($this->headers);
    }

    public function getLanguage()
    {
        return $this->getAttribute('language');
    }

    public function getCountryCode()
    {
        return $this->getAttribute('country_code');
    }

    // Static

    public static function hash($array)
    {
        $array = self::filterArrayKeys($array, self::$signatureHeaders);
        ksort($array);
        $string = '';
        foreach ($array as $key => $value) {
            $key = self::normalizeKey($key);
            $string .= "$key:$value;";
        }
        return Bouncer::hash($string);
    }

    public static function filterArrayKeys($array = array(), $keys = array())
    {
        $ikeys = array_map('strtolower', $keys);
        foreach ($array as $key => $value) {
            $ikey = strtolower($key);
            if (!in_array($ikey, $ikeys)) {
                unset($array[$key]);
            }
        }
        return $array;
    }

    public static function normalizeKey($key)
    {
        if (strpos($key, '-')) {
            $parts = explode('-', $key);
            $parts = array_map('strtolower', $parts);
            $parts = array_map('ucfirst', $parts);
            $key = implode('-', $parts);
        } else {
            $key = ucfirst(strtolower($key));
        }
        return $key;
    }

}
