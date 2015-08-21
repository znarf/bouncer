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

class Standard
{

    public static function load($bouncer)
    {
        // Register analyzers
        \Bouncer\Analyzer\Cloud::load($bouncer);
        \Bouncer\Analyzer\Defaults::load($bouncer);

        $cache = $bouncer->getCache();
        if (empty($cache)) {
          // Setup APC cache if APC is available
          if (function_exists('apc_fetch')) {
            $cache = new \Bouncer\Cache\Apc();
            $bouncer->setOptions(['cache' => $cache]);
          }
        }

        // If no logger available, log on Bouncer API with HTTP
        $logger = $bouncer->getLogger();
        if (empty($logger)) {
          $logger = new \Bouncer\Logger\LogstashLogger('bouncer.h6e.net', 5145);
          // $logger = new \Bouncer\Logger\HttpLogger('http://bouncer.h6e.net/api/activity/log');
          $bouncer->setOptions(['logger' => $logger]);
        }
    }

}
