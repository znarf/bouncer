<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer;

use Symfony\Component\HttpFoundation\Request as SfRequest;

class Request extends SfRequest
{

    const HEADER_SERVER_PROTOCOL = 'server_protocol';

    const HEADER_CLIENT_CONNECTION = 'client_connection';

    protected static $extraTrustedHeaders = array();

    public static function setExtraTrustedHeaderName($key, $value)
    {
        self::$extraTrustedHeaders[$key] = $value;
    }

    public function getAddr()
    {
        return $this->getClientIp();
    }

    public function getUserAgent()
    {
        $userAgent = $this->getHeader('User-Agent');
        return $userAgent ? $userAgent : '';
    }

    public function getHeader($name)
    {
        return $this->headers->get($name);
    }

    public function getAllHeaders($ignore = array())
    {
        $headers = array();
        foreach ($this->headers->all() as $name => $value) {
            if (!$ignore || !in_array($name, $ignore)) {
                $headers[$name] = $this->headers->get($name);
            }
        }
        return $headers;
    }

    public function getHeaders()
    {
        $ignore = array('host', 'cookie');

        $headers = $this->getAllHeaders($ignore);

        $connection = $this->getConnection();
        if ($connection) {
            $headers['connection'] = $connection;
        } else {
            unset($headers['connection']);
        }

        return $headers;
    }

    public function getProtocol()
    {
        if (self::$trustedProxies) {
            if (isset(self::$extraTrustedHeaders[self::HEADER_SERVER_PROTOCOL])) {
                return $this->headers->get(self::$extraTrustedHeaders[self::HEADER_SERVER_PROTOCOL]);
            }
        }

        return $this->server->get('SERVER_PROTOCOL');
    }

    public function getConnection()
    {
        if (self::$trustedProxies) {
            if (isset(self::$extraTrustedHeaders[self::HEADER_CLIENT_CONNECTION])) {
                return $this->headers->get(self::$extraTrustedHeaders[self::HEADER_CLIENT_CONNECTION]);
            }
        }

        return $this->headers->get('connection');
    }

    public function __toString()
    {
        return $this->getMethod() . ' ' . $this->getHost() . ' ' . $this->getPort() . ' ' . $this->getRequestUri();
    }

    public function toArray()
    {
        $request = array();

        $request['addr']       = $this->getAddr();
        $request['scheme']     = $this->getScheme();
        $request['method']     = $this->getMethod();
        $request['host']       = $this->getHost();
        $request['port']       = $this->getPort();
        $request['url']        = $this->getRequestUri();
        $request['protocol']   = $this->getProtocol();
        $request['headers']    = $this->getHeaders();

        // Parameters
        $queryAll = $this->query->all();
        if (!empty($queryAll)) {
            $request['query_parameters'] = $queryAll;
        }
        $requestAll = $this->request->all();
        if (!empty($requestAll)) {
            $request['post_parameters'] = $requestAll;
        }
        $cookiesAll = $this->cookies->all();
        if (!empty($cookieAll)) {
            $request['cookies'] = $cookiesAll;
        }

        return $request;
    }

}
