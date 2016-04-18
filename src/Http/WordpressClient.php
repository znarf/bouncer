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

class WordpressClient
{

    protected $apiKey;

    protected $timeout = 2;

    public function __construct($apiKey = null)
    {
        $this->apiKey = $apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function get($url)
    {
        $headers = array(
            'Accept' => 'application/json',
        );
        if ($this->apiKey) {
            $headers['Api-Key'] = $this->apiKey;
        }
        $response = wp_remote_get($url, array(
            'headers' => $headers,
            'timeout' => $this->timeout,
        ));
        if (is_array($response)) {
            $response = json_decode($response['body'], true);
            return $response;
        }
    }

    public function post($url, $data = null)
    {
        $headers = array(
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        );
        if ($this->apiKey) {
            $headers['Api-Key'] = $this->apiKey;
        }
        $response = wp_remote_post($url, array(
            'headers' => $headers,
            'body'    => json_encode($data),
            'timeout' => $this->timeout,
        ));
        if (is_array($response)) {
            $response = json_decode($response['body'], true);
            return $response;
        }
    }

}
