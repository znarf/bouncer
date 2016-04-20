<?php

namespace Bouncer\Analyzer;

class Hostname
{

    public static function load($bouncer)
    {
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'hostnameAnalyzer'));
    }

    /*
     *
     * @param object
     *
     * @return object
     */
    public static function hostnameAnalyzer($identity)
    {
        $address = $identity->getAddress();
        if (!$address->getHostname()) {
            $hostname = strtolower(gethostbyaddr($address->getValue()));
            if ($hostname && $hostname != $address->getValue()) {
                $address->setHostname($hostname);
                $reverseAddress = gethostbyname($hostname);
                if ($reverseAddress && $reverseAddress == $address->getValue()) {
                    $address->setAttribute('reverse', true);
                } else {
                    $address->setAttribute('reverse', false);
                }
            }
        }
        return $identity;
    }

}
