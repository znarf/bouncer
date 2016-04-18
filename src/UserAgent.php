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

class UserAgent extends Resource
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
     * Agent
     *
     * @var object
     */
    protected $agent;

    /**
     * System
     *
     * @var object
     */
    protected $system;

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

    public function getAgent()
    {
        return $this->agent;
    }

    public function setAgent($agent)
    {
        if (is_object($agent)) {
            $this->agent = $agent;
        } elseif (is_array($agent)) {
            $this->agent = new UserAgentPart($agent);
        }
    }

    public function getSystem()
    {
        return $this->system;
    }

    public function setSystem($system)
    {
        if (is_object($system)) {
            $this->system = $system;
        } elseif (is_array($system)) {
            $this->system = new UserAgentPart($system);
        }
    }

}
