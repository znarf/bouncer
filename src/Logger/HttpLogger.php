<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Logger;

use Bouncer\Identity;
use Bouncer\Request;

class HttpLogger implements LoggerInterface
{

    protected $endpoint;

    protected $httpClient;

    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getHttpClient()
    {
        if (empty($this->httpClient)) {
            $this->httpClient = new \Bouncer\Http\SimpleClient;
        }
        return $this->httpClient;
    }

    /**
     * {@inheritDoc}
     */
    public function log($connection, Identity $identity, Request $request)
    {
        $context = $connection;
        $context['request']  = $request->toArray();
        $context['identity'] = $identity->toArray();

        $result = $this->getHttpClient()->post($this->endpoint, $context);

        if (!$result) {
            error_log("Error while logging to Http endpoint: $this->endpoint");
        }
    }

}
