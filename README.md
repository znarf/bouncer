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

$bouncer = new Bouncer();

$bouncer->start();
```

## Access Watch

Bouncer currently run best with the Access Watch "cloud" service.

You will need an API key for it. See http://access.watch/

The Access Watch profile will setup the Analyzer and Logger automatically for you.

```php
<?php

use \Bouncer\Bouncer;

```php
$bouncer = new Bouncer(array(
  'profile' => new \Bouncer\Profile\AccessWatch(array(
    'apiKey' => 'ACCESS_WATCH_API_KEY_HERE',
  ))
));
```

## Cache

To properly operate, a cache backend needs to be defined. If no cache is set, Bouncer will try to use APC/APCu.

```php
<?php

use \Bouncer\Bouncer;

$memcache = new Memcache();
$memcache->addServer('localhost');

$bouncer = new Bouncer(array(
  'cache' => \Bouncer\Cache\Memcache($memcache)
));

$bouncer->start();
```

### Author

François Hodierne - <francois@hodierne.net> - <http://francois.hodierne.net/>

### License

Bouncer is licensed under the MIT License - see the `LICENSE` file for details
