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

class UserAgentTest extends \PHPUnit_Framework_TestCase
{

    public function testGetUserAgent()
    {
        $ua = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0';

        $server = array();
        $server['HTTP_USER_AGENT'] = $ua;

        $request = new \Bouncer\Request;
        $request->initialize(array(), array(), array(), array(), array(), $server);

        $this->assertEquals($request->getUserAgent(), $ua);
    }

}
