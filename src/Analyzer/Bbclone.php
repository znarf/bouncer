<?php

namespace Bouncer\Analyzer;

use Bouncer\Bouncer;

class Bbclone
{

    public static $browser;

    public static $robot;

    public static $os;

    public static function load($bouncer)
    {
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'identityAnalyzer'));
    }

    public static function identityAnalyzer(array $identity)
    {
        $robot = self::detect('robot', $identity['ua']);
        if ($robot) {
            $identity['agent_type'] = Bouncer::ROBOT;
            $identity['agent_name'] = $robot[0];
            $identity['agent_version'] = $robot[1];
            $identity['agent_label'] = self::getTitle('robot', $robot[0], $robot[1]);
        } else {
            $browser = self::detect('browser', $identity['ua']);
            if ($browser) {
                $identity['agent_type'] = Bouncer::BROWSER;
                $identity['agent_name'] = $browser[0];
                $identity['agent_version'] = $browser[1];
                $identity['agent_label'] = self::getTitle('browser', $browser[0], $browser[1]);
                $os = self::detect('os', $identity['ua']);
                if ($os) {
                    $identity['system_name'] = $os[0];
                    $identity['system_version'] = $os[1];
                    $identity['system_label'] = self::getTitle('os', $os[0], $os[1]);
                }
            }
        }
        return $identity;
    }

    public static function getList($type)
    {
        if (in_array($type, array('browser', 'robot', 'os'))) {
            if (isset(self::$$type)) {
                return self::$$type;
            }
            require dirname(__FILE__) . "/../../lib/{$type}.php";
            return self::$$type = $$type;
        }
    }

    public static function getTitle($type, $name, $version)
    {
        $list = self::getList($type);
        $title = isset($list[$name]['title']) ? $list[$name]['title'] : $name;
        if ($version) {
            $title .= ' ' . $version;
        }
        return $title;
    }

    protected static function detect($type = 'browser', $ua)
    {
        foreach (self::getList($type) as $name => $properties) {
            if ($name == 'other') {
                continue;
            }
            foreach ($properties['rule'] as $pattern => $note) {
                if (preg_match('~'.$pattern.'~i', $ua, $regs)) {
                     $version = '';
                     if (preg_match(":\\\\[\d]{1}:", $note)) {
                        $version = preg_replace(":\\\\([\d]{1}):", "\$regs[\\1]", $note);
                        eval("\$version = \"$version\";");
                    }
                    return array($name, $version);
                }
            }
        }
    }

}
