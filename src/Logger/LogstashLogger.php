<?php

/*
 * This file is part of the Bouncer package.
 *
 * (c) François Hodierne <francois@hodierne.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bouncer\Logger;

use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

use Bouncer\Identity;
use Bouncer\Request;

class LogstashLogger implements LoggerInterface
{

    protected $host;

    protected $port;

    protected $protocol;

    protected $channel;

    protected $type;

    protected $logger;

    public function __construct($host, $port, $protocol = 'udp', $channel = 'bouncer', $type = 'access_log')
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->protocol = $protocol;
        $this->channel  = $channel;
        $this->type     = $type;
    }

    /**
     * {@inheritDoc}
     */
    public function log($connection, Identity $identity, Request $request)
    {
        $message = $request->__toString();

        $context = $connection;
        $context['request']    = $request->toArray();
        $context['identity']   = $identity->toArray();

        // This values are already available in other fields, so we remove them.
        unset($context['identity']['addr']);
        unset($context['identity']['ua']);
        unset($context['identity']['headers']);

        $logger = $this->getLogger();
        if ($logger) {
            $logger->info($message, $context);
        }
    }

    public function getLogger()
    {
        if (isset($this->logger)) {
            return $this->logger;
        }

        $logger = new Logger($this->channel);

        $formatter = new LogstashFormatter(
            $this->type, $systemName = null, $extraPrefix = null, $contextPrefix = '', LogstashFormatter::V1);

        $stream = stream_socket_client("{$this->protocol}://{$this->host}:{$this->port}", $errno, $errstr);
        if (!$stream) {
            error_log("Unable to connect to '{$this->protocol}://{$this->host}': {$errstr} ({$errno})");
            return $this->logger = false;
        }

        $streamHandler = new StreamHandler($stream);
        $streamHandler->setFormatter($formatter);
        $logger->pushHandler($streamHandler);

        return $this->logger = $logger;
    }

}
