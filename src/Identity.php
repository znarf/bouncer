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

    protected $attributes = [
        'id',
        'ua',
        'hua',
        'addr',
        'haddr',
        'headers',
        'fingerprint',
        'score',
        'host',
        'extension',
    ];

    /**
     * The unique id
     *
     * @var string
     */
    protected $id;

    /**
     * The user agent
     *
     * @var string
     */
    protected $ua;

    /**
     * Hash of the user agent
     *
     * @var string
     */
    protected $hua;

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
     * Host matching the IP address
     *
     * @var string
     */
    protected $host;

    /**
     * Country Code of the IP address
     *
     * @var string
     */
    protected $extension;

    /**
     * Bouncer Fingerprint for the identity
     *
     * @var string
     */
    protected $fingerprint;

    /**
     * Score, usually between -10 and 10, up to -100 and 100.
     *
     * @var integer
     */
    protected $score = 0;

    public function __construct($attributes = array())
    {
        if ($attributes) {
            $this->setAttributes($attributes);
        }
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

    public function getStatus()
    {
        // TODO: behavior should ideally be configurable in a Bouncer profile
        if ($this->score >= 10) {
            return Bouncer::NICE;
        } elseif ($this->score <= -10) {
            return Bouncer::BAD;
        } elseif ($this->score <= -5) {
            return Bouncer::SUSPICIOUS;
        } else {
            return Bouncer::NEUTRAL;
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

}
