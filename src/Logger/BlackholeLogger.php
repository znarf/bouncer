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

class BlackholeLogger implements LoggerInterface
{

    /**
     * {@inheritDoc}
     */
    public function log(array $logEntry)
    {
    }

}
