<?php

class Bouncer_Stats
{

    protected static $_keys = array(
      'id', 'fingerprint', 'time', 'hits', 'host', 'system', 'agent', 'referer', 'score'
    );

    protected static $_connection_keys = array(
      'time', 'id', 'hits', 'host', 'system', 'agent', 'method', 'uri', 'code', 'size', 'memory', 'sql', 'nosql', 'exec_time'
    );

    protected static $_namespace = '';

    protected static $_ignore_ips = array();

    protected static $_detailed_connections = false;

    protected static $_detailed_ips = false;

    protected static $_detailed_score = false;

    protected static $_detailed_host = false;

    protected static $_max_items = 100;

    protected static $_base_static_url = 'http://h6e.net/bouncer';

    protected static $_browser = array();

    protected static $_robot = array();

    protected static $_os = array();

    public static function stats(array $options = array())
    {
        require dirname(__FILE__) . '/lib/browser.php';
        require dirname(__FILE__) . '/lib/os.php';
        require dirname(__FILE__) . '/lib/robot.php';

        $browser["eyeem"] = array(
          "icon" => "question",
          "title" => "Eyeem",
          "rule" => array(
            "Eyeem[ /]([0-9.]{1,10})" => "\\1",
            "EYEEM[ /]([0-9.]{1,10})" => "\\1",
            "EYEEM" => "",
          )
        );

        $robot["eyeemphpclient"] = array(
          "icon" => "question",
          "title" => "Eyeem PHP Client",
          "rule" => array(
            "Eyeem PHP Client" => "",
          )
        );

        self::$_browser = $browser;
        self::$_robot = $robot;
        self::$_os = $os;

        require_once dirname(__FILE__) . '/Rules/Basic.php';
        require_once dirname(__FILE__) . '/Rules/Browser.php';
        require_once dirname(__FILE__) . '/Rules/Fingerprint.php';
        require_once dirname(__FILE__) . '/Rules/Httpbl.php';
        require_once dirname(__FILE__) . '/Rules/Network.php';
        require_once dirname(__FILE__) . '/Rules/Geoip.php';

        self::setOptions($options);

        if (isset($_GET['extract'])) {
            self::extract();
        } else if (isset($_GET['stats'])) {
            self::charts();
        } else if (isset($_GET['connections'])) {
            self::connections();
        } else if (isset($_GET['connection'])) {
            self::connection();
        } else if (isset($_GET['agents'])) {
            self::agents();
        } else if (isset($_GET['agent'])) {
            self::agent();
        } else {
            self::connections();
        }
    }

    public static function setOptions(array $options = array())
    {
        if (isset($options['namespace'])) {
            self::$_namespace = $options['namespace'];
        }
        if (isset($options['keys'])) {
            self::$_keys = $options['keys'];
        }
        if (isset($options['ignore_ips'])) {
            self::$_ignore_ips = $options['ignore_ips'];
        }
        if (isset($options['detailed_connections'])) {
            self::$_detailed_connections = $options['detailed_connections'];
        }
        if (isset($options['detailed_ips'])) {
            self::$_detailed_ips = $options['detailed_ips'];
        }
        if (isset($options['detailed_score'])) {
            self::$_detailed_score = $options['detailed_score'];
        }
        if (isset($options['detailed_host'])) {
            self::$_detailed_host = $options['detailed_host'];
        }
        if (isset($options['max_items'])) {
            self::$_max_items = $options['max_items'];
        }
        if (isset($options['base_static_url'])) {
            self::$_base_static_url = $options['base_static_url'];
        }
    }

