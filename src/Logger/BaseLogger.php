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

/**
 * Base Logger class providing the Cache structure
 *
 * @author François Hodierne <francois@hodierne.net>
 */
abstract class BaseLogger
{

    public function format(array $logEntry)
    {
        $formattedEntry = array();

        if (isset($logEntry['address'])) {
            $formattedEntry['address'] = $this->formatAddress($logEntry['address']);
        }

        if (isset($logEntry['request'])) {
            $formattedEntry['request'] = $this->formatRequest($logEntry['request']);
        }

        if (isset($logEntry['response'])) {
            $formattedEntry['response'] = $logEntry['response'];
        }

        if (isset($logEntry['context'])) {
            $formattedEntry['context'] = $logEntry['context'];
        }

        if (isset($logEntry['key'])) {
            $formattedEntry['key'] = $logEntry['key'];
        }

        if (isset($logEntry['session'])) {
            $formattedEntry['session'] = $logEntry['session'];
        }

        return $formattedEntry;
    }

    public function formatAddress($address)
    {
        if (is_object($address)) {
            return $address->getValue();
        } elseif (is_array($address)) {
            return $address['value'];
        } elseif (is_string($address)) {
            return $address;
        }
    }

    public function formatRequest($request)
    {
        if (is_object($request)) {
            return $request->toArray();
        } elseif (is_array($request)) {
            return $request;
        }
    }

}
