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

class Local
{

    public static function load($bouncer)
    {
        \Bouncer\Analyzer\Defaults::load($bouncer);
        \Bouncer\Analyzer\Bbclone::load($bouncer);
        \Bouncer\Analyzer\Hostname::load($bouncer);
        \Bouncer\Analyzer\Geoip::load($bouncer);
    }

}
