<?php

class Bouncer_Rules_Browser
{

    public static $explorer_browsers = array('msn', 'maxthon', 'deepnet', 'avantbrowser', 'aol', 'myie2', 'crazybrowser', 'kkman', 'acoo', 'netcaptor', 'sleipnir');

    public static $gecko_browsers = array('seamonkey', 'iceweasel', 'camino', 'flock', 'k-meleon', 'firebird', 'mozilla', 'icecat', 'swiftfox');

    public static $webkit_browsers = array('safari', 'chrome', 'chromium', 'webkit', 'midori', 'maxthon');

    public static $rss_browsers = array('netnewswire', 'reeder', 'liferea', 'vienna', 'thunderbird', 'akregator', 'rss-atom', 'explorerrss');

    public static function load()
    {
        Bouncer::addRule('browser_identity', array('Bouncer_Rules_Browser', 'browser_identity'));
        Bouncer::addRule('request', array('Bouncer_Rules_Browser', 'browser_request'));
    }

    public static function browser_identity($identity)
    {
        $scores = array();

        if ($identity['agent_type'] != Bouncer::BROWSER) {
            return $scores;
        }

        $name = $identity['agent_name'];
        $version = $identity['agent_version'];
        $headers = $identity['headers'];

        // Identify Explorer derivatives
        if (in_array($name, self::$explorer_browsers)) {
            $name = 'explorer';
        } elseif (in_array($name, self::$gecko_browsers)) {
            $name = 'firefox';
        }

        // Google Translate Exception
        if (isset($headers['Accept'], $headers['Accept-Charset'])) {
            if ($headers['Accept'] == 'text/html, text/plain, application/pdf, application/msword, */*' && $headers['Accept-Charset'] == 'utf-8,*') {
                $scores[] = array(0, 'Google Translate exception');
                return $scores;
            }
        }

        // Java library used to fake a browser identity
        if (isset($headers['Accept']) && $headers['Accept'] == 'text/html, image/gif, image/jpeg, *; q=.2, */*; q=.2') {
            $scores[] = array(-10, 'Java signature detected');
        }
        // Snoopy (or another) library used to fake a browser identity
        // Can theoritically be IE but that doesn't happen
        if (isset($headers['Accept']) && $headers['Accept'] == 'image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*') {
            $scores[] = array(-10, 'Suspicious Accept header value');
        }
        // Suspicious
        if (isset($headers['Accept']) && $headers['Accept'] == 'text/html, */*') {
            $scores[] = array(-5, 'Suspicious Accept header value');
        }
        // HTTrack used to fake a browser identity
        if (isset($headers['Accept-Encoding']) && $headers['Accept-Encoding'] == 'gzip, identity;q=0.9') {
            $scores[] = array(-10, 'HTTrack signature detected');
        }
        // Range header
        if (isset($headers['Range'])) {
            $scores[] = array(-5, 'range header detected');
        }

        // Legitimates browsers always send this Accept-* header
        if (in_array($name, Bouncer::$known_browsers)) {
            if (empty($headers['Accept'])) {
                $scores[] = array(-7.5, 'Accept header Missing (Bad Behavior: 17566707)');
            }
            if (empty($headers['Accept-Language'])) {
                $scores[] = array(-5, 'Accept-Language header missing');
            }
            if (empty($headers['Accept-Encoding'])) {
                $scores[] = array(-2.5, 'Accept-Encoding header missing');
            }
            // Accept-Encoding gzip
            if (isset($headers['Accept-Encoding']) && $headers['Accept-Encoding'] == 'gzip') {
                if (isset($identity['os'][0]) && $identity['os'][0] != 'android') { // android exception
                    $scores[] = array(-2.5, 'Accept-Encoding:gzip');
                }
            }
            // Only Explorer send this headers
            if ($name != 'explorer') {
                if (isset($headers['Accept']) && strpos($headers['Accept'], 'image/pjpeg') !== false) {
                    $scores[] = array(-5, 'Explorer Accept header');
                }
            }
        }

        if ($name == 'chrome') {
            if (isset($headers['Accept']) && $headers['Accept'] == 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8') {
                $scores[] = array(2.5, 'Expected Accept header (chrome)');
            }
            if (isset($headers['Accept']) && $headers['Accept'] == 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8') {
                $scores[] = array(-5, 'Unexpected Accept header (chrome)');
            }
            if (isset($headers['Accept-Encoding']) && $headers['Accept-Encoding'] == 'gzip,deflate,sdch') {
                $scores[] = array(2.5, 'Expected Accept-Encoding header (chrome)');
            }
            if (isset($headers['Accept-Encoding']) && $headers['Accept-Encoding'] == 'gzip, deflate') {
                $scores[] = array(-5, 'Unxpected Accept-Encoding header (chrome)');
            }
            if (isset($headers['Accept'], $headers['Accept-Language'], $headers['Accept-Encoding'])) {
                $scores[] = array(2.5, 'All Accept-* headers detected (chrome)');
            }
        } else {
            if (isset($headers['Accept']) && $headers['Accept'] == 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8') {
                $scores[] = array(-2.5, 'chrome Accept header');
            }
        }

        if ($name == 'firefox') {
            if (isset($headers['Accept']) && $headers['Accept'] == '*/*') {
                $scores[] = array(-7.5, '*/* Accept header (firefox)');
            }
            if (isset($headers['Accept']) && $headers['Accept'] == 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8') {
                $scores[] = array(2.5, 'Expected Accept header (firefox)');
            }
            if (strpos($identity['user_agent'], 'rv:') === false) {
                $scores[] = array(-5, 'No Mozilla platform token (firefox)');
            }
            if (isset($headers['Accept'], $headers['Accept-Language'], $headers['Accept-Encoding'])) {
                $scores[] = array(2.5, 'All Accept-* headers detected (firefox)');
            }
        }

        if ($name == 'opera') {
            if (isset($headers['Accept']) && $headers['Accept'] ==
                'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/webp, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1') {
                $scores[] = array(2.5, 'Expected Accept header (opera)');
            }
            if (isset($headers['Accept-Encoding']) && $headers['Accept-Encoding'] == 'gzip, deflate') {
                $scores[] = array(2.5, 'Expected Accept-Encoding header (opera)');
            }
            if (isset($headers['Accept'], $headers['Accept-Language'], $headers['Accept-Encoding'])) {
                $scores[] = array(2.5, 'All Accept-* headers detected (opera)');
            }
        } else {
            if (isset($headers['Accept']) && $headers['Accept'] ==
                'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/webp, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1') {
                $scores[] = array(-5, 'opera Accept header');
            }
        }

        if ($name == 'explorer') {
            if (isset($headers['Accept'])) {
                if ($headers['Accept'] == '*/*') {
                    $scores[] = array(-2.5, '*/* Accept header (explorer)');
                }
                elseif ($version != '9.0' && strpos($headers['Accept'], 'image/pjpeg') === false) {
                    $scores[] = array(-5, 'Bad Accept header (explorer)');
                }
                elseif ($version == '9.0' && $headers['Accept'] != 'text/html, application/xhtml+xml, */*') {
                    $scores[] = array(-5, 'Bad Accept header (explorer)');
                }
                elseif ($version == '9.0' && $headers['Accept'] == 'text/html, application/xhtml+xml, */*') {
                    $scores[] = array(5, 'Good Accept header (explorer)');
                }
            }
            if (isset($headers['Accept-Charset'])) {
                $scores[] = array(-5, 'Accept-Charset header detected (explorer)');
            }
        }

        if ($name == 'safari') {
            if (isset($headers['Accept']) &&
                $headers['Accept'] == 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8') {
                $scores[] = array(2.5, 'Expected Accept header (safari)');
            }
            if (isset($headers['Accept'], $headers['Accept-Language'], $headers['Accept-Encoding'])) {
                $scores[] = array(2.5, 'All Accept-* headers detected (safari)');
            }
        }

        return $scores;
    }

