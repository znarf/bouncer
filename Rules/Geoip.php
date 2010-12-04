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
        $infos['country'] = self::country_code_by_addr($infos['addr']);
        // if (in_array($infos['extension'], $notCountries) && !in_array($infos['country'], $notCountries)) {
        //     $infos['extension'] = $infos['country'];
        // }
        $infos['extension'] = $infos['country'];
        return $infos;
    }

    public static function country_code_by_addr($addr)
    {
        if (empty(self::$_gi)) {
            require_once dirname(__FILE__) . "/../lib/geoip.inc";
            self::$_gi = geoip_open(dirname(__FILE__) . "/../lib/geoip.dat", GEOIP_STANDARD);
        }
        $code = geoip_country_code_by_addr(self::$_gi, $addr);
        if (empty($code) || $code == 'AP' || $code == 'A1' || $code == 'A2') {
            $code = 'numeric';
        }
        $code = strtolower($code);
        return $code;
    }

}
