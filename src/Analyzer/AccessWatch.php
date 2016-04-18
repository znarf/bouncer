<?php

namespace Bouncer\Analyzer;

class AccessWatch
{

    protected $endpoint = 'https://access.watch/api/1.0/identity';

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

    public function getHttpClient($apiKey = null)
    {
        if (empty($this->httpClient)) {
            $this->httpClient = new \Bouncer\Http\SimpleClient($apiKey);
        }
        if ($apiKey) {
            $this->httpClient->setApiKey($apiKey);
        }
        return $this->httpClient;
    }

    public function identityAnalyzer($identity)
    {
        $result = $this->getHttpClient($this->apiKey)->post(
            $this->endpoint,
            array(
                'address' => $identity->getAddress()->getValue(),
                'headers' => $identity->getHeaders(),
            )
        );
        if ($result) {
            $identity->setAttributes($result);
        }
        return $identity;
    }

}
