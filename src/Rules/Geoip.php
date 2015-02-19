<?php

namespace Bouncer\Rules;

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
        $bouncer->addRule('ip_infos', array('\Bouncer\Rules\Geoip', 'ipInfos'));
    }

    public static function ipInfos($infos)
    {
        $extension = self::countryCodeByAddr($infos['addr'], $infos['host']);
        if ($extension) {
            $infos['extension'] = self::countryCodeByAddr($infos['addr'], $infos['host']);
        }
        return $infos;
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
