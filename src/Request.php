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

use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class Request extends HttpFoundationRequest
{

    protected $addr;

    protected $protocol;

    protected $body;

    protected $connection;

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
            if (empty($ignore) || !in_array($name, $ignore)) {
                $headers[$name] = $this->headers->get($name);
            }
        }
        return $headers;
    }

    public function getHeaders()
    {
        $ignore = array('host', 'cookie', 'connection');

        $headers = $this->getAllHeaders($ignore);

        $connection = $this->getConnection();
        if (isset($connection)) {
            $headers['connection'] = $connection;
        }

        return $headers;
    }

    public function getCookie($name)
    {
        return $this->cookies->get($name);
    }

    public function getCookies($names = array())
    {
        $cookies = array();
        foreach ($this->cookies->all() as $name => $value) {
            if (in_array($name, $names)) {
                $cookies[$name] = $this->cookies->get($name);
            }
        }
        return $cookies;
    }

    public function getAddr()
    {
        if ($this->addr) {
            return $this->addr;
        }

        return $this->getClientIp();
    }

    public function setAddr($addr)
    {
        $this->addr = $addr;

        return $this;
    }

    /*
     * @return string|null
     */
    public function getProtocol()
    {
        if ($this->protocol) {
            return $this->protocol;
        }

        return $this->server->get('SERVER_PROTOCOL');
    }

    /*
     * @param string
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;

        return $this;
    }

    /*
     * @return string|null
     */
    public function getConnection()
    {
        if ($this->connection) {
            return $this->connection;
        }

        return $this->headers->get('connection');
    }

    /*
     * @param string
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /*
     * @return string|null
     */
    public function getBody()
    {
        if ($this->body) {
            return $this->body;
        }
    }

    /*
     * @param string
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    public function __toString()
    {
        return $this->getMethod() . ' ' . $this->getHost() . ' ' . $this->getPort() . ' ' . $this->getRequestUri();
    }

    public function toArray()
    {
        $request = array();

        $request['scheme']  = $this->getScheme();
        $request['method']  = $this->getMethod();
        $request['host']    = $this->getHost();
        $request['port']    = $this->getPort();
        $request['url']     = $this->getRequestUri();
        $request['headers'] = $this->getHeaders();

        $protocol = $this->getProtocol();
        if (isset($protocol)) {
            $request['protocol'] = $protocol;
        }

        $body = $this->getBody();
        if (isset($body)) {
            $request['body'] = $body;
        }

        return $request;
    }

}
