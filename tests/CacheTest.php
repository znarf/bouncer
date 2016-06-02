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

class CacheTest extends \PHPUnit_Framework_TestCase
{

    public function testMemcached()
    {
      if (!class_exists('Memcached')) {
        $this->markTestSkipped('The Memcached extension is not available.');
        return;
      }

      $client = new \Memcached;
      $cache = new \Bouncer\Cache\Memcache(array('client' => $client));
      $bouncer = new \Bouncer\Bouncer(array('cache' => $cache));
      $this->assertInstanceOf('\\Bouncer\\Cache\\Memcache', $bouncer->getCache());
      $this->assertInstanceOf('\\Memcached', $bouncer->getCache()->getClient());
    }

}
