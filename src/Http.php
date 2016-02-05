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

class Http
{

    public static function request($method, $url, $data = null, $timeout = 2)
    {
        $options = array(
            'http' => array(
                'timeout' => $timeout,
                'method'  => $method,
                'header'  => "User-Agent: Bouncer Http\r\n"
            )
        );
        if ($data) {
            $content = json_encode($data);
            $length = strlen($content);
            $options['http']['header'] .= "Content-Type: application/json\r\n";
            $options['http']['header'] .= "Content-Length: {$length}\r\n";
            $options['http']['content'] = $content;
        }
        $context = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);
        if ($result) {
            $response = json_decode($result, true);
            return $response;
        }
    }

    public static function get($url, $data = null, $timeout = 2)
    {
        return self::request('GET', $url, $data, $timeout);
    }

}
