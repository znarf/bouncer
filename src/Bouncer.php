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

use Bouncer\Resource\Address;
use Bouncer\Resource\Identity;

class Bouncer
{

    const NICE       = 'nice';
    const OK         = 'ok';
    const SUSPICIOUS = 'suspicious';
    const BAD        = 'bad';

    const ROBOT      = 'robot';
    const BROWSER    = 'browser';
    const UNKNOWN    = 'unknown';

    /**
     * @var array
     */
    public static $supportedOptions = array(
        'cache',
        'request',
        'logger',
        'profile',
        'cookieName',
        'cookiePath',
        'exit',
        'responseCodeSetter'
    );

    /**
     * @var string|object
     */
    protected $profile;

    /**
     * @var boolean
     */
    protected $throwExceptions = false;

    /**
     * @var boolean
     */
    protected $logErrors = true;

    /**
     * @var string
     */
    protected $cookieName = 'bsid';

    /**
     * @var string
     */
    protected $cookiePath = '/';

    /**
     * The exit callable to use when blocking a request
     *
     * @var callable
     */
    protected $exit;

    /**
     * The callable to use to set the HTTP Response Code
     *
     * @var callable
     */
    protected $responseCodeSetter = 'http_response_code';

    /**
     * @var \Bouncer\Cache\CacheInterface
     */
    protected $cache;

    /**
     * @var \Bouncer\Logger\LoggerInterface
     */
    protected $logger;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $response;

    /**
     * @var array
     */
    protected $analyzers = array();

    /**
     * @var Identity
     */
    protected $identity;

    /**
     * Store internal metadata
     *
     * @var array
     */
    protected $context;

    /**
     * @var boolean
     */
    protected $started = false;

    /**
     * @var boolean
     */
    protected $ended = false;

    public function __construct(array $options = array())
    {
        if (!empty($options)) {
            $this->setOptions($options);
        }

        // Load Profile
        if (!$this->profile) {
            $this->profile = new \Bouncer\Profile\DefaultProfile;
        }

        call_user_func_array(array($this->profile, 'load'), array($this));
    }

    /*
     * Set the supported options
     */
    public function setOptions(array $options = array())
    {
        foreach (static::$supportedOptions as $key) {
            if (isset($options[$key])) {
                $this->$key = $options[$key];
            }
        }
    }

    /**
     * @throw Exception
     */
    public function error($message)
    {
        if ($this->throwExceptions) {
            throw new Exception($message);
        }
        if ($this->logErrors) {
            error_log("Bouncer: {$message}");
        }
    }

    /**
     * @return \Bouncer\Cache\CacheInterface
     */
    public function getCache($reportError = false)
    {
        if (empty($this->cache)) {
            if ($reportError) {
                $this->error('No cache available.');
            }
            return;
        }

        return $this->cache;
    }

    /**
     * @return \Bouncer\Logger\LoggerInterface
     */
    public function getLogger($reportError = false)
    {
        if (empty($this->logger)) {
            if ($reportError) {
                $this->error('No logger available.');
            }
            return;
        }

        return $this->logger;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        if (isset($this->request)) {
            return $this->request;
        }

        $request = Request::createFromGlobals();

        return $this->request = $request;
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->getRequest()->getUserAgent();
    }

    /**
     * @return string
     */
    public function getAddr()
    {
        return $this->getRequest()->getAddr();
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        $addr = $this->getRequest()->getAddr();

        $address = new Address($addr);

        return $address;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $request = $this->getRequest();

        $headers = $request->getHeaders();

        return $headers;
    }

    /**
     * @return Signature
     */
    public function getSignature()
    {
        $headers = $this->getHeaders();

        $signature = new Signature(array('headers' => $headers));

        return $signature;
    }

    /**
     * @return array
     */
    public function getCookies()
    {
        $names = array($this->cookieName, '__utmz', '__utma');

        $request = $this->getRequest();

        return $request->getCookies($names);
    }

    /**
     * Return the current session id (from Cookie)
     *
     * @return string|null
     */
    public function getSessionId()
    {
        $request = $this->getRequest();

        return $request->getCookie($this->cookieName);
    }

    /**
     * Return the protocol of the request: HTTP/1.0 or HTTP/1.1
     *
     * @return string|null
     */
    public function getProtocol()
    {
        $request = $this->getRequest();

        return $request->getProtocol();
    }

    /**
     * @return Identity
     */
    public function getIdentity()
    {
        if (isset($this->identity)) {
            return $this->identity;
        }

        $cache = $this->getCache();

        $identity = new Identity(array(
            'address' => $this->getAddress(),
            'headers' => $this->getHeaders(),
        ));

        $id = $identity->getId();

        // Try to get Identity from cache
        if ($cache) {
            $cacheIdentity = $cache->getIdentity($id);
            if ($cacheIdentity instanceof Identity) {
                return $this->identity = $cacheIdentity;
            }
        }

        // Process Analyzers
        $identity = $this->processAnalyzers('identity', $identity);

        // Store Identity in cache
        if ($cache) {
            $cache->setIdentity($id, $identity);
        }

        return $this->identity = $identity;
    }

    public function getContext()
    {
        if (!isset($this->context)) {
            $this->initContext();
        }

        return $this->context;
    }

    /*
     * Init the context with id, time and start.
     */
    public function initContext()
    {
        $this->context = array();
        $this->context['pid']   = getmypid();
        $this->context['time']  = time();
        $this->context['start'] = microtime(true);
    }

