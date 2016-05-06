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

use Bouncer\Resource\Identity;

class IdentityTest extends \PHPUnit_Framework_TestCase
{

    public function getRequest()
    {
        $ip = '92.78.176.182';
        $ua = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36';

        $server = array();
        $server['REMOTE_ADDR'] = $ip;
        $server['HTTP_USER_AGENT'] = $ua;
        $server['HTTP_HOST'] = 'bouncer.h6e.net';
        $server['REQUEST_URI'] = '/test';
        $server['SERVER_PROTOCOL'] = 'HTTP/1.1';
        $server['HTTP_ACCEPT'] = 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
        $server['HTTP_ACCEPT_LANGUAGE'] = 'en-US,en;q=0.8';
        $server['HTTP_ACCEPT_ENCODING'] = 'gzip, deflate, sdch';

        $request = new \Bouncer\Request;
        $request->initialize(array(), array(), array(), array(), array(), $server);

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

    public function testGetIdentity()
    {
        $request = $this->getRequest();

        $bouncer = $this->getBouncer($request);

        $identity = $bouncer->getIdentity();

        $this->assertEquals('688926c9994666d5d5d4cf7e2429aabd', $identity->getId());
    }

    public function testGetIdentityAddress()
    {
        $request = $this->getRequest();

        $bouncer = $this->getBouncer($request);

        $identity = $bouncer->getIdentity();

        $address = $identity->getAddress();

        $this->assertEquals('e90d9f20cce9c203f439129b0943a8bb', $address->getId());
    }


    public function testGetIdentitySignature()
    {
        $request = $this->getRequest();

        $bouncer = $this->getBouncer($request);

        $identity = $bouncer->getIdentity();

        $signature = $identity->getSignature();

        $this->assertEquals('5a8433a81c1290cc5399eb60f26172d4', $signature->getId());
    }

    public function testIdentityStatus()
    {
        $identity = new Identity(array(
            'reputation' => array(
                'threats' => array(),
                'status'  => 'bad',
            )
        ));

        $this->assertEquals('bad', $identity->getStatus());
    }

}
