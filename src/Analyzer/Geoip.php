<?php

namespace Bouncer\Analyzer;

use Exception;
use Bouncer\Bouncer;
use GeoIp2\Database\Reader;

class Geoip
{

    protected static $reader;

    public static function getReader()
    {
        if (empty(self::$reader)) {
            self::$reader = new Reader(__DIR__ . '/../../lib/GeoLite2-Country.mmdb');
        }
        return self::$reader;
    }

    public static function load($bouncer)
    {
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'identityAnalyzer'));
    }

    public static function identityAnalyzer(array $identity)
    {
        $extension = self::countryCodeByAddr($identity['addr'], $identity['host']);
        if ($extension) {
            $identity['extension'] = $extension;
        }
        return $identity;
    }

    public static function countryCodeByAddr($addr, $host)
    {
        $reader = self::getReader();
        try {
            $record = $reader->country($addr);
            $extension = strtolower($record->country->isoCode);
        } catch (Exception $e) {
            $extension = null;
        }
        return $extension;
    }

}
