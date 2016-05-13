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

class SessionTest extends \PHPUnit_Framework_TestCase
{

    public function getRequest()
    {
        $ip = '92.78.176.182';

        $cookies = array();
        $cookies['bsid'] = '529460e691b0f2c87ff95acd6c4e00d2';

        $server = array();
        $server['REMOTE_ADDR'] = $ip;

        $request = new \Bouncer\Request;
        $request->initialize(array(), array(), array(), $cookies, array(), $server);

        return $request;
    }

    public function getBouncer($request)
    {
        $bouncer = new Bouncer(array(
            'request' => $request,
            'profile' => new \Bouncer\Profile\TestProfile,
        ));

        return $bouncer;
    }

    public function testSessionId()
    {
        $request = $this->getRequest();

        $bouncer = $this->getBouncer($request);

        $identity = $bouncer->getIdentity();

        $this->assertInstanceOf('\\Bouncer\\Resource\\Session', $identity->getSession());

        $this->assertEquals('529460e691b0f2c87ff95acd6c4e00d2', $identity->getSession()->getId());
    }

}
