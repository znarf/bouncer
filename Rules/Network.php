<?php

class Bouncer_Rules_Network
{

    public static $wrongHosts = array(
        '.',
        '-',
        'localhost',
        'hosted-by.ecatel.net',
        'hosted-by.altushost.com',
        'unknown.altushost.com',
        'unassigned.calpop.com',
        'unassigned.psychz.net',
        'hn.kd.ny.adsl',
        'reverse.completel.net',
        's-serv1.inferno.name',
        's-serv2.inferno.name',
        'adsl.viettel.vn',
        'dynamic.vdc.vn',
        'static.vdc.vn',
        'no-revers-dns.set',
        'place.holder',
        'unassigned.syndtech.net'
    );

    public static function load(array $options = array())
    {
        Bouncer::addRule('ip_infos', array('Bouncer_Rules_Network', 'ipInfos'));
    }

    public static function ipInfos($infos)
    {
        if (strpos($infos['host'], 'in-addr.arpa')) {
            $infos['host'] = $infos['addr'];
        }
        if ($infos['addr'] == $infos['host']) {
            $infos['host'] = self::gethostbyaddr($infos['addr']);
        }
        if (in_array($infos['host'], self::$wrongHosts)) {
            $infos['host'] = $infos['addr'];
        }
        // $infos['net-name'] = self::net_name($identity['addr']);
        return $infos;
    }

    public static function gethostbyaddr($addr)
    {
        $rev = preg_replace('/^(\\d+)\.(\\d+)\.(\\d+)\.(\\d+)$/', '$4.$3.$2.$1', $addr);
        $ptrs = @dns_get_record("{$rev}.in-addr.arpa.", DNS_PTR);
        if (isset($ptrs) && is_array($ptrs)) {
            foreach ($ptrs as $ptr) {
                if (!empty($ptr['target'])) {
                    return $ptr['target'];
                }
            }
        }
        return $addr;
    }

    public static function reverse_dns($identity)
    {
        $scores = array();

        $addr = $identity['addr'];
        $host = $identity['host'];

        $dns_check = self::dns_check($addr, $host);
        if ($dns_check == 0) {
            $scores[] = array(0, "DNS verification not possible");
        } else if ($dns_check == 1) {
            $scores[] = array(0, "DNS verification Ok");
        } else {
            $scores[] = array(-2.5, "DNS verification Failed");
        }

        return $scores;
    }

    public static function dns_check($addr, $host)
    {
        if ($addr != $host) {
            $addrs = gethostbynamel($host . '.');
            if (isset($addrs) && is_array($addrs)) {
                foreach ($addrs as $host_addr) {
                    if ($addr == $host_addr) {
                        return 1;
                    }
                }
            }
            return -1;
        }
        return 0;
    }

    public static function fcrdns_check($addr)
    {
        $rev = preg_replace('/^(\\d+)\.(\\d+)\.(\\d+)\.(\\d+)$/', '$4.$3.$2.$1', $addr);
        $ptrs = dns_get_record("{$rev}.IN-ADDR.ARPA.", DNS_PTR);
        if (empty($ptrs)) {
            return 0;
        }
        foreach ($ptrs as $x) {
            if (empty($x['target'])) {
                continue;
            }
            $a = dns_get_record($x['target'], DNS_A);
            if (empty($a)) {
                continue;
            }
            foreach ($a as $y) {
                if (isset($y['ip']) && $y['ip'] == $addr) {
                    return 1;
                }
            }
        }
        return -1;
    }

    static function net_name($addr)
    {
        $whois = self::doPWLookupBulk(array($addr));
        if (isset($whois[$addr])) {
            return $whois[$addr]['net-name'];
        }
        return 'unknown';
    }

    static function doPWLookupBulk($queryarray)
    {
        $pwserver = 'whois.pwhois.org';   // Prefix WhoIswhois Server (public)
        $pwport = 43;                     // Port to which Prefix WhoIswhois listens
        $socket_timeout = 20;             // Timeout for socket connection operations
        $socket_delay = 5;                // Timeout for socket read/write operations
        $buffer = '';

        // Mostly generic code beyond this point
        $pwserver = gethostbyname($pwserver);

        // Optimize query array and renumber
        $queryarray = array_unique($queryarray);
        $i = 0;
        foreach ($queryarray as $a) { 
            $qarray[$i] = $a;
            $i++;
        }

        // Create a new socket
        $sock = stream_socket_client("tcp://".$pwserver.":".$pwport, 
        $errno, $errstr, $socket_timeout);
        if (!$sock) {
            // echo "$errstr ($errno)<br />\n";
            return 0;
        } else {

            stream_set_blocking($sock,0);         // Set stream to non-blocking
            stream_set_timeout($sock, $socket_delay); // Set stream delay timeout

            // Build, then submit bulk query
            $request = "begin\n";
            foreach ($qarray as $addr) {
                $request .= $addr . "\n";
            }
            $request .= "end\n";
            fwrite($sock, $request);

            // Keep looking for more responses until EOF or timeout
            $before_query = date('U');
            while(!feof($sock)){
                if($buf=fgets($sock,128)){
                    $buffer .= $buf;
                    if (date('U') > ($before_query + $socket_timeout)) break;
                }
            }

            fclose($sock);

            $response = array();
            $resp = explode("\n",$buffer);
            $entity_id = 0; $found = 0;
            foreach ($resp as $r) {
                $matcher = '';

                if (stristr($r,'origin-as')) {
                    if ($found > 0) { $entity_id++; $found = 0; }
                    $matcher = explode(":",$r);
                    $response[$qarray[$entity_id]][strtolower($matcher[0])] = ltrim($matcher[1]);
                    $found++;

                } else if (stristr($r,'prefix')) {
                    $matcher = explode(":",$r);
                    $response[$qarray[$entity_id]][strtolower($matcher[0])] = ltrim($matcher[1]);

                } else if (stristr($r,'as-path')) {
                    $matcher = explode(":",$r);
                    $response[$qarray[$entity_id]][strtolower($matcher[0])] = ltrim($matcher[1]);

                } else if (stristr($r,'org-name')) {
                    $matcher = explode(":",$r);
                    $response[$qarray[$entity_id]][strtolower($matcher[0])] = ltrim($matcher[1]);

                } else if (stristr($r,'net-name')) {
                    $matcher = explode(":",$r);
                    $response[$qarray[$entity_id]][strtolower($matcher[0])] = ltrim($matcher[1]);

                } else if (stristr($r,'cache-date')) {
                    $matcher = explode(":",$r);
                    $response[$qarray[$entity_id]][strtolower($matcher[0])] = ltrim($matcher[1]);

                } 

                if ($entity_id >= array_count_values($qarray)) break;

            }
            return $response;
        }
    }

}