    public static function getAgentValues($id)
    {
        if (!$identity = Bouncer::backend()->getIdentity($id)) {
            return null;
        }

        // Hits
        $hits = Bouncer::backend()->countAgentConnections($id, self::$_namespace);

        // Addr
        $addr = $identity['addr'];
        $host = $identity['host'];
        $extension = isset($identity['country']) ? $identity['country'] : (isset($identity['extension']) ? $identity['extension'] : 'numeric');

        // Agent
        $type = $identity['type'];
        $signature = $identity['signature'];
        $fingerprint = $identity['fingerprint'];
        $useragent = isset($identity['headers']['User-Agent']) ? $identity['headers']['User-Agent'] : 'none';
        $agent = $name = $identity['name'];
        $version = isset($identity['version']) ? $identity['version'] : null;
        $system = $system_name = isset($identity['os']) ? $identity['os'][0] : 'unknown';
        $system_version = isset($identity['os']) ? $identity['os'][1] : 'unknown';
        $fgtype = Bouncer_Rules_Fingerprint::getType($identity);
        $fgtype = empty($fgtype) ? 'none' : $fgtype;

        // Families
        $ie = $name == 'explorer' || in_array($name, Bouncer_Rules_Browser::$explorer_browsers) ? 1 : 0;
        $gecko = $name == 'firefox' || in_array($name, Bouncer_Rules_Browser::$gecko_browsers) ? 1 : 0;
        $webkit = in_array($name, Bouncer_Rules_Browser::$webkit_browsers) ? 1 : 0;
        $rss = in_array($name, Bouncer_Rules_Browser::$rss_browsers) || (isset($xmoz) && $xmoz == 'livebookmarks') ? 1 : 0;

        // Features
        $features = isset($identity['features']) ? $identity['features'] : array();
        $js = isset($features['javascript']) && $features['javascript'] != 0 ? (int)($features['javascript'] > 0) : '';
        $img = isset($features['image']) && $features['image'] != 0 ? (int)($features['image'] > 0) : '';
        $iframe = isset($features['iframe']) && $features['iframe'] != 0 ? (int)($features['iframe'] > 0) : '';

        // Referer
        $first = Bouncer::backend()->getFirstAgentConnection($id, self::$_namespace);
        $ref = 0;
        $referer = '';
        if (!empty($first['request']['headers']['Referer'])) {
            $preferer = @parse_url($first['request']['headers']['Referer']);
            if (isset($preferer['host']) && $first['request']['server'] != $preferer['host']) {
                $referer = $first['request']['headers']['Referer'];
                $ref = 1;
            }
        }

        return get_defined_vars();
    }

    public static function getConnectionValues($conn)
    {
        if (is_string($conn)) {
          $id = $conn;
          if (!$conn = Bouncer::getLastAgentConnection($id, self::$_namespace)) {
              return null;
          }
          $conn['id'] = $id;
        }

        $connection_id = $conn['id'];

        $time = date("d/m/Y.H:i:s", $conn['time']);
        $server = isset($conn['request']['server']) ? $conn['request']['server'] : '';
        $method = isset($conn['request']['method']) ? $conn['request']['method'] : 'GET';
        $uri = isset($conn['request']['uri']) ? $conn['request']['uri'] : '';

        $code = isset($conn['code']) ? $conn['code'] : '';
        $size = isset($conn['size']) ? $conn['size']/1024 : '';
        $exec_time = isset($conn['exec_time']) ? $conn['exec_time'] : '';
        $memory = isset($conn['memory']) ? $conn['memory']/1024/1024 : '';
        $pid = isset($conn['pid']) ? $conn['pid'] : '';

        $cookie = isset($conn['request']['headers']['Cookie']) ? 1 : 0;
        $status = isset($conn['result']) ? $conn['result'][0] : 'neutral';
        $score = isset($conn['result']) ? $conn['result'][1] : 0;

        $sql = isset($conn['sql']) ? count($conn['sql']) : 0;
        $nosql = isset($conn['nosql']) ? count($conn['nosql']) : 0;

        return get_defined_vars();
    }

    public static function getBetterValues($values)
    {
        global $cssRules;

        $linkify = true;

        extract($values);

        if ($linkify) {
            $hits = '<a href="?filter=id%3A' . $id . '">' . $hits . '</a>';
            $id = '<a href="?filter=id%3A' . $id . '">' . (strlen($id) == 32 ? substr($id, 0, 6) : $id) . '</a>';
        } else {
            $id = substr($id, 0, 16);
        }

        $fingerprint = substr($identity['fingerprint'], 0, 6);
        if ($linkify) {
            $fingerprint = '<a href="?filter=fingerprint%3A' . $identity['fingerprint'] . '">' . $fingerprint . '</a>';
        }

        if ($type == 'browser' && isset(self::$_os[$system])) {
            if (empty($cssRules[$system])) {
                $cssRules[$system] = 'background-image:url(' . self::$_base_static_url . '/images/os/' . self::$_os[$system]['icon'] . '.png)';
            }
            $system = self::$_os[$system]['title'] . ' ' . $system_version;
        } else {
            $system = '';
            $system_name = '';
        }

        if (empty($cssRules[$extension])) {
             $cssRules[$extension] = 'background-image:url(' . self::$_base_static_url . '/images/ext/' . $extension . '.png)';
        }
        if ($linkify) {
            $host = '<a href="?filter=addr%3A' .  $addr . '">' .  $host . '</a>';
        }

        if ($type == 'browser') {
            if (empty($cssRules[$name])) {
                $cssRules[$name] = 'background-image:url(' . self::$_base_static_url . '/images/browser/' . self::$_browser[$name]['icon'] . '.png)';
            }
            $agent = self::$_browser[$name]['title'] . ' ' . $version;
        } elseif ($type == 'robot') {
            if (empty($cssRules[$name])) {
                $cssRules[$name] = 'background-image:url(' . self::$_base_static_url . '/images/robot/' . self::$_robot[$name]['icon'] . '.png)';
            }
            $agent = self::$_robot[$name]['title'] . ' ' . $version;
        }

        if (!empty($referer) && !empty($preferer)) {
            if ($linkify) {
                $referer = '<a href="' . htmlspecialchars($referer) . '">' . $preferer['host'] . '</a>';
            } else {
                $referer = $preferer['host'];
            }
        }

        if (!empty($uri)) {
          $uri = '<a href="?connection=' . $connection_id . '">' . $uri . '</a>';
        }

        if (!empty($exec_time)) {
          $exec_time = $exec_time . 's';
        }
        if (!empty($memory)) {
          $memory = round($memory) . 'M';
        }
        if (!empty($size)) {
          $size =  round($size, 2) . 'K';
        }

        return get_defined_vars();
    }

