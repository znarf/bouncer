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

class BouncerTest extends \PHPUnit_Framework_TestCase
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

    public function testBlockContext()
    {
        $request = $this->getRequest();

        $bouncer = $this->getBouncer($request);

        $bouncer->block('login_blocked');

        $context = $bouncer->getContext();

        $this->assertEquals(true, $context['blocked']);

        $this->assertEquals('login_blocked', $context['event']['type']);
    }

    public function testBlockResponse()
    {
        $request = $this->getRequest();

        $bouncer = $this->getBouncer($request);

        $bouncer->start();

        $bouncer->block('login_blocked');

        $bouncer->end();

        $response = $bouncer->getResponse();

        $this->assertEquals(403, $response['status']);
    }

}
