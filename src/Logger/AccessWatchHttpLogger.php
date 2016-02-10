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

/**
 * Log Connections on the Access Watch Cloud Service using the HTTP protocol
 *
 * @author François Hodierne <francois@hodierne.net>
 */
class AccessWatchHttpLogger extends HttpLogger
{

    protected $endpoint = 'http://access.watch/api/v1/log';

    protected $key;

    public function __construct($params = array())
    {
        if (isset($params['apiKey'])) {
            $this->key = $params['apiKey'];
        }
        if (isset($params['httpClient'])) {
            $this->httpClient = $params['httpClient'];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function log($connection, Identity $identity, Request $request)
    {
        if ($this->key) {
            $connection['key'] = $this->key;
        }

        parent::log($connection, $identity, $request);
    }

}
