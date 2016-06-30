<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Resource;

use Bouncer\Bouncer;
use Bouncer\Resource;

class Identity extends Resource
{

    /**
     * The unique id
     *
     * @var string
     */
    protected $id;

    /**
     * Type: browser or robot
     *
     * @var string
     */
    protected $type;

    /**
     * The Address
     *
     * @var Address
     */
    protected $address;

    /**
     * The Signature
     *
     * @var Signature
     */
    protected $signature;

    /**
     * The HTTP Headers
     *
     * @var array
     */
    protected $headers;

    /**
     * The User Agent
     *
     * @var UserAgent
     */
    protected $userAgent;

    /**
     * Session
     *
     * @var Session
     */
    protected $session;

    /**
     * Reputation
     *
     * @var array
     */
    protected $reputation;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = null)
    {
        parent::__construct($attributes);
        $address = $this->getAddress();
        $signature = $this->getSignature();
        if ($address && $signature) {
            $this->id = Bouncer::hash($signature->getId() . $address->getId());
        }
    }

    /*
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * @param string
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /*
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /*
     * @param string
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /*
     * @return Address|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /*
     * @param string|array|object $address
     */
    public function setAddress($address)
    {
        if (is_object($address)) {
            $this->address = $address;
        } elseif (is_string($address) || is_array($address)) {
            $this->address = new Address($address);
        }
    }

    /*
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /*
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        $signature = new Signature(array('headers' => $headers));
        $this->setSignature($signature);
    }

    /*
     * @return Signature|null
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /*
     * @param array|object $signature
     */
    public function setSignature($signature)
    {
        if (is_object($signature)) {
            $this->signature = $signature;
        } elseif (is_array($signature)) {
            $this->signature = new Signature($signature);
        }
    }

    /*
     * @return UserAgent|null
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /*
     * @param array|object $userAgent
     */
    public function setUserAgent($userAgent)
    {
        if (is_object($userAgent)) {
            $this->userAgent = $userAgent;
        } elseif (is_array($userAgent)) {
            $this->userAgent = new UserAgent($userAgent);
        }
    }

    /*
     * @return Session|null
     */
    public function getSession()
    {
        return $this->session;
    }

    /*
     * @param string|array|object $session
     */
    public function setSession($session)
    {
        if (is_object($session)) {
            $this->session = $session;
        } elseif (is_string($session) || is_array($session)) {
            $this->session = new Session($session);
        }
    }

    /*
     * @return array|null
     */
    public function getReputation()
    {
        return $this->reputation;
    }

    /*
     * @param array $reputation
     */
    public function setReputation($reputation)
    {
        $this->reputation = $reputation;
    }

    /*
     * @return string|null
     */
    public function getStatus()
    {
        $reputation = $this->getReputation();
        if (is_array($reputation) && array_key_exists('status', $reputation)) {
            return $reputation['status'];
        }
    }

    /*
     * @return bool
     */
    public function isNice()
    {
        return $this->getStatus() === Bouncer::NICE;
    }

    /*
     * @return bool
     */
    public function isSuspicious()
    {
        return $this->getStatus() === Bouncer::SUSPICIOUS;
    }

    /*
     * @return bool
     */
    public function isBad()
    {
        return $this->getStatus() === Bouncer::BAD;
    }

    /*
     * @return string|null
     */
    public function getAgentName()
    {
        $userAgent = $this->getUserAgent();
        if ($userAgent) {
            return $userAgent->getAgentName();
        }
    }

    /*
     * @return string|null
     */
    public function getSystemName()
    {
        $userAgent = $this->getUserAgent();
        if ($userAgent) {
            return $userAgent->getSystemName();
        }
    }

    /*
     * @return array
     */
    public function toArray()
    {
        $identity = array();

        if ($this->id) {
            $identity['id'] = $this->id;
        }

        return $identity;
    }

}
