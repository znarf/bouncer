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
use Bouncer\Http;
use Bouncer\Request;

class HttpLogger implements LoggerInterface
{

    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function log($connection, Identity $identity, Request $request)
    {
        $context = $connection;
        $context['request']  = $request->toArray();
        $context['identity'] = $identity->toArray();

        $result = Http::query('POST', $this->endpoint, $context);

        if (!$result) {
            error_log("Error while logging to Bouncer API.");
        }
    }

}
