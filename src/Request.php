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

    public function getHeaders($names = [])
    {
        $headers = [];
        foreach ($names as $name) {
            $headers[$name] = $this->getHeader($name);
        }
        return array_filter($headers);
    }

    public function getAllHeaders($ignore = array())
    {
        $headers = [];
        foreach ($this->headers->all() as $name => $value) {
            if (!in_array($name, $ignore)) {
                $headers[$name] = $this->headers->get($name);
            }
        }
        return $headers;
    }

    public function getProtocol()
    {
        return $this->server->get('SERVER_PROTOCOL');
    }

    public function __toString()
    {
        return $this->getMethod() . ' ' . $this->getHost() . ' ' . $this->getPort() . ' ' . $this->getBaseUrl();
    }

    public function toArray()
    {
        $request = [];

        $request['addr']     = $this->getAddr();

        $request['scheme']   = $this->getScheme();
        $request['method']   = $this->getMethod();
        $request['host']     = $this->getHost();
        $request['port']     = $this->getPort();
        $request['url']      = $this->getBaseUrl();
        $request['protocol'] = $this->getProtocol();

        // Headers
        $ignore = array_merge(array('host', 'cookie'));
        $request['headers'] = $this->getAllHeaders($ignore);

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