    /*
     * Complete the context with end, exec_time and memory_usage.
     */
    public function completeContext()
    {
        // Session Id (from Cookie)
        $sessionId = $this->getSessionId();
        if (isset($sessionId)) {
            $this->context['session'] = $sessionId;
        }

        // Measure execution time
        $this->context['end'] = microtime(true);
        $this->context['exec_time'] = round($this->context['end'] - $this->context['start'], 4);
        if (!empty($this->context['throttle_time'])) {
             $this->context['exec_time'] -= $this->context['throttle_time'];
        }
        unset($this->context['end'], $this->context['start']);

        // Report Memory Usage
        $this->context['memory_usage'] = memory_get_peak_usage();
    }

    /*
     * Complete the response with status code
     */
    public function completeResponse()
    {
        if (!isset($this->response)) {
            $this->response = array();
        }

        if (function_exists('http_response_code')) {
            $responseStatus = http_response_code();
            if ($responseStatus) {
                $this->response['status'] = $responseStatus;
            }
        }
    }
    /*
     * Register an analyzer for a given type.
     *
     * @param string
     * @param callable
     * @param int
     */
    public function registerAnalyzer($type, $callable, $priority = 100)
    {
        $this->analyzers[$type][] = array($callable, $priority);
    }

    /*
     * Process Analyzers for a given type. Return the modified array or object.
     *
     * @param string
     * @param object
     *
     * @return object
     */
    protected function processAnalyzers($type, $value)
    {
        if (isset($this->analyzers[$type])) {
            // TODO: order analyzers by priority
            foreach ($this->analyzers[$type] as $array) {
                list($callable, $priority) = $array;
                $value = call_user_func_array($callable, array($value));
            }
        }
        return $value;
    }

    /*
     * Start a Bouncer session
     */
    public function start()
    {
        // Already started, skip
        if ($this->started === true) {
            return;
        }

        $this->initContext();

        $this->initSession();

        register_shutdown_function(array($this, 'end'));

        $this->started = true;
    }

    /*
     * Set a cookie containing the session id
     */
    public function initSession()
    {
        $identity = $this->getIdentity();

        $identitySession = $identity->getSession();
        if ($identitySession) {
            $curentSessionId = $this->getSessionId();
            $identitySessionId = $identitySession->getId();
            if (empty($curentSessionId) || $curentSessionId !== $identitySessionId) {
                setcookie($this->cookieName, $identitySessionId, time() + (60 * 60 * 24 * 365 * 2), $this->cookiePath);
            }
        }
    }

    /*
     * Throttle
     *
     * @param array $statuses
     * @param int   $minimum
     * @param int   $maximum
     *
     */
    public function throttle($minimum = 1000, $maximum = 2500)
    {
        $throttleTime = rand($minimum * 1000, $maximum * 1000);
        usleep($throttleTime);
        $this->context['throttle_time'] = round($throttleTime / 1000 / 1000, 3);
    }

    /*
     * @deprecated deprecated since version 2.1.0
     */
    public function sleep($statuses = array(), $minimum = 1000, $maximum = 2500)
    {
        $identity = $this->getIdentity();

        if (in_array($identity->getStatus(), $statuses)) {
            return $this->throttle($minimum, $maximum);
        }
    }

    /*
     * Block
     *
     * @param string $type
     * @param array  $extra
     *
     */
    public function block($type = null, $extra = null)
    {
        $this->context['blocked'] = true;

        if ($type) {
            $this->registerEvent($type, $extra);
        }

        if (is_callable($this->responseCodeSetter)) {
            $responseCodeSetter = $this->responseCodeSetter;
            $responseCodeSetter('503', 'Service Unavailable');
        }
        else {
            $this->error('No response code setter available.');
        }

        if (is_callable($this->exit)) {
            $callable = $this->exit;
            $callable();
        }
        else {
            // $this->error('No exit callable set. PHP exit construct will be used.');
            exit;
        }
    }

    /*
     * @deprecated deprecated since version 2.1.0
     */
    public function ban($statuses = array())
    {
        $identity = $this->getIdentity();

        if (in_array($identity->getStatus(), $statuses)) {
            $this->context['banned'] = true;
            return $this->block();
        }

    }

    /*
     * @param string $type
     * @param array  $extra
     */
    public function registerEvent($type, $extra = null)
    {
        $this->context['event']['type'] = $type;
        if (!empty($extra)) {
            $this->context['event']['extra'] = $extra;
        }
    }

    /*
     * Complete the connection then attempt to log.
     */
    public function end()
    {
        // Already ended, skip
        if ($this->ended === true) {
            return;
        }

        $this->completeContext();
        $this->completeResponse();

        // We really want to avoid throwing exceptions there
        try {
            $this->log();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        $this->ended = true;
    }

    /*
     * Log the connection to the logging backend.
     */
    public function log()
    {
        $logEntry = array(
            'address'  => $this->getAddress(),
            'request'  => $this->getRequest(),
            'response' => $this->getResponse(),
            'identity' => $this->getIdentity(),
            'context'  => $this->getContext(),
        );

        $logger = $this->getLogger();
        if ($logger) {
            $logger->log($logEntry);
        }
    }

    // Static

    public static function hash($value)
    {
        return md5($value);
    }

}
