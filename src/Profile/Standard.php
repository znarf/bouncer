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
        \Bouncer\Analyzer\Geoip::load($bouncer);
        \Bouncer\Analyzer\Hostname::load($bouncer);
        \Bouncer\Analyzer\Defaults::load($bouncer);

        // If no cache available, try to set up APC
        $cache = $bouncer->getCache();
        if (empty($cache)) {
          if (function_exists('apc_fetch')) {
            $cache = new \Bouncer\Cache\Apc();
            $bouncer->setOptions(['cache' => $cache]);
          }
        }

        // If no logger available, try to setup Cloud Logger
        $logger = $bouncer->getLogger();
        if (empty($logger)) {
          // Get a key from cache
          if ($cache) {
            $key = $cache->get('bouncer_key');
          }
          // Generate a key
          if (empty($key)) {
            $key = md5(rand(0, 1000000000) . time() . uniqid() . 'bouncer_key');
            if ($cache) {
              $cache->set('bouncer_key', $key);
            }
          }
          $logger = new \Bouncer\Logger\CloudLogger($key);
          $bouncer->setOptions(['logger' => $logger]);
        }
    }

}
