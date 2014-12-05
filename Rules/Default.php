<?php

class Bouncer_Rules_Default
{

    public static function load()
    {
        Bouncer::addRule('identity_infos', array('Bouncer_Rules_Default', 'identityInfos'));
        Bouncer::addRule('agent_infos', array('Bouncer_Rules_Default', 'agentInfos'));
        Bouncer::addRule('ip_infos', array('Bouncer_Rules_Default', 'ipInfos'));
    }

    public static function identityInfos($infos)
    {
        if (empty($infos['fingerprint'])) {
            $infos['fingerprint'] = Bouncer::fingerprint($infos['headers']);
        }
        return $infos;
    }

    public static function agentInfos($infos)
    {
        if (empty($infos['agent_type'])) {
            $infos['agent_type'] = Bouncer::UNKNOWN;
        }
        if (empty($infos['agent_name'])) {
            $infos['agent_name'] = 'unknown';
        }
        if (empty($infos['system_name'])) {
            $infos['system_name'] = 'unknown';
        }
        if (empty($infos['agent_version'])) {
            $infos['agent_version'] = null;
        }
        if (empty($infos['system_version'])) {
            $infos['system_version'] = null;
        }
        if (empty($infos['agent_label'])) {
            $infos['agent_label'] = 'Unknown';
        }
        if (empty($infos['system_label'])) {
            $infos['system_label'] = '';
        }
        return $infos;
    }

    public static function ipInfos($infos)
    {
        if (empty($infos['host'])) {
            $infos['host'] = strtolower(gethostbyaddr($infos['addr']));
        }
        if (empty($infos['extension'])) {
            $infos['extension'] = 'numeric';
        }
        return $infos;
    }

}
