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

    /*
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /*
     * @param string $id
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
     * @param string $type robot|browser
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /*
     * @return object|null
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /*
     * @param object|array $agent
     */
    public function setAgent($agent)
    {
        if (is_object($agent)) {
            $this->agent = $agent;
        } elseif (is_array($agent)) {
            $this->agent = new UserAgentPart($agent);
        }
    }

    /*
     * @return string|null
     */
    public function getAgentName()
    {
        $agent = $this->getAgent();
        if ($agent) {
            return $agent->getName();
        }
    }

    /*
     * @return object|null
     */
    public function getSystem()
    {
        return $this->system;
    }

    /*
     * @param object|array $system
     */
    public function setSystem($system)
    {
        if (is_object($system)) {
            $this->system = $system;
        } elseif (is_array($system)) {
            $this->system = new UserAgentPart($system);
        }
    }

    /*
     * @return string|null
     */
    public function getSystemName()
    {
        $system = $this->getSystem();
        if ($system) {
            return $system->getName();
        }
    }

}
