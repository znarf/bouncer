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

class Identity
{

    protected $attributes = array(
        'id',
        'addr',
        'haddr',
        'headers',
        'fingerprint',
        'session',
        'hostname',
        'reverse',
        'extension',
        'type',
        'status',
    );

    /**
     * The unique id
     *
     * @var string
     */
    protected $id;

    /**
     * The IP address
     *
     * @var string
     */
    protected $addr;

    /**
     * Hash of the IP address
     *
     * @var string
     */
    protected $haddr;

    /**
     * The HTTP Headers
     *
     * @var string
     */
    protected $headers;

    /**
     * Bouncer Fingerprint for the identity
     *
     * @var string
     */
    protected $fingerprint;

    /**
     * Session Id
     *
     * @var string
     */
    protected $session;

    /**
     * Protocol
     *
     * @var string
     */
    protected $protocol;

    /**
     * Host matching the IP address
     *
     * @var string
     */
    protected $hostname;

    /**
     * If the dns match the hostname
     *
     * @var string
     */
    protected $reverse;

    /**
     * Country Code of the IP address
     *
     * @var string
     */
    protected $extension;

    /**
     * Type: Browser, Robot or Unknown
     *
     * @var string
     */
    protected $type;

    /**
     * Status: Nice, Ok, Suspicous, Bad
     *
     * @var string
     */
    protected $status;

    public function __construct($attributes = array())
    {
        if ($attributes) {
            $this->setAttributes($attributes);
        }
    }

    public function hasAttribute($key)
    {
        return isset($this->$key);
    }

    public function getAttribute($key)
    {
        return isset($this->$key) ? $this->$key : null;
    }

    public function getAttributes()
    {
        return $this->toArray();
    }

    public function setAttribute($key, $value)
    {
        $this->$key = $value;
    }

    public function setAttributes($attributes = array())
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    public function toArray()
    {
        $identity = array();

        foreach ($this->attributes as $key) {
            $identity[$key] = isset($this->$key) ? $this->$key : null;
        }

        return $identity;
    }

    public function __call($name, $arguments)
    {
        foreach (array('get', 'set') as $action) {
            if (strpos($name, $action) === 0) {
                $key = substr($name, strlen($action));
                $key = lcfirst($key);
                return call_user_func_array(array($this, "{$action}Attribute"), array($key));
            }
        }
        throw new \Exception("Unknown method ($name).");
    }

}
