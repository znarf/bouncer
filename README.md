# Bouncer

A PHP library to log and analyse HTTP traffic, throttle and block suspicious agents.

## Installation

Install the latest version with

```bash
$ composer require bouncer/bouncer
```

## Basic Usage

Start Bouncer as soon as possible in your codebase.

```php
<?php

use \Bouncer\Bouncer;

$bouncer = new Bouncer;

$bouncer->start();
```

## Caching

To properly operate, a cache backend needs to be used. If no cache is defined, Bouncer will try to use APC/APCu.

```php
<?php

use \Bouncer\Bouncer;

$memcache = new Memcache();
$memcache->addServer('localhost');

$bouncer = new Bouncer([
  'cache' => \Bouncer\Cache\Memcache($memcache)
]);

$bouncer->start();
```

## Logger

By default, Bouncer doesn't log anywhere. Define a logging backend where to send the requests.

Example to logstash:

```php
<?php

use \Bouncer\Bouncer;

$bouncer = new Bouncer([
  'logger' => \Bouncer\Logger\LogstashLogger('localhost', 5145)
]);

$bouncer->start();
```

## Analyzer

Bouncer run best with the Access Watch "cloud" analyzer.
This is a separate service and you will need an API key for it.
See http://access.watch/

```php
<?php

use \Bouncer\Bouncer;

$accessWatchAnalyzer = new \Bouncer\Analyzer\AccessWatch([
  'apiKey' => '9b89020149ff37e69fbec4634ae57b46'
]);

$bouncer = new Bouncer;

$bouncer->registerAnalyzer('identity', array($accessWatchAnalyzer, 'identityAnalyzer'));

$bouncer->start();
```

### Author

François Hodierne - <francois@hodierne.net> - <http://francois.hodierne.net/>

### License

Bouncer is licensed under the MIT License - see the `LICENSE` file for details
