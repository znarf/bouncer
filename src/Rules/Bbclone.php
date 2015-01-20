<?php

namespace Bouncer\Rules;

use Bouncer\Bouncer;

class Bbclone
{

    public static $browser;

    public static $robot;

    public static $os;

    public static function load()
    {
        Bouncer::addRule('agent_infos', array('\Bouncer\Rules\Bbclone', 'agentInfos'));
    }

    public static function agentInfos($infos)
    {
        $robot = self::detect('robot', $infos['ua']);
        if ($robot) {
            $infos['agent_type'] = Bouncer::ROBOT;
            $infos['agent_name'] = $robot[0];
            $infos['agent_version'] = $robot[1];
            $infos['agent_label'] = self::getTitle('robot', $robot[0], $robot[1]);
        } else {
            $browser = self::detect('browser', $infos['ua']);
            if ($browser) {
                $infos['agent_type'] = Bouncer::BROWSER;
                $infos['agent_name'] = $browser[0];
                $infos['agent_version'] = $browser[1];
                $infos['agent_label'] = self::getTitle('browser', $browser[0], $browser[1]);
                $os = self::detect('os', $infos['ua']);
                if ($os) {
                    $infos['system_name'] = $os[0];
                    $infos['system_version'] = $os[1];
                    $infos['system_label'] = self::getTitle('os', $os[0], $os[1]);
                }
            }
        }
        return $infos;
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
