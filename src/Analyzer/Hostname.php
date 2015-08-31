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
        if (empty($identity['host']) || ($identity['host'] == $identity['addr'])) {
            $hostname = strtolower(gethostbyaddr($identity['addr']));
            if ($hostname && $hostname != $identity['addr']) {
              $reverse = gethostbyname($hostname);
              if ($reverse && $reverse == $identity['addr']) {
                $identity['host'] = $hostname;
              }
            }
        }
        return $identity;
    }

}
