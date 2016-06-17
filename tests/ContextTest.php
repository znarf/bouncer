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

class ContextTest extends \PHPUnit_Framework_TestCase
{

    public function testString()
    {
        $bouncer = new Bouncer();

        $bouncer->addContext('key', 'value');
        $context = $bouncer->getContext();
        $this->assertEquals($context['key'], 'value');

        $bouncer->addContext('key', 'newvalue');
        $context = $bouncer->getContext();
        $this->assertEquals($context['key'], 'newvalue');
    }

    public function testArray()
    {
        $bouncer = new Bouncer();

        $bouncer->addContext('key', array('property' => 'value', 'property2' => 'value2'));
        $context = $bouncer->getContext();
        $this->assertEquals($context['key']['property'], 'value');

        $bouncer->addContext('key', array('property' => 'newvalue'));
        $context = $bouncer->getContext();
        $this->assertEquals($context['key']['property'], 'newvalue');
        $this->assertEquals($context['key']['property2'], 'value2');
    }

}
