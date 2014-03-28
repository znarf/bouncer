<?php

class Bouncer_Rules_Basic
{

    public static function load()
    {
        Bouncer::addRule('browser_identity', array('Bouncer_Rules_Basic', 'browser_version'));
        Bouncer::addRule('browser_identity', array('Bouncer_Rules_Basic', 'os_version'));

        Bouncer::addRule('request', array('Bouncer_Rules_Basic', 'has_cookie'));
    }

    public static function browser_version($identity)
    {
        if ($identity['type'] != Bouncer::BROWSER) {
            return null;
        }

        $scores = array();

        $name = $identity['name'];
        $version = $identity['version'];

        $version = (int)$version;

        // plus
             if ($name == 'safari'   && $version >= 7)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'chrome'   && $version >= 21)   $scores[] = array(1, 'Recent Browser');
        else if ($name == 'firefox'  && $version >= 28)   $scores[] = array(1, 'Recent Browser');
        else if ($name == 'explorer' && $version >= 9)    $scores[] = array(1, 'Recent Browser');

        // minus
             if ($name == 'chrome'    && $version <= 16)  $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'firefox'   && $version <= 11)  $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'explorer'  && $version <= 7)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'netscape')                     $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'mozilla')                      $scores[] = array(-2.5, 'Old Browser');

        return $scores;
    }

    public static function os_version($identity)
    {
        if (empty($identity['os'])) {
            if ($identity['type'] == Bouncer::BROWSER) return -5;
            else return 0;
        }

        $scores = array();

        $os_name = $identity['os'][0];
        $os_version = $identity['os'][1];

        // plus
             if ($os_name == 'macosx' && strpos($os_version, '10.9') === 0) $scores[] = array(1, 'Recent OS');
        else if ($os_name == 'macosx' && strpos($os_version, '10.8') === 0) $scores[] = array(1, 'Recent OS');
        else if ($os_name == 'windows7')                                    $scores[] = array(1, 'Recent OS');

        // minus
        else if ($os_name == 'windows95') $scores[] = array(-2.5, 'Old OS');
        else if ($os_name == 'windows98') $scores[] = array(-2.5, 'Old OS');
        else if ($os_name == 'windowsnt') $scores[] = array(-2.5, 'Old OS');
        else if ($os_name == 'macppc')    $scores[] = array(-2.5, 'Old OS');

        return $scores;
    }

    public static function has_cookie($identity, $request)
    {
        $scores = array();

        if ($identity['name'] == 'rss-atom') {
            $scores[] = array(0, 'Identity cookie test skipped');
            return $scores;
        }

        if (isset($request['COOKIE']['bouncer-identity'])) {
            if ($request['COOKIE']['bouncer-identity'] == $identity['id']) {
                $scores[] = array(2.5, 'Good identity cookie detected');
            } else {
                $scores[] = array(-2.5, 'Wrong identity cookie detected');
            }
        }
        return $scores;
    }

}
