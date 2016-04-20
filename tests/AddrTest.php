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

use Bouncer\Request;

class AddrTest extends \PHPUnit_Framework_TestCase
{

    public function testGetAddr()
    {
        $addr = '46.105.7.208';

        $server = array();
        $server['REMOTE_ADDR'] = $addr;

        $request = new Request;
        $request->initialize(array(), array(), array(), array(), array(), $server);

        $this->assertEquals($request->getAddr(), $addr);
    }

    public function testGetAddrForwarded()
    {
        $addr = '46.105.7.208';

        $server = array();
        $server['REMOTE_ADDR'] = '127.0.0.1';
        $server['HTTP_X_FORWARDED_FOR'] = $addr;

        Request::setTrustedProxies(array('127.0.0.1'));

        $request = new Request;
        $request->initialize(array(), array(), array(), array(), array(), $server);

        $this->assertEquals($request->getAddr(), $addr);
    }

    public function testGetAddrForwardedNotTrusted()
    {
        $addr = '46.105.7.208';

        $server = array();
        $server['REMOTE_ADDR'] = '127.0.0.1';
        $server['HTTP_X_FORWARDED_FOR'] = $addr;

        Request::setTrustedProxies(array());

        $request = new Request;
        $request->initialize(array(), array(), array(), array(), array(), $server);

        $this->assertNotEquals($request->getAddr(), $addr);
    }

}
