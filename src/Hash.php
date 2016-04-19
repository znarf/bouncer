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

class Hash
{

    public static $identityHeaders = array(
        'User-Agent',
        'Accept',
        'Accept-Charset',
        'Accept-Language',
        'Accept-Encoding',
        'From',
        'Dnt',
    );

    public static function headers($array)
    {
        $array = self::filterArrayKeys($array, self::$identityHeaders);
        ksort($array);
        $string = '';
        foreach ($array as $key => $value) {
            $key = self::normalizeKey($key);
            $string .= "$key:$value;";
        }
        return self::hash($string);
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

    public static function hash($value)
    {
        return md5($value);
    }

}
