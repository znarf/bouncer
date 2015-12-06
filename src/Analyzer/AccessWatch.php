<?php

namespace Bouncer\Analyzer;

use Bouncer\Http;

class AccessWatch
{

    protected $baseUrl = 'http://access.watch/api/v1';

    protected $apiKey;

    public function __construct($params)
    {
        if (isset($params['baseUrl'])) {
            $this->baseUrl = $params['baseUrl'];
        }
        if (isset($params['apiKey'])) {
            $this->apiKey = $params['apiKey'];
        }
    }

    public function identityAnalyzer($identity)
    {
        $result = Http::request(
            'POST',
            "{$this->baseUrl}/identity",
            array(
                'key'      => $this->apiKey,
                'identity' => $identity,
            )
        );
        return $result ? $result['identity'] + $identity : $identity;
    }

}
