<?php

class Bouncer_Rules_Httpbl
{

    protected static $max_age = 90;

    protected static $api_key = '';

    public static function load(array $options = array())
    {
        self::setOptions($options);
        Bouncer::addRule('ip_infos', array('Bouncer_Rules_Httpbl', 'ipInfos'));
        // Bouncer::addRule('browser_identity', array('Bouncer_Rules_Httpbl', 'test'));
        // Bouncer::addRule('robot_identity', array('Bouncer_Rules_Httpbl', 'test'));
    }

    public static function setOptions(array $options = array())
    {
        if (isset($options['api_key'])) {
            self::$api_key = $options['api_key'];
        }
        if (isset($options['max_age'])) {
            self::$max_age = $options['max_age'];
        }
    }

    public static function ipInfos($infos)
    {
        $result = self::get($infos['addr']);
        if ($result) {
            $infos['httpbl'] = true;
            $infos['addr_type'] = $result['type'];
            $infos['addr_comment'] = self::getComment($result['type']);
        }
        return $infos;
    }

    /*
    public static function test($identity)
    {
        $scores = array();

        if (isset($identity['httpbl'])) {
            $result = $identity['httpbl'];
        } else {
            $result = self::get($identity['addr']);
        }

        if (!empty($result)) {
            if ($result['type'] > 0 && $result['age'] <= self::$max_age) {
                if ($result['type'] > 1) {
                    $score = -5;
                } else {
                    $score = -2.5;
                }
                $score -= ceil($result['threat'] / 25 * 5);
                $scores[] = array($score, 'IP detected in HTTP:BL');
            }
        }

        return $scores;
    }
    */

    public static function get($ip)
    {
        if (self::is_ipv6($ip)) {
            return;
        }
        $find = implode('.', array_reverse(explode('.', $ip)));
        $query = self::$api_key . ".${find}.dnsbl.httpbl.org";
        $result = gethostbynamel($query);
        if (!empty($result)) {
            $ip = explode('.', $result[0]);
            if ($ip[0] == 127) {
                return array(
                    'age' => $ip[1], 'threat' => $ip[2], 'type' => $ip[3]
                );
            }
        }
    }

    public static function getComment($type)
    {
        if (isset($type)) {
            switch ($type) {
                case 0: return 'search';
                case 1: return 'susp';
                case 2: return 'harv';
                case 3: return 'susp + harv';
                case 4: return 'spam';
                case 5: return 'susp + spam';
                case 6: return 'harv + spam';
                case 7: return 'susp + harv + spam';
            }
        }
        return '';
    }

    // Quick and dirty check for an IPv6 address
    protected static function is_ipv6($address)
    {
        return (strpos($address, ":")) ? TRUE : FALSE;
    }

}
