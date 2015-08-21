<?php

namespace Bouncer\Analyzer;

use Bouncer\Http;

class Cloud
{

    public static function load($bouncer)
    {
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'identityAnalyzer'));
    }

    public static function identityAnalyzer($identity)
    {
        $result = Http::query(
            'POST',
            'http://bouncer.h6e.net/identity',
            array(
                'addr'    => $identity['addr'],
                'headers' => $identity['headers']
            )
        );
        return $result ? $result + $identity : $identity;
    }

}
