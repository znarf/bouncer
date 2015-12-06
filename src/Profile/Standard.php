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

    public function load($bouncer)
    {
        $this->loadAnalyzers($bouncer);

        $this->initCache($bouncer);
    }

    public function loadAnalyzers($bouncer)
    {
        // Load Default analyzers
        \Bouncer\Analyzer\Geoip::load($bouncer);
        \Bouncer\Analyzer\Hostname::load($bouncer);
    }

    public function initCache($bouncer)
    {
        // If no cache available, try to set up APC
        $cache = $bouncer->getCache();
        if (empty($cache)) {
          if (function_exists('apc_fetch')) {
            $cache = new \Bouncer\Cache\Apc();
            $bouncer->setOptions(['cache' => $cache]);
          } else {
            $bouncer->error('No cache available. A cache is needed to keep performances acceptable.');
          }
        }
    }

}