    public static function filterMatch($filters = array(), $values = array())
    {
        $numericKeys = array('memory', 'size', 'exec_time', 'sql', 'nosql');
        $partialKeys = array('addr', 'host', 'referer', 'useragent', 'uri');
        foreach ($filters as $filter) {
            list($filterKey, $filterValue) = $filter;
            $filterValue = str_replace('_', ' ', $filterValue);
            if (strpos($filterKey, '-') === 0) {
                $filterKey = substr($filterKey, 1);
                if (!isset($values[$filterKey] )) {
                    continue;
                }
                if (in_array($filterKey, $numericKeys)) {
                    if ($values[$filterKey] > (float)$filterValue) return true;
                } elseif (in_array($filterKey, $partialKeys)) {
                    if (strpos($values[$filterKey], $filterValue) !== false) return true;
                } else {
                    if ($values[$filterKey] == $filterValue) return true;
                }
            } else {
                if (!isset($values[$filterKey] )) {
                    continue;
                }
                if (in_array($filterKey, $numericKeys)) {
                    if ($values[$filterKey] < (float)$filterValue) return true;
                } elseif (in_array($filterKey, $partialKeys)) {
                    if (strpos($values[$filterKey], $filterValue) === false) return true;
                } else {
                    if ($values[$filterKey] != $filterValue) return true;
                }
            }
        }
        return false;
    }

    public static function display($values, $keys = array())
    {
        $keys = empty($keys) ? self::$_keys : $keys;

        $values = self::getBetterValues($values);
        extract($values);

        // echo '<tr class="', $status, '">';
        echo '<tr class="status', substr($code, 0, 1), 'x ', $status, '">';
        foreach ($keys as $key) {
            if ($key == 'id') {
                echo '<td style="background:#' . substr($identity['id'], 0, 6) . '">&nbsp;</td>';
                echo '<td>' . $id . '</td>';
            } elseif ($key == 'fingerprint') {
                echo '<td style="background:#' . substr($identity['fingerprint'], 0, 6) . '">&nbsp;</td>';
                echo '<td>' . $fingerprint . '</td>';
                echo '<td>' . ( isset($fgtype) && $fgtype != 'none' ? $fgtype : '' ) . '</td>';
                if (method_exists('Bouncer', 'countAgentsFingerprint')) {
                    echo '<td>' . Bouncer::countAgentsFingerprint($identity['fingerprint'], self::$_namespace) . '</td>';
                } else {
                    echo '<td>', '&nbsp;', '</td>';
                }
            } elseif ($key == 'features') {
                 if (isset($identity['features'])) {
                     echo '<td>' . $identity['features']['image'] . '</td>';
                     echo '<td>' . $identity['features']['iframe'] . '</td>';
                     echo '<td>' . $identity['features']['javascript'] . '</td>';
                 } else {
                     echo '<td colspan="3">', '&nbsp;', '</td>';
                 }
            } else if ($key == 'host') {
                echo '<td class="ic ' . $extension . '">', $host, '</td>';
                if (self::$_detailed_host) {
                    echo '<td>', Bouncer_Rules_Httpbl::getType($identity), '</td>';
                    if (method_exists('Bouncer', 'countAgentsHost')) {
                        $hcount = Bouncer::countAgentsHost(md5($identity['addr']), self::$_namespace);
                        echo '<td>' . ($hcount ? $hcount : 1) . '</td>';
                    } else {
                        echo '<td>', '&nbsp;', '</td>';
                    }
                }
            } elseif ($key == 'agent') {
                echo '<td class="ic ' . $name . '">', $agent ,'</td>';
            } elseif ($key == 'system') {
                echo '<td class="ic ' . $system_name . '">', $system ,'</td>';
            } else {
                if (isset($$key) && $$key != 'none') {
                     echo '<td>', $$key ,'</td>';
                } else {
                    echo '<td>', '&nbsp;' ,'</td>';
                }
            }
        }
        echo '</tr>' . "\n";
    }

