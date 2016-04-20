<?php

namespace Bouncer\Analyzer;

class AccessWatch
{

    protected $baseUrl = 'https://access.watch/api/1.0';

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

    /*
     *
     * @param object
     *
     * @return object
     */
    public function identityAnalyzer($identity)
    {
        $result = $this->getHttpClient($this->apiKey)->post(
            "{$this->baseUrl}/session",
            array(
                'address' => $identity->getAddress()->getValue(),
                'headers' => $identity->getHeaders(),
            )
        );

        if (isset($result['identity']) && is_array($result['identity'])) {
            $identity->setAttributes($result['identity']);
        }

        if (isset($result['session']) && is_array($result['session'])) {
            $identity->setAttribute('session', $result['session']);
        }

        return $identity;
    }

}
