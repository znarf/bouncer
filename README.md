# Bouncer

[![Build Status](https://travis-ci.org/znarf/bouncer.svg?branch=master)](https://travis-ci.org/znarf/bouncer)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/znarf/bouncer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/znarf/bouncer/?branch=master)

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