    public static function getFilters()
    {
      $filters = array();
      if (!empty($_GET['filter'])) {
          foreach (explode(' ', $_GET['filter']) as $f) {
              if (strpos($f, ':')) $filters[] = explode(':', trim($f));
          }
      }
      return $filters;
    }

    public static function agents()
    {
         global $cssRules;

         $filters = self::getFilters();

         foreach ($filters as $filter) {
             list($filterKey, $filterValue) = $filter;
             if ($filterKey == 'fingerprint') {
                 $agents = Bouncer::getAgentsIndexFingerprint($filterValue, self::$_namespace);
                 break;
             }
             if ($filterKey == 'addr') {
                 $agents = Bouncer::getAgentsIndexHost(Bouncer::hash($filterValue), self::$_namespace);
                 break;
             }
         }
         if (empty($agents)) {
             $agents = Bouncer::getAgentsIndex(self::$_namespace);
         }

         $cssRules = array();
         $cssRules['unknown'] = 'background-image:url(' . self::$_base_static_url . '/images/os/question.png)';

         echo '<table class="bouncer-table">' . "\n";

         // Headers
         echo '<tr>';
         foreach (self::$_keys as $key) {
             if ($key == 'fingerprint') {
                 echo '<th style="width:14px">', '', '</th>';
                 echo '<th colspan="3">', ucfirst($key), '</th>';
             } elseif ($key == 'host') {
                 if (self::$_detailed_host) {
                     echo '<th colspan="3">', ucfirst($key), '</th>';
                 } else {
                     echo '<th>', ucfirst($key), '</th>';
                 }
             } elseif ($key == 'features') {
                 echo '<th colspan="3">', ucfirst($key), '</th>';
             } else {
                 echo '<th>', ucfirst($key), '</th>';
             }
         }
         echo '</tr>' . "\n";

         // Agents
         $count = 0;
         foreach ($agents as $time => $id) {
             // Get values
             if (!$agentValues = self::getAgentValues($id)) {
                continue;
             }
             // Ignored IPs
             if (in_array($agentValues['addr'], self::$_ignore_ips)) {
                continue;
             }
             // Get Last Connection
             if (!$last = Bouncer::getLastAgentConnection($id, self::$_namespace)) {
                 continue;
             }
             if (!$connectionValues = self::getConnectionValues($last)) {
                 continue;
             }
             // Merge
             $values = array_merge($agentValues, $connectionValues);
             // Filters
             if (self::filterMatch($filters, $values)) {
                continue;
             }
             // Display
             self::display($values, self::$_keys);
             // Limit
             $count ++;
             if ($count >= self::$_max_items) {
                 break;
             }
         }

         echo '</table>';

         echo '<style type="text/css">' . "\n";
         foreach ($cssRules as $class => $content) {
             echo ".$class { $content; }\n";
         }
         echo '</style>';
    }

