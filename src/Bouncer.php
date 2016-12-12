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
        'exitHandler',
        'responseCodeHandler'
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
    protected $exitHandler;

    /**
     * The callable to use to set the HTTP Response Code
     *
     * @var callable
     */
    protected $responseCodeHandler;

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

    /**
     * Constructor.
     *
     * @param array $options
     */
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
        $request->setTrustedProxies(array('127.0.0.1'));
        $request->setTrustedHeaderName(Request::HEADER_FORWARDED, null);

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
            'session' => $this->getSessionId(),
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
        if (!$this->ended) {
            $identity = $this->processAnalyzers('identity', $identity);
            // Store Identity in cache
            if ($cache) {
                $cache->setIdentity($id, $identity);
            }
            else {
                $this->error('No cache available. Caching identity is needed to keep performances acceptable.');
            }
        }

        return $this->identity = $identity;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        if (!isset($this->context)) {
            $this->initContext();
        }

        return $this->context;
    }

    /*
     * Init the context with time and pid.
     */
    public function initContext()
    {
        $this->context = array();

        $this->addContext('time', microtime(true));

        $this->addContext('bouncer', array('pid' => getmypid()));
    }

    /*
     * @param string               $key
     * @param boolean|string|array $properties
     */
    public function addContext($key, $properties)
    {
        if (isset($this->context[$key]) && is_array($this->context[$key])) {
            $this->context[$key] = array_merge($this->context[$key], $properties);
        } else {
            $this->context[$key] = $properties;
        }
    }

    /*
     * Complete the context with session, exec_time and memory_usage.
     */
    public function completeContext()
    {
        $context = $this->getContext();

        // Session Id (from Cookie)
        $sessionId = $this->getSessionId();
        if (isset($sessionId)) {
            $this->addContext('session', $sessionId);
        }

        // Measure execution time
        $execution_time = microtime(true) - $context['time'];
        if (!empty($context['bouncer']['throttle_time'])) {
            $execution_time -= $context['bouncer']['throttle_time'];
        }

        $this->addContext('bouncer', array(
            'execution_time' => round($execution_time, 4),
            'memory_usage'   => memory_get_peak_usage(),
        ));
    }

    /*
     * Complete the response with status code
     */
    public function completeResponse()
    {
        if (!isset($this->response)) {
            $this->response = array();
        }

        if (is_callable($this->responseCodeHandler)) {
            $responseCodeHandler = $this->responseCodeHandler;
            $responseStatus = $responseCodeHandler();
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
                list($callable) = $array;
                $value = call_user_func_array($callable, array($value));
            }
        }
        return $value;
    }

    /*
     * Start Bouncer, init context and register end function
     */
    public function start()
    {
        // Already started, skip
        if ($this->started === true) {
            return;
        }

        $this->initContext();

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
     * @param int   $minimum in milliseconds
     * @param int   $maximum in milliseconds
     *
     */
    public function throttle($minimum = 1000, $maximum = 2500)
    {
        // In microseconds
        $throttleTime = rand($minimum * 1000, $maximum * 1000);
        usleep($throttleTime);

        // In seconds
        $this->addContext('bouncer', array(
            'throttle_time' => ($throttleTime / 1000 / 1000)
        ));
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
        $this->addContext('blocked', true);

        if (isset($type)) {
            $this->registerEvent($type, $extra);
        }

        if (is_callable($this->responseCodeHandler)) {
            $responseCodeHandler = $this->responseCodeHandler;
            $responseCodeHandler(403, 'Forbidden');
        }
        else {
            $this->error('No response code handler available.');
        }

        if (is_callable($this->exitHandler)) {
            $exitHandler = $this->exitHandler;
            $exitHandler();
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

        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        $this->ended = true;

        $this->completeContext();
        $this->completeResponse();

        // We really want to avoid throwing exceptions there
        try {
            $this->log();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
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
            'session'  => $this->getSessionId(),
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
