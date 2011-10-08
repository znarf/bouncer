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

        // plus
             if ($name == 'safari'   && strpos($version, '5.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'chrome'   && strpos($version, '13.') === 0)   $scores[] = array(1, 'Recent Browser');
        else if ($name == 'chrome'   && strpos($version, '14.') === 0)   $scores[] = array(1, 'Recent Browser');
        else if ($name == 'chrome'   && strpos($version, '15.') === 0)   $scores[] = array(1, 'Recent Browser');
        else if ($name == 'firefox'  && strpos($version, '4.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'firefox'  && strpos($version, '5.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'firefox'  && strpos($version, '6.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'firefox'  && strpos($version, '7.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'firefox'  && strpos($version, '8.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'explorer' && strpos($version, '8.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'explorer' && strpos($version, '9.') === 0)    $scores[] = array(1, 'Recent Browser');
        else if ($name == 'opera'    && strpos($version, '11.') === 0)   $scores[] = array(1, 'Recent Browser');

        // minus
        else if ($name == 'explorer'  && strpos($version, '5.') === 0)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'explorer'  && strpos($version, '6.') === 0)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'konqueror' && strpos($version, '3.') === 0)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'netscape'  && strpos($version, '4.') === 0)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'netscape'  && strpos($version, '3.') === 0)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'firefox'   && strpos($version, '1.') === 0)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'firefox'   && strpos($version, '2.') === 0)   $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'opera' && strpos($version, '8.') === 0)       $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'opera' && strpos($version, '7.') === 0)       $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'opera' && strpos($version, '6.') === 0)       $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'chrome' && strpos($version, '9.') === 0)      $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'chrome' && strpos($version, '8.') === 0)      $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'chrome' && strpos($version, '7.') === 0)      $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'chrome' && strpos($version, '6.') === 0)      $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'chrome' && strpos($version, '5.') === 0)      $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'chrome' && strpos($version, '4.') === 0)      $scores[] = array(-2.5, 'Old Browser');
        else if ($name == 'mozilla')                                     $scores[] = array(-2.5, 'Old Browser');

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
        if ($os_name == 'macosx' && strpos($os_version, '10.6') === 0)     $scores[] = array(1, 'Recent OS');
        elseif ($os_name == 'macosx' && strpos($os_version, '10.7') === 0) $scores[] = array(1, 'Recent OS');
        else if ($os_name == 'windows7')                                   $scores[] = array(1, 'Recent OS');

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