    public static function agent()
    {
        $id = $_GET['agent'];
        $identity = Bouncer::getIdentity($id);
        if (empty($identity)) {
            return;
        }

        list($identity, $result) = Bouncer::analyseIdentity($identity);
        list($status, $score, $details) = $result;

        echo '<table class="bouncer-table bouncer-table-agent">';
        echo '<tr>', '<th colspan="2">', 'Identity', '</th>', '</tr>';

        echo '<tr>', '<td>', 'Id', '</td>',
                     '<td>', $identity['id'], '</td>', '</tr>';

        echo '<tr>', '<td>', 'Signature', '</td>',
                     '<td>', '<a href="?filter=signature%3A' . $identity['signature'] . '">', $identity['signature'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Fingerprint', '</td>',
                     '<td>', '<a href="?filter=fingerprint%3A' . $identity['fingerprint'] . '">', $identity['fingerprint'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Type', '</td>',
             '<td>', '<a href="?filter=type%3A' . $identity['type'] . '">', $identity['type'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Name', '</td>',
                     '<td>', '<a href="?filter=name%3A' . $identity['name'] . '">', $identity['name'], '</a></td>', '</tr>';

        if (isset($identity['version'])) {
            echo '<tr>', '<td>', 'Version',
                         '</td>', '<td>', $identity['version'], '</td>', '</tr>';
        }
        if (isset($identity['os'])) {
            $system = $identity['os'][0];
            echo '<tr>', '<td>', 'OS', '</td>',
                         '<td>', '<a href="?filter=system%3A' . $system . '">', $system, '</a></td>', '</tr>';
        }

        echo '<tr>', '<td>', 'Addr', '</td>',
                     '<td>', '<a href="?filter=addr%3A' . $identity['addr'] . '">', $identity['addr'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Host', '</td>',
                     '<td>', $identity['host'], '</td>', '</tr>';

        echo '<tr>', '<td>', 'Extension', '</td>',
                     '<td>', '<a href="?filter=extension%3A' . $identity['extension'] . '">', $identity['extension'], '</a></td>', '</tr>';

        if (self::$_detailed_ips) {

            echo '<tr>', '<td>', 'Http:BL', '</td>';
            echo '<td>'; if (isset($identity['httpbl'])) print_r($identity['httpbl']); echo '</td>', '</tr>';

            echo '<tr>', '<td>', 'Reverse', '</td>', '<td>';
            $rev = preg_replace('/^(\\d+)\.(\\d+)\.(\\d+)\.(\\d+)$/', '$4.$3.$2.$1', $identity['addr']);
            $ptrs = dns_get_record("{$rev}.in-addr.arpa.", DNS_PTR);
            print_r($ptrs);
            echo '</td>', '</tr>';

            echo '<tr>', '<td>', 'DNS', '</td>', '<td>';
            $dns = dns_get_record($identity['host'], DNS_A);
            print_r($dns);
            echo '</td>', '</tr>';

            echo '<tr>', '<td>', 'Network', '</td>', '<td>';
            print_r(Bouncer_Rules_Network::doPWLookupBulk(array($identity['addr'])));
            echo '</td>', '</tr>';

        } else {

            $lookup = Bouncer_Rules_Network::doPWLookupBulk(array($identity['addr']));
            $network = $lookup[ $identity['addr'] ];

            echo '<tr>', '<td>', 'Network Org Name', '</td>', '<td>';
            echo $network['org-name'];
            echo '</td>', '</tr>';

            echo '<tr>', '<td>', 'Network Net Name', '</td>', '<td>';
            echo $network['net-name'];
            echo '</td>', '</tr>';

        }

        echo '<tr>', '<th colspan="2">', 'Agent HTTP Headers', '</th>', '</tr>';
        foreach ($identity['headers'] as $key => $value) {
            echo '<tr>', '<td>', $key, '</td>', '<td>', $value, '</td>', '</tr>';
        }

        if (self::$_detailed_score) {
            echo '<tr>', '<th>', 'Score', '</th>', '</tr>';
            foreach ($details as $detail) {
                list($value, $message) = $detail;
                echo '<tr>', '<td>', $message, '</td>', '<td>', $value, '</td>', '</tr>';
            }
            echo '<tr>', '<td>', 'Total', '</td>', '<td><b>', $score, '</b></td>', '</tr>';
        }

        echo '</table>';

        $connections = Bouncer::getAgentConnections($id, self::$_namespace);
        if (empty($connections)) {
            $connections = array();
        }

        self::_displayConnections($connections);
    }

    public static function connections()
    {
        global $cssRules;

        $filters = self::getFilters();

        foreach ($filters as $filter) {
            list($filterKey, $filterValue) = $filter;
            if ($filterKey == 'id') {
                $connections = Bouncer::backend()->getAgentConnections($filterValue, self::$_namespace);
                if (!empty($connections)) {
                  break;
                }
            }
            if ($filterKey == 'addr') {
                $connections = Bouncer::backend()->getHostConnections(Bouncer::hash($filterValue), self::$_namespace);
                if (!empty($connections)) {
                  break;
                }
            }
            if ($filterKey == 'code'  && substr($filterValue, 0, 1) != 2 || $filterKey == '-code' && substr($filterValue, 0, 1) == 2) {
              $ns = self::$_namespace;
              $not2xIndexKey = empty($ns) ? "connections-not2x" : "connections-not2x-$ns";
              $connections = Bouncer::backend()->getConnectionsWithIndexKey($not2xIndexKey);
              if (!empty($connections)) {
                break;
              }
            }
        }
        if (empty($connections)) {
            $connections = Bouncer::backend()->getConnections(self::$_namespace);
        }
        if (empty($connections)) {
            $connections = array();
        }

        echo '<table class="bouncer-table">' . "\n";

        $count = 0;
        foreach ($connections as $id => $connection) {
          if (is_string($connection)) {
            $id = $connection;
            $connection = Bouncer::get("connection-" . $id);
          }
          $connection['id'] = $id;
          if (!$connectionValues = self::getConnectionValues($connection)) {
              continue;
          }
          if (!$identity = Bouncer::backend()->getIdentity($connection['identity'])) {
              continue;
          }
          if (!$agentValues = self::getAgentValues($identity['id'])) {
              continue;
          }
          $values = array_merge($connectionValues, $agentValues);
          // Filters
          if (self::filterMatch($filters, $values)) {
             continue;
          }
          self::display($values, self::$_connection_keys);
          // Limit
          $count ++;
          if ($count >= self::$_max_items) {
              break;
          }
        }

        echo '</table>';

        echo '<style type="text/css">' . "\n";
        foreach ($cssRules as $class => $content) {
            echo ".$class { $content; }\n";
        }
        echo '</style>';
    }

    protected static function _displayConnections($connections)
    {
        echo '<table class="bouncer-table bouncer-table-connections">';
        echo '<tr>';
        if (self::$_detailed_connections) {
            echo '<th>', 'Id', '</th>';
        }
        echo '<th>', 'Time', '</th>';
        echo '<th>', 'Method', '</th>';
        echo '<th>', 'Server', '</th>';
        echo '<th>', 'URI', '</th>';
        echo '<th>', 'Referer', '</th>';
        if (self::$_detailed_connections) {
            echo '<th>', 'Score', '</th>';
            echo '<th>', 'Code', '</th>';
            echo '<th>', 'Exec Time', '</th>';
            echo '<th>', 'Memory', '</th>';
            echo '<th>', 'Size', '</th>';
            echo '<th>', 'Pid', '</th>';
        }
        echo '</tr>';
        foreach ($connections as $id => $connection) {
            if (empty($connection)) {
                continue;
            }
            $request = $connection['request'];
            $status = $connection['result'][0];
            echo '<tr class="', $status, '">';
            if (self::$_detailed_connections) {
                echo '<td>', '<a href="?connection=', $id, '">', substr($id, 0, 10), '</a></td>';
            }
            echo '<td>', date("d/m/Y H:i:s", $connection['time']), '</td>';
            echo '<td>' , $request['method'], '</td>';
            echo '<td>' , $request['server'], '</td>';
            echo '<td>' , urldecode($request['uri']), '</td>';
            if (!empty($request['headers']['Referer'])) {
                $preferer = parse_url($request['headers']['Referer']);
            }
            if (!empty($request['headers']['Referer']) && isset($preferer['host']) && $request['server'] != $preferer['host']) {
                echo '<td>', '<a href="', $request['headers']['Referer'], '">', $preferer['host'], '</td>';
            } else {
                echo '<td>', '</td>';
            }
            if (self::$_detailed_connections) {
                if (isset($connection['result'])) {
                    echo '<td>' , $connection['result'][1], '</td>';
                } else {
                    echo '<td>', '</td>';
                }
                if (isset($connection['code'])) {
                    echo '<td>' , $connection['code'], '</td>';
                } else {
                    echo '<td>', '</td>';
                }
                if (isset($connection['exec_time'])) {
                    echo '<td>' , $connection['exec_time'] . 's', '</td>';
                } else {
                    echo '<td>', '</td>';
                }
                if (isset($connection['memory'])) {
                    echo '<td>' , round($connection['memory']/1024/1024) . 'M', '</td>';
                } else {
                    echo '<td>', '</td>';
                }
                if (isset($connection['size'])) {
                    echo '<td>' , round($connection['size']/1024, 2) . ' K', '</td>';
                } else {
                    echo '<td>', '</td>';
                }
                if (isset($connection['pid'])) {
                    echo '<td>' , $connection['pid'], '</td>';
                } else {
                    echo '<td>', '</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    public static function connection()
    {
        if (!self::$_detailed_connections) {
            return;
        }

        $id = $_GET['connection'];
        $connection = Bouncer::get('connection-' . $id);
        if (empty($connection)) {
            return;
        }

        $request = $connection['request'];

        $identity = Bouncer::backend()->getIdentity($connection['identity']);
        $result = Bouncer::analyseRequest($identity, $request);
        list($status, $score, $details) = $result;

        echo '<table class="bouncer-table">';
        if (!empty($request['headers'])) {
            echo '<tr>', '<th>', 'Request Headers', '</th>' , '</tr>';
            foreach ($request['headers'] as $key => $value) {
                echo '<tr>', '<td>', $key, '</td>', '<td>', $value, '</td>', '</tr>';
            }
        }
        foreach (array('GET', 'COOKIE', 'POST') as $G) {
            if (!empty($request[$G])) {
                echo '<tr>', '<th>', $G, '</th>' , '</tr>';
                foreach ($request[$G] as $key => $value) {
                    echo '<tr>', '<td>', $key, '</td>', '<td>', $value, '</td>', '</tr>';
                }
            }
        }
        if (!empty($request['FILES'])) {
            foreach ($request['FILES'] as $value) {
                echo '<tr>', '<td>', $time, '</td>', '<td>';
                print_r($value);
                echo '</td>', '</tr>';
            }
        }
        echo '<tr>', '<th>', 'Score', '</th>', '</tr>';
        foreach ($details as $detail) {
            list($value, $message) = $detail;
            echo '<tr>', '<td>', $message, '</td>', '<td>', $value, '</td>', '</tr>';
        }
        echo '<tr>', '<td>', 'Total', '</td>', '<td><b>', $score, '</b></td>', '</tr>';
        if (!empty($connection['sql'])) {
            echo '<tr>', '<th>', 'SQL Queries', '</th>' , '</tr>';
            foreach ($connection['sql'] as $value) {
                list($query, $time) = $value;
                echo '<tr>', '<td>', $time, '</td>', '<td>', $query, '</td>', '</tr>';
            }
        }
        if (!empty($connection['nosql'])) {
            echo '<tr>', '<th>', 'NoSQL Queries', '</th>' , '</tr>';
            foreach ($connection['nosql'] as $value) {
                echo '<tr>', '<td>', '', '</td>', '<td>', $value, '</td>', '</tr>';
            }
        }
        echo '</table>';
    }

    public static function charts()
    {
        $stats = array();
        $identities = array();
        $agents = Bouncer::getAgentsIndex(self::$_namespace);
        foreach ($agents as $id) {
            $key = $_GET['stats'];
            $identity = Bouncer::getIdentity($id);
            if (empty($identity) || empty($identity[$key])) {
                continue;
            }
            $value = $identity[$key];
            if (empty($stats[$value])) {
                $stats[$value] = 1;
            } else {
                $stats[$value] ++;
            }
            if (isset($_GET['aggregate'])) {
                $stats[$value] += Bouncer::countAgentConnections($id, self::$_namespace) - 1;
            }
            if (empty($identities[$value])) {
                $identities[$value] = $identity;
            }
        }

        ksort($stats);
        arsort($stats);

        echo '<table class="bouncer-table">';
        foreach ($stats as $value => $count) {
            $identity = $identities[$value];
            if ($count <= 2) {
                continue;
            }
            if (isset($_GET['unknown'])) {
                $type = Bouncer_Rules_Fingerprint::getType($identity);
                if (!empty($type)) {
                    continue;
                }
            }
            echo '<tr>';
            if ($key == 'fingerprint') {
                echo '<td width="20">', $count, '</td>';
                echo '<td width="20" style="background:#' . substr($value, 0, 6) . '">&nbsp;</td>';
                echo '<td width="20">', '<a href="?filter=fingerprint%3A' . $value . '">', $value, '</a></td>';
                echo '<td width="20">', Bouncer_Rules_Fingerprint::getType($identity) , '</td>';
                echo '<td class="ic ', $identity['name'], '">', '<a href="?filter=name%3A' . $identity['name'] . '">', $identity['name'], '</a> ',
                    isset($identity['version']) ? $identity['version'] : '', '</td>';

            } else if ($key == 'host') {
                echo '<td width="10">', $count, '</td>';
                echo '<td width="10">', '<a href="?filter=host%3A' . $value . '">', $value, '</a></td>';

            } else if ($key == 'addr') {
                echo '<td width="10">', $count, '</td>';
                echo '<td width="10">', '<a href="?filter=addr%3A' . $value . '">', $value, '</a></td>';

            } else if ($key == 'signature') {
                echo '<td width="10">', $count, '</td>';
                echo '<td width="10">', '<a href="?filter=signature%3A' . $value . '">', $value, '</a></td>';
                echo '<td width="10">', Bouncer_Rules_Fingerprint::getType($identity) , '</td>';
                echo '<td class="ic ', $identity['name'], '">', '<a href="?filter=name%3A' . $identity['name'] . '">', $identity['name'], '</a> ',
                    isset($identity['version']) ? $identity['version'] : '', '</td>';
                echo '<td>', isset($identity['headers']['User-Agent']) ? $identity['headers']['User-Agent'] : '' , '</td>';

            } else {
                echo '<td>', $count, '</td>';
                echo '<td>', $value, '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    public static function extract()
    {
        require_once dirname(__FILE__) . '/Rules/Fingerprint.php';

        $botnets = Bouncer_Rules_Fingerprint::get('botnet');

        $agents = Bouncer::getAgentsIndex(self::$_namespace);

        $fingerprints = array();

        // Collect level 1 fingerprints
        foreach ($agents as $id) {
            $key = $_GET['extract'];
            $identity = Bouncer::getIdentity($id);
            $fg = $identity['fingerprint'];
            if (strpos($identity['host'], $key) !== false) {
                $fingerprints[] = $fg;
            }
        }
        $fingerprints = array_unique($fingerprints);

        $hosts = array();

        // Collect level 1 hosts
        foreach ($agents as $id) {
            $identity = Bouncer::getIdentity($id);
            $fg = $identity['fingerprint'];
            $host = $identity['host'];
            if (in_array($fg, $fingerprints)) {
                if (empty($hosts[$host])) {
                    $hosts[$host] = 1;
                } else {
                    $hosts[$host] ++;
                }
            }
        }

        $fingerprints2 = array();

        // Collect level 2 fingerprints
        foreach ($agents as $id) {
            $identity = Bouncer::getIdentity($id);
            $fg = $identity['fingerprint'];
            $host = $identity['host'];
            if (isset($hosts[$host])) {
                 if (empty($fingerprints2[$fg])) {
                     $fingerprints2[$fg] = 1;
                 } else {
                     $fingerprints2[$fg] ++;
                 }
             }
        }

        $fingerprints3 = array();

        // Check Ambigous agents
        foreach ($agents as $id) {
            $identity = Bouncer::getIdentity($id);
            $fg = $identity['fingerprint'];
            $host = $identity['host'];
            if (isset($fingerprints2[$fg]) && empty($hosts[$host]) ) {
               if (empty($fingerprints3[$fg])) {
                     $fingerprints3[$fg] = 1;
                 } else {
                     $fingerprints3[$fg] ++;
                 }
            }
        }

        ksort($fingerprints2);
        arsort($fingerprints2);

        foreach ($fingerprints2 as $value => $count) {
            if (isset($fingerprints3[$value])) {
                continue;
            }
            if (in_array($value, $botnets)) {
                continue;
            }
            echo "\n'$value', // $count";
        }
    }

    public static function css()
    {
        ?>
        <style type="text/css">
        .bouncer-table { font-size:11px; font-family:"Helvetica Neue", Helvetica, Arial, sans-serif; }
        .bouncer-table th { color: #4A4A4A; }
        .bouncer-table td, .bouncer-table td a { color: #333333; }
        .bouncer-filter, .bouncer-table { width:100%; margin:auto; }
        .bouncer-filter { display:block; margin-bottom:10px; border:1px solid #DEDEDE; }
        .bouncer-table { border-collapse:collapse; }
        .bouncer-table td, .bouncer-table th { border:1px solid #DEDEDE; }
        .bouncer-table td { height:20px; padding:2px 4px; }
        .bouncer-table td.ic { padding-left:24px; }
        .bouncer-table tr.neutral { background-color:#E0E5F2; }
        .bouncer-table tr.bad { background-color:#EFE2EC; }
        .bouncer-table tr.suspicious { background-color:#f2e8e0; }
        .bouncer-table tr.nice { background-color:#e2f2e0; }
        .ic { padding-left:24px; background:4px 2px no-repeat }
        .fr { background-image:url(<?php echo self::$_base_static_url ?>/images/ext/fr.png) }
        .unknown  { background-image:url(<?php echo self::$_base_static_url ?>/images/os/question.png) }
        .explorer { background-image:url(<?php echo self::$_base_static_url ?>/images/browser/explorer.png) }
        .firefox  { background-image:url(<?php echo self::$_base_static_url ?>/images/browser/firefox.png) }
        .safari   { background-image:url(<?php echo self::$_base_static_url ?>/images/browser/safari.png) }
        .opera    { background-image:url(<?php echo self::$_base_static_url ?>/images/browser/opera.png) }
        .chrome   { background-image:url(<?php echo self::$_base_static_url ?>/images/browser/chrome.png) }
        .macosx   { background-image:url(<?php echo self::$_base_static_url ?>/images/os/macosx.png) }
        .windowsxp, .windowsmc { background-image:url(<?php echo self::$_base_static_url ?>/images/os/windowsxp.png) }
        .windowsvista, .windows7 { background-image:url(<?php echo self::$_base_static_url ?>/images/os/windowsvista.png) }
/*        .bouncer-table tr.status5x { background-color:#F0C1D9; }*/
        .bouncer-table tr.status5x { background-color:#EFE2EC; }
        .bouncer-table tr.status4x { background-color:#f2e8e0; }
        .bouncer-table tr.status2x { background-color:#e2f2e0; }
        </style>
        <?php
    }

    public static function search()
    {
        echo '<form method="get" action="" style="margin:0">';
        $value = isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : '';
        echo '<input type="search" name="filter" id="bouncer-filter" class="bouncer-filter" value="' . $value . '"/>';
        // echo '<script type="text/javascript">document.getElementById("bouncer-filter").focus();</script>';
        echo '</form>';
    }

}
