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

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $siteUrl;

    /**
     * @var int
     */
    protected $timeout = 2;

    /**
     * @var string
     */
    protected $baseUserAgent = 'Bouncer Http';

    /**
     * Constructor.
     *
     * @param array|string $options
     */
    public function __construct($options = array())
    {
        // Compatibility with previous API
        if (is_string($options)) {
            $options = array('apiKey' => $options);
        }

        if (isset($options['apiKey']) && is_string($options['apiKey'])) {
            $this->setApiKey($options['apiKey']);
        }
        if (isset($options['siteUrl']) && is_string($options['siteUrl'])) {
            $this->setSiteUrl($options['siteUrl']);
        }
    }

    /**
     * @return SimpleClient
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return SimpleClient
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        if ($this->siteUrl) {
            return "{$this->baseUserAgent}; {$this->siteUrl}";
        }
        else {
            return $this->baseUserAgent;
        }
    }

    public function request($method, $url, $data = null)
    {
        $userAgent = $this->getUserAgent();
        $options = array(
            'http' => array(
                'timeout' => $this->timeout,
                'method'  => $method,
                'header'  => "User-Agent: {$userAgent}\r\n"
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