    public static function browser_request($identity, $request)
    {
        $scores = array();

        if ($identity['agent_type'] != Bouncer::BROWSER) {
            return $scores;
        }

        $name = $identity['agent_name'];
        $headers = $request['headers'];

        // Identify Explorer derivatives
        if (in_array($name, self::$explorer_browsers)) {
            $name = 'explorer';
        } elseif (in_array($name, self::$gecko_browsers)) {
            $name = 'firefox';
        }

        // LWP used to fake a browser identity
        if (isset($headers['Cookie2']) && $headers['Cookie2'] == '$Version="1"') {
            $scores[] = array(-5, 'Cookie2 header with value $Version="1" (lwp signature)');
        }
        // libWWW used to fake a browser identity
        if (isset($headers['TE']) && $headers['TE'] == 'deflate,gzip;q=0.3') {
            $scores[] = array(-10, 'libWWW signature detected (browser)');
        }

        if (in_array($name, Bouncer::$known_browsers)) {
            // Legitimate Browsers always send a Connection header
            if (empty($headers['Connection'])) {
                $scores[] = array(-5, 'Connection header Missing');
            // And never a Connection:Close header
            } elseif ($headers['Connection'] == 'Close') {
                $scores[] = array(-5, 'Connection header with value Close');
            }
        }

        switch ($name) {
            case 'firefox':
                // Real Firefox send this header
                if (isset($headers['Connection']) && $headers['Connection'] === 'keep-alive') {
                    $scores[] = array(2.5, 'Connection header with expected value');
                }
                if (isset($headers['Connection']) && $headers['Connection'] === 'Keep-Alive') {
                    $scores[] = array(-2.5, 'Connection header with unexpected value');
                }
                if (isset($headers['X-Moz']) && in_array($headers['X-Moz'], array('livebookmarks', 'prefetch'))) {
                    $scores[] = array(2.5, 'X-Moz header with expected value');
                }
                if (isset($headers['DNT']) && $headers['DNT'] == 1) {
                    $scores[] = array(2.5, 'DNT header with expected value');
                }
                break;
            case 'chrome':
                if (isset($headers['Connection']) && $headers['Connection'] === 'keep-alive') {
                    $scores[] = array(2.5, 'Connection header with expected value');
                }
                if (isset($headers['Connection']) && $headers['Connection'] === 'Keep-Alive') {
                    $scores[] = array(-2.5, 'Connection header with unexpected value');
                }
            case 'opera':
                // Real Opera send this header (but sometimes not)
                if (isset($headers['Cookie2']) && $headers['Cookie2'] == '$Version=1') {
                    $scores[] = array(2.5, 'Cookie2 header with value $Version=1');
                }
                if (isset($headers['TE']) && $headers['TE'] == 'deflate, gzip, chunked, identity, trailers') {
                    $scores[] = array(2.5, 'TE header with expected value');
                }
                break;
            case 'safari':
                if (isset($headers['Connection']) && $headers['Connection'] == 'keep-alive') {
                    $scores[] = array(2.5, 'Connection header with expected value');
                }
                break;
            case 'explorer':
                // Only legitimate browsers are setting this header
                if (isset($headers['UA-CPU'])) {
                    $scores[] = array(2.5, 'UA-CPU Header Detected');
                }
                if (isset($headers['Connection']) && $headers['Connection'] == 'Keep-Alive') {
                    $scores[] = array(2.5, 'Connection header with expected value (explorer)');
                }
                if (isset($headers['Cache-Control']) && $headers['Cache-Control'] == 'no-cache') {
                    if ($request['method'] == 'GET') {
                        $scores[] = array(-2.5, ' Cache-Control header with value no-cache (explorer)');
                    }
                }
                break;
        }

        // Welcome nicely users from Google
        if (!empty($request['headers']['Referer'])) {
            $preferer = parse_url($request['headers']['Referer']);
            if (isset($preferer['host']) && strpos($preferer['host'], 'google')) {
                $scores[] = array(5, 'Google as Referer');
            }
        }

        // Features challenges
        if (in_array($name, Bouncer::$known_browsers) && isset($identity['features'])) {
            $f = $identity['features'];
            if ($f['image'] <= -3 && $f['javascript'] <= -3) {
                $scores[] = array(-5, 'All features challenges failed (3x+)');
            } elseif ($f['image'] <= -1 && $f['javascript'] <= -1) {
                $scores[] = array(-2.5, 'All features challenges failed (1x+)');
            } elseif ($f['image'] >= 1 && $f['iframe'] >= 1 && $f['javascript'] >= 1) {
                $scores[] = array(2.5, 'All features challenges succeded');
            }
        }

        return $scores;
    }

}
