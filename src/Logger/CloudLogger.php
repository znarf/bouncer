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
class CloudLogger extends LogstashLogger
{

    protected $host = 'bouncer.h6e.net';

    protected $port = 5145;

    protected $protocol = 'udp';

    protected $channel = 'bouncer';

    protected $type = 'access_log';

    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritDoc}
     */
    public function log($connection, Identity $identity, Request $request)
    {
        $connection['key'] = $this->getKey();

        parent::log($connection, $identity, $request);
    }

}
