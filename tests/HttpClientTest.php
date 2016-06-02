<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer;

class HttpClientTest extends \PHPUnit_Framework_TestCase
{

    public function testGetUserAgent()
    {
        $options = array(
          'apiKey'  => 'b3bb90d61e80e96259bf354fd7cb03d7',
          'siteUrl' => 'https://github.com/znarf/bouncer',
        );

        $client = new \Bouncer\Http\SimpleClient($options);

        $this->assertEquals('Bouncer Http; https://github.com/znarf/bouncer', $client->getUserAgent());
    }

}
