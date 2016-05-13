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
        parent::load($instance);

        $exitHandler = function() {
            // error_log('Test profile. Not exiting.');
        };

        $instance->setOptions(array('exitHandler' => $exitHandler));

        $responseCodeHandler = function($code = null) {
            static $currentCode = 200;
            if ($code) {
                $currentCode = $code;
            }
            return $currentCode;
        };

        $instance->setOptions(array('responseCodeHandler' => $responseCodeHandler));
    }

    public function initCache(Bouncer $instance)
    {
        // If no cache available, set up Void cache
        $cache = $instance->getCache();
        if (empty($cache)) {
            $cache = new \Bouncer\Cache\VoidCache();
            $instance->setOptions(array('cache' => $cache));
        }
    }

}
