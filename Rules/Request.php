<?php

class Bouncer_Rules_Request
{

    public static function load()
    {
        Bouncer::addRule('request', array('Bouncer_Rules_Request', 'request_headers'));
    }

    public static function request_headers($identity, $request)
    {
        $scores = array();

        $headers = $request['headers'];

        // Cookie, if it exists, it must not be blank
        if (isset($headers['Cookie']) && empty($headers['Cookie'])) {
            $scores[] = array(-7.5, 'Blank Cookie');
        }

        // Referer, if it exists, it must not be blank
        if (isset($headers['Referer'])) {
            if (empty($headers['Referer'])) {
                $scores[] = array(-7.5, 'Blank Referer (Bad Behavior: 69920ee5)');
            } else {
                // Like Bad Behavior: 45b35e30
                $purl = parse_url($headers['Referer']);
                if (empty($purl['host'])) {
                    $scores[] = array(-5, 'Invalid Referer');
                }
            }
        }

        // Proxy-Connection does not exist and should never be seen in the wild
        if (isset($headers['Proxy-Connection'])) {
            $scores[] = array(-5, 'Proxy-Connection header detected (Bad Behavior: b7830251)');
        }

        if (isset($headers['Proxy-Authentication']) && $headers['Proxy-Authentication'] == 'Basic Og==') {
            $scores[] = array(-5, 'Proxy-Authentication header detected');
        }

        // Proxy infos used in suspicious connections
        if (isset($headers['FORWARDED_FOR']) && isset($headers['Client-ip']) && isset($headers['Pragma'])) {
            $scores[] = array(-7.5, 'Suspicious proxy (FORWARDED_FOR)');
        }

        // Suspicious header (used by randomized user agents)
        if (isset($identity['headers']['Accept']) && $identity['headers']['Accept'] == 'text/html, text/plain') {
            $scores[] = array(-10, 'Suspicious Accept header value');
        }

        // Another Suspicious header
        if (isset($identity['headers']['Accept']) && $identity['headers']['Accept'] == 'text/*,*/*') {
            $scores[] = array(-5, 'Suspicious Accept header value');
        }
        if (isset($identity['headers']['Accept']) && $identity['headers']['Accept'] == 'text/*, */*') {
            $scores[] = array(-5, 'Suspicious Accept header value');
        }

        // Content Type is surely not for GET ... moron!
        // Well, but some legitimate agents doesn't know that ...
        if (isset($headers['Content-Type']) && $request['method'] == 'GET') {
            $scores[] = array(-5, 'Content-Type Header with a GET Request');
        }
        if (isset($headers['content-length']) && $request['method'] == 'GET') {
            $scores[] = array(-5, 'content-length Header with a GET Request');
        }

        if ($identity['ua'] == 'Mozilla/5.0' && isset($headers['TE']) && $headers['TE'] == 'deflate,gzip;q=0.3') {
            $scores[] = array(-10, 'libWWW signature detected (unknown)');
        }

        return $scores;
    }

}
