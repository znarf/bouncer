<?php

class Bouncer_Rules_Fingerprint
{

    protected static $_cache = array();

    public static function load()
    {
        Bouncer::addRule('browser_identity', array('Bouncer_Rules_Fingerprint', 'analyseIdentity'));
        Bouncer::addRule('robot_identity', array('Bouncer_Rules_Fingerprint', 'analyseIdentity'));
    }

    public static function analyseIdentity($identity)
    {
        $scores = array();

        $name = $identity['agent_name'];
        $fingerprint = $identity['fingerprint'];

        if (in_array($name, Bouncer::$known_browsers)) {
            if (in_array($fingerprint, self::get("browser.$name"))) {
                $scores[] = array(10, 'Browser Fingerprint');
                return $scores;
            }
        }

        if (in_array($fingerprint, self::get('known'))) {
            $scores[] = array(0, 'Known Fingerprint');
        } else if (in_array($fingerprint, self::get('banned'))) {
            $scores[] = array(-10, 'Banned Fingerprint');
        } else if (in_array($fingerprint, self::get('suspicious'))) {
            $scores[] = array(-5, 'Suspicious Fingerprint');
        }

        return $scores;
    }

    public static function getType($identity)
    {
        $name = $identity['agent_name'];
        $fingerprint = $identity['fingerprint'];

        if (in_array($name, Bouncer::$known_browsers)) {
            if (in_array($fingerprint, self::get("browser.$name"))) {
                return 'browser';
            }
        }

        if (in_array($fingerprint, self::get('known'))) {
            return 'known';
        } elseif (in_array($fingerprint, self::get('banned'))) {
            return 'banned';
        } elseif (in_array($fingerprint, self::get('suspicious'))) {
            return 'suspicious';
        }

        return '';
    }

    public static function get($type)
    {
        if (isset(self::$_cache[$type])) {
            return self::$_cache[$type];
        }
        return self::$_cache[$type] = include dirname(__FILE__) . '/../fingerprints/' . $type . '.php';
    }

}
