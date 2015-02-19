<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Backend;

/**
 * Base Backend class providing the Backend structure
 *
 * @author François Hodierne <francois@hodierne.net>
 */
abstract class AbstractBackend implements BackendInterface
{

    public function getIdentity($id)
    {
        return $this->get("identity-$id");
    }

    public function setIdentity($id, $identity)
    {
        return $this->set("identity-$id", $identity);
    }

    public function getConnection($id)
    {
        $connection = $this->get("connection-" . $id);
        if (empty($connection['id'])) {
            $connection['id'] = $id;
        }
        return $connection;
    }

    public function storeConnection($connection)
    {
        $key = isset($connection['id']) ? $connection['id'] : uniqid();
        $this->set("connection-" . $key, $connection);
        return $key;
    }

    public function __destruct()
    {
        try {
            $this->close();
        } catch (\Exception $e) {
            // do nothing
        }
    }

}
