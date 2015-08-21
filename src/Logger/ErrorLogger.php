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

use Bouncer\Connection;
use Bouncer\Identity;
use Bouncer\Request;

class ErrorLogger implements LoggerInterface
{

    public function log($connection, Identity $identity, Request $request)
    {
        $context = $connection;
        $context['request']   = $request->toArray();
        $context['identity']  = $identity->toArray();

        error_log(json_encode($context, JSON_PRETTY_PRINT));
    }

}
