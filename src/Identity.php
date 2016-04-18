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
     * Reputation
     *
     * @var array
     */
    protected $reputation;

    public function __construct($attributes = null)
    {
        parent::__construct($attributes);
        $address = $this->getAddress();
        $signature = $this->getSignature();
        if ($address && $signature) {
            $this->id = Bouncer::hash($signature->getId() . $address->getId());
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        if (is_object($address)) {
            $this->address = $address;
        } elseif (is_string($address) || is_array($address)) {
            $this->address = new Address($address);
        }
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
        $signature = new Signature(array('headers' => $headers));
        $this->setSignature($signature);
    }

    public function getSignature()
    {
        return $this->signature;
    }

    public function setSignature($signature)
    {
        if (is_object($signature)) {
            $this->signature = $signature;
        } elseif (is_array($signature)) {
            $this->signature = new Signature($signature);
        }
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent($userAgent)
    {
        if (is_object($userAgent)) {
            $this->userAgent = $userAgent;
        } elseif (is_array($userAgent)) {
            $this->userAgent = new UserAgent($userAgent);
        }
    }

    public function getReputation()
    {
        return $this->reputation;
    }

    public function getStatus()
    {
        $reputation = $this->getReputation();
        if (is_array($reputation) && array_key_exists('status', $reputation)) {
            return $reputation['status'];
        }
    }

    public function toArray()
    {
        $identity = array();

        if ($this->id) {
            $identity['id'] = $this->id;
        }

        return $identity;
    }

}
