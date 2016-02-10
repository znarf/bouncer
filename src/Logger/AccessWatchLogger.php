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
 * Log Connections on the Bouncer Cloud Service
 *
 * @author François Hodierne <francois@hodierne.net>
 */
class AccessWatchLogger extends LogstashLogger
{

    protected $host = 'access.watch';

    protected $port = 5145;

    protected $protocol = 'udp';

    protected $channel = 'bouncer';

    protected $type = 'access_log';

    protected $key;

    public function __construct($params = array())
    {
        if (isset($params['apiKey'])) {
            $this->key = $params['apiKey'];
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
