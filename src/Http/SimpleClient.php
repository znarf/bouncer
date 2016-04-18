<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Http;

class SimpleClient
{

    protected $apiKey;

    protected $timeout = 2;

    public function __construct($apiKey = null)
    {
        $this->apiKey = $apiKey;
    }

    public function request($method, $url, $data = null)
    {
        $options = array(
            'http' => array(
                'timeout' => $this->timeout,
                'method'  => $method,
                'header'  => "User-Agent: Bouncer Http\r\n"
            )
        );
        if ($this->apiKey) {
            $options['http']['header'] .= "Api-Key: {$this->apiKey}\r\n";
        }
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

    public function get($url)
    {
        return self::request('GET', $url);
    }

    public function post($url, $data = null)
    {
        return self::request('POST', $url, $data);
    }

}
