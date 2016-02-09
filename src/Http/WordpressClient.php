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

    protected $timeout = 2;

    public function get($url)
    {
        $response = wp_remote_get($url, array(
            'headers' => array(
                'Accept: application/json',
            ),
            'timeout' => $this->timeout,
        ));
        if (is_array($response)) {
            $response = json_decode($response['body'], true);
            return $response;
        }
    }

    public function post($url, $data = null)
    {
        $response = wp_remote_post($url, array(
            'headers' => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
            'body' => json_encode($data),
            'timeout' => $this->timeout,
        ));
        if (is_array($response)) {
            $response = json_decode($response['body'], true);
            return $response;
        }
    }

}
