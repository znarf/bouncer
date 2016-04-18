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

class LogstashLogger extends BaseLogger
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
    public function log(array $logEntry)
    {
        $message = (string)$logEntry['request'];

        $entry = $this->format($logEntry);

        $logger = $this->getLogger();
        if ($logger) {
            $logger->info($message, $entry);
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
