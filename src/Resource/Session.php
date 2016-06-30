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

use Bouncer\Resource;

class Session extends Resource
{

    /**
     * The unique id
     *
     * @var string
     */
    protected $id;

    /**
     * Blocked status
     *
     * @var bool
     */
    protected $blocked;

    /**
     * @param array|string $attributes
     */
    public function __construct($attributes = null)
    {
        if (is_string($attributes)) {
            $this->setId($attributes);
        } elseif (is_array($attributes)) {
            parent::__construct($attributes);
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
     * @return bool
     */
    public function isBlocked()
    {
        return $this->blocked === true;
    }

    /*
     * @param bool
     */
    public function setBlocked($blocked)
    {
        return $this->blocked = $blocked;
    }

}
