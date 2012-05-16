<?php

class Bouncer_Rules_Robot
{

    public static function load()
    {
        Bouncer::addRule('robot_identity', array('Bouncer_Rules_Robot', 'robot_identity'));
    }

    public static function robot_identity($identity)
    {
        $scores = array();
        $score = 0;

        if ($identity['type'] != Bouncer::ROBOT || empty($identity['name'])) {
            return null;
        }

        $addr = $identity['addr'];
        $host = $identity['host'];
        $headers = $identity['headers'];

        switch ($identity['name']) {
            // top crawlers
            case 'google':
                $score += strpos($host, 'googlebot.com') === false ? -5 : 1;
                $score += empty($headers['From']) ? -5 : 1;
                break;
            case 'mediapartners':
                $score += strpos($host, 'googlebot.com') === false ? -5 : 2.5;
                $score += $identity['fingerprint'] != '4b8841489bb368a2e0defed8149bf912' ? -5 : 2.5;
                break;
            case 'googlemobile':
                $score += strpos($host, 'googlebot.com') === false ? -5 : 2.5;
                $score += empty($headers['From']) ? -5 : 2.5;
                break;
            case 'yahoo':
                $score += strpos($host, 'yahoo.') === false && strpos($host, 'aliyun.com') === false ? -5 : 2.5;
                break;
            case 'msnbot':
                $score += strpos($host, 'msn.com') === false && empty($headers['From']) ? -5 : 1;
                break;
            case 'voila':
                $score += strpos($host, 'fti.net') === false && strpos($host, 'voilabot.orange.fr') === false ? -5 : 2.5;
                $score += $identity['fingerprint'] != '6c0b28de5758f39928fa7a0075ff8786' ? -5 : 2.5;
                break;
            case 'orange':
                $score += strpos($host, 'fti.net') === false ? -5 : 2.5;
                break;
            case 'naverbot':
                $score += (strpos($host, 'naver.jp') === false && strpos($addr, '61.247.204.') === false) ? -5 : 1;
                break;
            case 'scoutjet':
                $score += strpos($host, 'scoutjet.com') === false ? -5 : 2.5;
                $score += $identity['fingerprint'] != 'b281d7c2562693921262c77d04c22499' ? -5 : 2.5;
                break;
            case 'baidu':
                $score += (strpos($host, 'baidu.')   === false
                        && strpos($addr, '119.63.')  === false
                        && strpos($addr, '123.125.') === false
                        && strpos($addr, '125.39.')  === false
                        && strpos($addr, '180.76.')  === false
                        && strpos($addr, '220.181.') === false) ? -5 : 2.5;
                break;
            case 'ask':
                $score += strpos($host, 'ask.com') === false ? -5 : 2.5;
                $score += $identity['fingerprint'] != '742b4a79a150f6ab785e558ddbf7aaa6' ? -5 : 2.5;
                break;
            case 'mailru':
                $score += strpos($host, 'mail.ru') === false ? -5 : 1;
                break;
            case 'twiceler':
                $score += strpos($host, 'cuil.com') === false ? -5 : 2.5;
                $score += $identity['fingerprint'] != 'b90c08ff5b5c8265dbfd9c6fa65f2e09' ? -5 : 2.5;
                break;
            case 'spinn3r':
                $score += strpos($host, 'spinn3r.com') === false && strpos($host, 'softlayer.com') === false ? -5 : 1;
                break;
            case 'picsearch':
                $score += strpos($host, 'picsearch.com') === false ? -5 : 2.5;
                break;
            case 'exabot':
                $score += strpos($host, 'exabot.com') === false ? -5 : 1;
                break;
            case 'entireweb':
                $score += strpos($host, 'entireweb.' === false) ? -2.5 : 1;
                $score += $identity['extension'] != 'se' ? -2.5 : 1;
                $score += empty($headers['From']) ? -2.5 : 1.5;
                $score += $identity['fingerprint'] != 'c2bff0ebec4c3dab9da8035e5219a0fd' ? -2.5 : 1.5;
                break;
            case 'alexa':
                $score += strpos($host, 'amazonaws.com') === false ? -5 : 1;
                $score += empty($headers['From']) ? -5 : 1;
                break;
            case 'daum':
                $score += $identity['fingerprint'] != 'c566ee1e58e2bfc09389b1d4f5790574' &&
                          $identity['fingerprint'] != 'c9150632a9b3f6ffd4f88c1732492a05' &&
                          $identity['fingerprint'] != '536cb87617e5a9ffdfae53365f116d89' ? -5 : 2.5;
                $score += $identity['extension'] != 'kr' ? -5 : 1;
                break;
            case 'soso':
                $score += (strpos($addr, '124.115.') === false && strpos($addr, '114.80.') === false) ? -5 : 2.5;
                break;
            case 'youdao':
                $score += strpos($addr, '61.135.') === false ? -5 : 2.5;
                break;
            case 'hatena':
                $score += $identity['fingerprint'] != '2d2155f7ce9b6b4f866fffa067a76a14' ? -5 : 1;
                $score += $identity['extension'] != 'jp' ? -5 : 1;
                break;
            case 'dotbot':
                $score += strpos($host, 'dotnetdotcom.org') === false ? -4 : 1;
                $score += $identity['extension'] != 'us' ? -3 : 1;
                $score += $identity['fingerprint'] != '1ba3e09e05c3a64578777e53d4f20a3c' ? -3 : 1;
                break;
            case 'sogou':
                $score += $identity['fingerprint'] != 'a86f74048055ff8ea8a8570615c478f4' &&
                          $identity['fingerprint'] != 'a6c9efa47da38d7946b4bb40d81f66ee' ? -5 : 2.5;
                $score += $identity['extension'] != 'cn' ? -5 : 2.5;
                break;
            case 'alexa':
                $score += strpos($host, 'amazonaws.com') === false ? -5 : 2.5;
                $score += empty($headers['From']) ? -5 : 2.5;
                break;
            case 'setooz':
                $score += strpos($host, 'setooz.com') === false ? -5 : 2.5;
                break;
            case 'goo':
                $score += strpos($host, 'super-goo.com') === false ? -5 : 2.5;
                break;
            case 'mlbot':
                $score += (strpos($addr, '66.219.58.') === false && strpos($addr, '71.41.201.') === false) ? -5 : 2.5;
                break;
            case 'feedburner':
                $score += $identity['fingerprint'] != 'cdcb44c8464c40d53a6f5635ee66d642' &&
                          $identity['fingerprint'] != '84e14e474b5972e7b11fae97d08fff4c' ? -5 : 2.5;
                $score += $identity['extension'] != 'us' ? -5 : 2.5;
                break;
            case 'netcraft':
                $score += strpos($host, 'amazonaws.com') === false && strpos($host, 'netcraft.com') === false ? -5 : 2.5;
                // $score += $identity['fingerprint'] != '6fdbdebe4a4e159db61b246974a63efb' ? -5 : 2.5;
                break;
            case 'radian6':
                $score += strpos($addr, '142.166.') === false &&
                          strpos($addr, '207.34.25') === false &&
                          strpos($host, 'amazonaws.com') === false &&
                          strpos($host, 'softlayer.com') === false ? -5 : 2.5;
                break;
            case 'socialmention':
                $score += $identity['fingerprint'] != 'a9b11c963519135d4b07c6b6ad36c0de' ? -5 : 2.5;
                break;
            case 'yandex':
                $score += strpos($host, 'yandex') === false ? -5 : 2.5;
                break;
            case 'friendfeed':
                $score += strpos($host, 'facebook.com') === false &&
                          strpos($addr, '69.63.180.') === false &&
                          strpos($addr, '69.171.233.') === false ? -5 : 2.5;
                break;
            case 'spbot':
                $score += strpos($host, 'amazonaws.com') === false ? -5 : 2.5;
                break;
            case 'superfeedr':
                $score += (strpos($host, 'superfeedr.com') === false && strpos($host, 'linode.com') === false) ? -5 : 2.5;
                break;
            case 'yahoo-pipes':
                $score += strpos($host, 'yahoo.') === false ? -5 : 2.5;
                break;
            case 'twitterfeed':
                $score += strpos($addr, '128.242.249.') === false ? -5 : 2.5;
                break;
            case 'tumblr':
                $score += strpos($host, 'theplanet.com') === false ? -2.5 : 1;
                $score += $identity['fingerprint'] != '58da13cc7b6dbfa72c81d8357f4dda0a' ? -2.5 : 1;
                break;
            case 'bdbrandprotect':
                $score += strpos($host, 'blink.ca') === false ? -5 : 2.5;
                break;
            case 'fairshare':
                $score += (strpos($addr, '209.249.') !== 0 && strpos($addr, '64.41.') !== 0) ? -5 : 2.5;
                break;
            case 'psbot':
                $score += strpos($host, 'picsearch.com') === false ? -5 : 2.5;
                break;
            case 'heritrix':
                $score += strpos($host, 'archive.org') === false ? -5 : 2.5;
                break;
            case 'ccbot':
                $score += (strpos($addr, '38.107.191.') !== 0 && strpos($addr, '38.107.179.') !== 0) ? -5 : 2.5;
                break;
            case 'postrank':
                $score += strpos($host, 'amazonaws.com') === false ? -5 : 2.5;
                break;
            case 'tagoo':
                $score += strpos($addr, '92.241.182.') !== 0 ? -5 : 2.5;
                break;
            case '123people':
                $score += strpos($addr, '91.206.113.') !== 0 ? -5 : 2.5;
                break;
            case 'rambler':
                $score += strpos($host, 'rambler.ru') === false ? -5 : 2.5;
                break;
            case 'wink':
                $score += strpos($host, 'wink.com') === false ? -5 : 2.5;
                break;
            case 'tabbloid':
                $score += strpos($host, 'austin.hp.com') === false ? -5 : 2.5;
                break;
            case 'livedoor':
                $score += strpos($host, 'data-hotel.net') === false ? -5 : 2.5;
                break;
            case 'feedblitz':
                $score += strpos($host, 'feedblitz.com') === false ? -5 : 2.5;
                break;
            case 'netvibes':
                $score += strpos($host, 'netvibes.com') === false ? -5 : 1;
                break;
            case 'yahoo-feed':
                $score += strpos($host, 'yahoo.net') === false ? -5 : 2.5;
                break;
            case 'googlefeeds':
                $score += (strpos($host, 'google.com') === false
                         && strpos($addr, '72.14.')  !== 0
                         && strpos($addr, '74.125.') !== 0
                         && strpos($addr, '66.249.') !== 0
                         && strpos($addr, '68.249.') !== 0
                         && strpos($addr, '209.85.') !== 0) ? -5 : 1;
                break;
            case 'bloglines':
                $score += strpos($host, 'bloglines.com') === false ? -5 : 1;
                break;
            case 'page2rss':
                $score += strpos($host, 'page2rss.com') === false ? -5 : 1;
                break;
            case 'icerocket':
                $score += strpos($host, 'icerocket.com') === false ? -5 : 2.5;
                $score += $identity['fingerprint'] != '261b05f8f307e382d8acce6f304f481e' ? -5 : 2.5;
                break;
            case 'surphace':
                $score += strpos($addr, '64.40.') !== 0 ? -5 : 2.5;
                break;
            case 'facebook':
                $score += (strpos($host, 'tfbnw.net') === false
                        && strpos($addr, '66.220.') !== 0
                        && strpos($addr, '69.63.')  !== 0
                        && strpos($addr, '69.171.') !== 0) ? -5 : 1;
                break;
            case 'bloglovin':
                $score += strpos($addr, '83.140.155.') !== 0 ? -5 : 2.5;
                break;
            case 'yahoo-china':
                $score += strpos($host, 'aliyun.com') === false && strpos($host, 'yahoo.net') === false ? -5 : 2.5;
                break;
            case 'sitesell':
                $score += strpos($host, 'sitebuildit.com') === false ? -5 : 2.5;
                break;
            case 'yottaa':
                $score += strpos($host, 'amazonaws.com') === false && strpos($host, 'linode.com') === false ? -5 : 2.5;
                break;
            case 'ezooms':
                $score += (strpos($addr, '208.115.111.') !== 0 && strpos($addr, '208.115.113.') !== 0) ? -5 : 2.5;
                $score += $identity['fingerprint'] != '7be77a95f238abe91d1891bbe787fdb3' ? -5 : 2.5;
                break;
            case 'ahrefs':
                $score += (strpos($addr, '213.186.') !== 0 && strpos($addr, '212.113.') !== 0) ? -5 : 2.5;
                $score += $identity['fingerprint'] != '9ea719f12db582a62aac760bb7225865' ||
                          $identity['fingerprint'] != '6f5f852fb824447f679c2a05e3221b28' ? -5 : 2.5;
                break;
        }

        if ($score >= 1) {
            $scores[] = array($score, 'Robot identity verified');
        } else if ($score == 0) {
            $scores[] = array($score, 'Robot identity not verified');
        } else if ($score <= -5) {
            $scores[] = array($score, 'Robot identity suspicious');
        } else {
            $scores[] = array($score, 'Robot identity ambigous');
        }

        return $scores;
    }

}
