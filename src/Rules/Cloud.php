<?php

namespace Bouncer\Rules;

use Bouncer\Bouncer;

class Cloud
{

    public static function load($bouncer)
    {
        $bouncer->addRule('identity_infos', array('\Bouncer\Rules\Cloud', 'identityInfos'));
    }

    public static function identityInfos($identity)
    {
        $result = self::query(
            'POST',
            'http://bouncer.h6e.net/identity',
            array(
                'addr'        => $identity['addr'],
                'headers'     => $identity['headers']
            )
        );
        $identity = $result + $identity;
        return $identity;
    }

    public static function query($method, $url, $data = null)
    {
        $options = array(
            'http' => array(
                'method' => $method,
                'header' => "User-Agent: Bouncer\r\n"
            )
        );
        if ($data) {
            $content = json_encode($data);
            $length = strlen($content);
            $options['http']['header'] .= "Content-Type: application/json\r\n";
            $options['http']['header'] .= "Content-Length: {$length}\r\n";
            $options['http']['content'] = $content;
        }
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result ? json_decode($result, true) : null;
    }

}
