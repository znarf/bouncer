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

class TestProfile extends DefaultProfile
{

    public function load(Bouncer $instance)
    {
        self::initCache($instance);

        parent::load($instance);

        $exit = function() {
            // error_log('Test profile. Not exiting.');
        };

        $instance->setOptions(array('exit' => $exit));

        $responseCodeSetter = function($code, $message) {
            static $codeSet;
            if ($code) {
                $codeSet = $code;
            }
            return $codeSet;
        };

        $instance->setOptions(array('responseCodeSetter' => $responseCodeSetter));
    }

    public function initCache(Bouncer $instance)
    {
        // If no cache available, try to set up Void cache
        $cache = $instance->getCache();
        if (empty($cache)) {
            $cache = new \Bouncer\Cache\Void();
            $instance->setOptions(array('cache' => $cache));
        }
    }

}
