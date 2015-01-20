<?php

namespace Bouncer\Rules;

use Bouncer\Bouncer;

class Geoip
{

    protected static $_gi = null;

    public static function load()
    {
        Bouncer::addRule('ip_infos', array('\Bouncer\Rules\Geoip', 'ipInfos'));
    }

    public static function ipInfos($infos)
    {
        $infos['extension'] = self::country_code_by_addr($infos['addr'], $infos['host']);
        return $infos;
    }

    public static function country_code_by_addr($addr, $host)
    {
        // first run without geoip extension
        if (empty(self::$_gi) && !function_exists('geoip_country_code_by_name')) {
            require_once dirname(__FILE__) . "/../../lib/geoip.inc";
            self::$_gi = geoip_open(dirname(__FILE__) . "/../../lib/geoip.dat", GEOIP_STANDARD);
        }

        // without geoip extension
        if (isset(self::$_gi) && function_exists('geoip_country_code_by_addr')) {
            $code = geoip_country_code_by_addr(self::$_gi, $addr);

        // with geoip extension
        } elseif (function_exists('geoip_country_code_by_name')) {
            $code = geoip_country_code_by_name($host);
        }

        if (empty($code) || $code == 'AP' || $code == 'A1' || $code == 'A2') {
            $code = 'numeric';
        }
        $code = strtolower($code);
        return $code;
    }

}
