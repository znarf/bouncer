<?php

namespace Bouncer\Analyzer;

class Hostname
{

    public static function load($bouncer)
    {
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'hostnameAnalyzer'));
    }

    public static function hostnameAnalyzer($identity)
    {
        if (empty($identity['hostname']) || ($identity['hostname'] == $identity['addr'])) {
            $hostname = strtolower(gethostbyaddr($identity['addr']));
            if ($hostname && $hostname != $identity['addr']) {
                $identity['hostname'] = $hostname;
                $reverse = gethostbyname($hostname);
                if ($reverse && $reverse == $identity['addr']) {
                    $identity['reverse'] = true;
                } else {
                    $identity['reverse'] = false;
                }
            }
        }
        return $identity;
    }

}
