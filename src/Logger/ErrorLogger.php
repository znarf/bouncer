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

class ErrorLogger extends BaseLogger
{

    /**
     * {@inheritDoc}
     */
    public function log(array $logEntry)
    {
        $entry = $this->format($logEntry);

        if (defined('JSON_PRETTY_PRINT')) {
          error_log(json_encode($entry, JSON_PRETTY_PRINT));
        } else {
          error_log(json_encode($entry));
        }
    }

}
