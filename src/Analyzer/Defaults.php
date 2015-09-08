<?php

namespace Bouncer\Analyzer;

use Bouncer\Bouncer;
use Bouncer\Fingerprint;

class Defaults
{

    public static function load($bouncer)
    {
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'identityAnalyzer'));
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'agentAnalyzer'));
        $bouncer->registerAnalyzer('identity', array(__CLASS__, 'ipAnalyzer'));
    }

    public static function identityAnalyzer(array $identity)
    {
        if (empty($identity['fingerprint'])) {
            $identity['fingerprint'] = Fingerprint::generate($identity['headers']);
        }
        return $identity;
    }

    public static function agentAnalyzer(array $identity)
    {
        if (empty($identity['agent_type'])) {
            $identity['agent_type'] = Bouncer::UNKNOWN;
        }
        if (empty($identity['agent_name'])) {
            $identity['agent_name'] = 'unknown';
        }
        if (empty($identity['system_name'])) {
            $identity['system_name'] = 'unknown';
        }
        if (empty($identity['agent_version'])) {
            $identity['agent_version'] = null;
        }
        if (empty($identity['system_version'])) {
            $identity['system_version'] = null;
        }
        if (empty($identity['agent_label'])) {
            $identity['agent_label'] = 'Unknown';
        }
        if (empty($identity['system_label'])) {
            $identity['system_label'] = '';
        }
        return $identity;
    }

    public static function ipAnalyzer(array $identity)
    {
        if (empty($identity['extension'])) {
            $identity['extension'] = 'numeric';
        }
        return $identity;
    }

}
