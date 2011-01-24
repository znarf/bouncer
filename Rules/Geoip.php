<?php

class Bouncer_Rules_Geoip extends Bouncer
{

    protected static $_gi = null;

    public static function load()
    {
        Bouncer::addRule('ip_infos', array('Bouncer_Rules_Geoip', 'ipInfos'));
    }

    public static function ipInfos($infos)
    {
        // $notCountries = array('com', 'org', 'net', 'numeric', 'unknown');
        $infos['country'] = self::country_code_by_addr($infos['addr'], $infos['host']);
        // if (in_array($infos['extension'], $notCountries) && !in_array($infos['country'], $notCountries)) {
        //     $infos['extension'] = $infos['country'];
        // }
        $infos['extension'] = $infos['country'];
        return $infos;
    }

    public static function country_code_by_addr($addr, $host)
    {
        // first run without geoip extension
        if (empty(self::$_gi) && !function_exists('geoip_country_code_by_name')) {
            require_once dirname(__FILE__) . "/../lib/geoip.inc";
            self::$_gi = geoip_open(dirname(__FILE__) . "/../lib/geoip.dat", GEOIP_STANDARD);
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
