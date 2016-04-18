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
    protected $context = array();

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
            $this->profile = new \Bouncer\Profile\Standard;
        }
        call_user_func_array(array($this->profile, 'load'), array($this));
    }

    /*
     * Set the supported options
     */
    public function setOptions(array $options = array())
    {
        if (isset($options['cache'])) {
            $this->cache = $options['cache'];
        }
        if (isset($options['request'])) {
            $this->request = $options['request'];
        }
        if (isset($options['logger'])) {
            $this->logger = $options['logger'];
        }
        if (isset($options['profile'])) {
            $this->profile = $options['profile'];
        }
        if (isset($options['cookieName'])) {
            $this->cookieName = $options['cookieName'];
        }
        if (isset($options['cookiePath'])) {
            $this->cookiePath = $options['cookiePath'];
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
    public function getSession()
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

        // Try to get identity from cache
        if ($cache) {
            $cacheIdentity = $cache->getIdentity($id);
            if ($cacheIdentity) {
                if (is_object($cacheIdentity)) {
                    return $this->identity = $cacheIdentity;
                }
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
        // Session (from Cookie)
        $session = $this->getSession();
        if ($session) {
            $this->context['session'] = $session;
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
     * Complete the response with status
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
     * @param array|object
     *
     * @return array|object
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

        if ($identity->hasAttribute('session')) {
            $curentSession = $this->getSession();
            $identitySession = $identity->getAttribute('session');
            if (empty($curentSession) || $curentSession !== $identitySession) {
                setcookie($this->cookieName, $identitySession, time() + (60 * 60 * 24 * 365 * 2), $this->cookiePath);
            }
        }
    }

    /*
     * Sleep if Identity status is of a certain value.
     *
     * @param array
     * @param int
     * @param int
     *
     */
    public function sleep($statuses = array(), $minimum = 1000, $maximum = 2500)
    {
        $identity = $this->getIdentity();

        if (in_array($identity->getStatus(), $statuses)) {
            $throttle_time = rand($minimum * 1000, $maximum * 1000);
            usleep($throttle_time);
            $this->context['throttle_time'] = round($throttle_time / 1000 / 1000, 3);
        }
    }

    /*
     * Ban if Identity status is of a certain value.
     */
    public function ban($statuses = array())
    {
        $identity = $this->getIdentity();

        if (in_array($identity->getStatus(), $statuses)) {
            $this->context['banned'] = true;
            $this->forbidden();
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

    public static function forbidden()
    {
        $code = '403';
        $message = 'Forbidden';
        self::responseStatus($code, $message);
        echo $message;
        exit;
    }

    public static function unavailable()
    {
        $code = '503';
        $message = 'Service Unavailable';
        self::responseStatus($code, $message);
        echo $message;
        exit;
    }

    public static function responseStatus($code, $message)
    {
        if (function_exists('http_response_code')) {
            http_response_code($code);
        } else {
            header("HTTP/1.0 $code $message");
            header("Status: $code $message");
        }
    }

    public static function hash($string)
    {
        return md5($string);
    }

}
