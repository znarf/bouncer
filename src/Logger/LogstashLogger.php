<?php

namespace Bouncer\Logger;

use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogstashLogger
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

    public function log($message, $values = [])
    {
        $logger = $this->getLogger();
        if ($logger) {
            $logger->info($message, $values);
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
            error_log("Unable to connect to '{$protocol}://{$host}': {$errstr} ({$errno})");
            return $this->logger = false;
        }

        $streamHandler = new StreamHandler($stream);
        $streamHandler->setFormatter($formatter);
        $logger->pushHandler($streamHandler);

        // Debug
        $errorHandler = new \Monolog\Handler\ErrorLogHandler;
        $errorHandler->setFormatter($formatter);
        $logger->pushHandler($errorHandler);

        return $this->logger = $logger;
    }

}
