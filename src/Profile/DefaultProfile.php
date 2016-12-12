<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Profile;

use Bouncer\Bouncer;

class DefaultProfile
{

    public function load(Bouncer $instance)
    {
        $this->loadAnalyzers($instance);

        $this->initCache($instance);

        $this->initLogger($instance);

        $this->initResponseCodeHandler($instance);
    }

    public function loadAnalyzers(Bouncer $instance)
    {
        // Load Default analyzers
        \Bouncer\Analyzer\Hostname::load($instance);
    }

    public function initCache(Bouncer $instance)
    {
        // If no cache available, try to set up APC
        $cache = $instance->getCache();
        if (empty($cache)) {
            if (function_exists('apc_fetch')) {
                $cache = new \Bouncer\Cache\Apc();
                $instance->setOptions(array('cache' => $cache));
            }
        }
    }

    public function initLogger(Bouncer $instance)
    {
        // No default logger for now
    }

    public function initResponseCodeHandler(Bouncer $instance)
    {
        if (function_exists('http_response_code')) {
            $responseCodeHandler = function($code = null) {
                if ($code) {
                    return http_response_code($code);
                } else {
                    return http_response_code();
                }
            };
        }
        else {
            // If http_response_code not available (PHP 5.3), set a custom response code setter
            $responseCodeHandler = function($code = null, $message = null) {
                static $currentCode = 200;
                if ($code && $message) {
                    header("HTTP/1.0 $code $message");
                    header("Status: $code $message");
                    $currentCode = $code;
                }
                return $currentCode;
            };
        }

        $instance->setOptions(array('responseCodeHandler' => $responseCodeHandler));
    }
}
