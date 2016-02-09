<?php

namespace Bouncer\Analyzer;

class AccessWatch
{

    protected $baseUrl = 'http://access.watch/api/v1';

    protected $apiKey;

    protected $httpClient;

    public function __construct($params)
    {
        if (isset($params['baseUrl'])) {
            $this->baseUrl = $params['baseUrl'];
        }
        if (isset($params['apiKey'])) {
            $this->apiKey = $params['apiKey'];
        }
        if (isset($params['httpClient'])) {
            $this->httpClient = $params['httpClient'];
        }
    }

    public function getHttpClient()
    {
        if (empty($this->httpClient)) {
            $this->httpClient = new \Bouncer\Http\SimpleClient;
        }
        return $this->httpClient;
    }

    public function identityAnalyzer($identity)
    {
        $result = $this->getHttpClient()->post(
            "{$this->baseUrl}/identity",
            array(
                'key'      => $this->apiKey,
                'identity' => $identity,
            )
        );
        return $result ? $result['identity'] + $identity : $identity;
    }

}
