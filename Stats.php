<?php

class Bouncer_Stats
{

    protected static $_keys = array(
       'time', 'id', 'addr', 'ua', 'fingerprint', 'features', 'score'
    );

    protected static $_connection_keys = array(
      'time', 'id', 'addr', 'ua', 'method', 'server', 'uri', 'code', 'memory', 'exec_time', 'score'
    );

    protected static $_all_keys = array(
      'time', 'id', 'fingerprint', 'addr', 'agent', 'method', 'uri', 'code', 'memory', 'exec_time', 'score'
    );

    protected static $_namespace = '';

    protected static $_ignore_ips = array();

    protected static $_detailed_connections = false;

    protected static $_detailed_ips = false;

    protected static $_detailed_score = false;

    protected static $_detailed_host = false;

    protected static $_detailed_agent = false;

    protected static $_detailed_fingerprint = true;

    protected static $_detailed_ua = true;

    protected static $_max_items = 100;

    protected static $_base_static_url = 'http://h6e.net/bouncer';

    public static function stats(array $options = array())
    {
        require_once dirname(__FILE__) . '/Rules/Browser.php';
        require_once dirname(__FILE__) . '/Rules/Fingerprint.php';
        require_once dirname(__FILE__) . '/Rules/Httpbl.php';
        require_once dirname(__FILE__) . '/Rules/Network.php';
        require_once dirname(__FILE__) . '/Rules/Geoip.php';

        self::setOptions($options);

        $flags = self::getFlags();
        $filterKeys = self::getFilterKeys();

        if (isset($filterKeys['id'])) {
            echo '<table class="bouncer-table">';
            self::agent($filterKeys['id']);
            echo '</table>';
            echo '<br>';
        }

        if (in_array('connections', $flags)) {
            self::$_detailed_host = false;
            self::$_detailed_agent = false;
            self::connections();
        } elseif (in_array('agents', $flags)) {
            self::agents();
        } elseif (array_key_exists('id', $filterKeys) || array_key_exists('connection', $filterKeys)) {
            self::$_detailed_host = false;
            self::$_detailed_agent = false;
            self::connections();
        } elseif (isset($_GET['connection'])) {
            self::connection();
        } elseif (isset($_GET['agent'])) {
            self::agent();
        } else {
            self::agents();
        }

        if (isset($filterKeys['connection'])) {
            echo '<br>';
            echo '<table class="bouncer-table">';
            self::connection($filterKeys['connection']);
            echo '</table>';
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

    public static function filterMatch($filters = array(), $values = array())
    {
        $numericKeys = array('memory', 'size', 'exec_time');
        $partialKeys = array('addr', 'host', 'referer', 'ua', 'uri');
        foreach ($filters as $filter) {
            list($filterKey, $filterValue) = $filter;
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

    public static function display($identity, $keys = array())
    {
        $keys = empty($keys) ? self::$_all_keys : $keys;

        echo '<tr class="status ', $identity['status'], '">';
        foreach ($keys as $key) {
            // Fetch Value
            $value = isset($identity[$key]) ? $identity[$key] : null;
            // Special Keys
            if ($key == 'id') {
                $hex = strlen($value) == 32 ? substr($value, 0, 6) : substr(md5($value), 0, 6);
                $count = Bouncer::backend()->countAgentConnections($identity['id'], self::$_namespace);
                echo
                '<td class="cb" style="border-left-color:#' . $hex . '">' .
                    '<a href="?filter=id%3A' . $value . '">' . (strlen($value) == 32 ? substr($value, 0, 6) : $value) . '</a>' .
                '</td>';
                echo '<td>' . $count . '</td>';
            } elseif ($key == 'connection_id') {
                echo '<td>' . '<a href="?filter=connection%3A' . $value . '">' . substr($value, -6) . '</a>' . '</td>';
            } elseif ($key == 'fingerprint') {
                echo
                '<td class="cb" style="border-left-color:#' . substr($value, 0, 6) . '">' .
                    '<a href="?filter=fingerprint%3A' . $value . '">' . substr($value, 0, 6) . '</a>' .
                '</td>';
                if (self::$_detailed_fingerprint) {
                    $type = isset($identity['fingerprint_type']) ? $identity['fingerprint_type'] : '';
                    echo '<td>' . $type . '</td>';
                    $count = Bouncer::backend()->countAgentsFingerprint($identity['fingerprint'], self::$_namespace);
                    echo '<td>' . $count . '</td>';
                }
            } elseif ($key == 'ua') {
               if (empty($identity['system_label'])) {
                    echo
                    '<td colspan="2" class="cb ic agent-' . $identity['agent_name'] . '" style="border-left-color:#' . substr($identity['hua'], 0, 6) . '">' .
                        '<a href="?filter=hua%3A' . $identity['hua'] . '">' .
                            $identity['agent_label'] .
                        '</a>' .
                    '</td>';
                } else {
                    if (self::$_detailed_agent) {
                        echo
                        '<td class="cb ic system-' . $identity['system_name'] . '" style="border-right:0; border-left-color:#' . substr($identity['hua'], 0, 6) . '">' .
                            $identity['system_label'] .
                        '</td>';
                    } else {
                         echo
                        '<td class="cb compact ic system-' . $identity['system_name'] . ' agent-' . $identity['agent_name'] . '" style="border-right:0; border-left-color:#' . substr($identity['hua'], 0, 6) . '">' .
                            '&nbsp;' .
                        '</td>';
                    }
                    echo
                    '<td class="ic agent-' . $identity['agent_name'] . '" style="border-left:0">' .
                        '<a href="?filter=hua%3A' . $identity['hua'] . '">' .
                            $identity['agent_label'] .
                        '</a>' .
                    '</td>';
                }
                if (self::$_detailed_ua) {
                    $type = isset($identity['fingerprint_type']) ? $identity['fingerprint_type'] : '';
                    echo '<td>' . $type . '</td>';
                    $count = Bouncer::backend()->countAgentsUa($identity['hua'], self::$_namespace);
                    echo '<td>' . $count . '</td>';
                }
            } elseif ($key == 'features') {
                 if (isset($identity['features'])) {
                     echo '<td>' . $identity['features']['image'] . '</td>';
                     echo '<td>' . $identity['features']['iframe'] . '</td>';
                     echo '<td>' . $identity['features']['javascript'] . '</td>';
                 } else {
                     echo '<td colspan="3">', '&nbsp;', '</td>';
                 }
            } elseif ($key == 'addr') {
                if (self::$_detailed_host) {
                    $value = $identity['host'];
                } else {
                    $value = self::compactHost($identity['host'], $identity['addr']);
                }
                echo
                '<td class="cb ic extension-' . $identity['extension'] . '" style="border-left-color:#' . substr($identity['haddr'], 0, 6) . '">',
                    '<a href="?filter=haddr%3A' . $identity['haddr'] . '">' . $value . '</a>',
                '</td>';
                if (self::$_detailed_host) {
                    $comment = isset($identity['addr_comment']) ? $identity['addr_comment'] : '';
                    echo '<td>', $comment, '</td>';
                }
                $count = Bouncer::backend()->countAgentsHost($identity['haddr'], self::$_namespace);
                echo '<td>' . $count . '</td>';
            } elseif ($key == 'agent') {
                if (self::$_detailed_agent) {
                    echo '<td class="ic system-' . $identity['system_name'] . '">' , $identity['system_label'] , '</td>';
                } else {
                    echo '<td class="ic compact system-' . $identity['system_name'] . '">' , '&nbsp;', '</td>';
                }
                echo '<td class="ic agent-' . $identity['agent_name'] . '">', $identity['agent_label'] ,'</td>';
            } elseif ($key == 'time') {
                echo '<td>', '<a href="?filter=connection%3A' . $identity['connection_id'] . '">', date("d/m/Y H:i:s", $value), '</a>', '</td>';
            } elseif ($key == 'memory') {
                if ($value) {
                    echo '<td>', ceil($value/1024/1024) . 'M', '</td>';
                } else {
                    echo '<td>', '&nbsp;' ,'</td>';
                }
            } elseif ($key == 'exec_time') {
                if ($value) {
                    echo '<td>', $value . 's', '</td>';
                } else {
                    echo '<td>', '&nbsp;' ,'</td>';
                }
            } elseif ($key == 'uri') {
                echo '<td>', substr(urldecode($value), 0, 64), '</td>';
            } else {
                if (isset($value)) {
                     echo '<td>', $value ,'</td>';
                } else {
                    echo '<td>', '&nbsp;' ,'</td>';
                }
            }
        }
        echo '</tr>' . "\n";
    }

    public static function compactHost($host, $addr)
    {
        if ($host != $addr) {
            $xhost = explode('.', $host);
            while (count($xhost) > 2) {
                array_shift($xhost);
            }
            $host = implode('.', array_merge(array('*'), $xhost));
        }
        return strlen($host) > 32 ? $addr : $host;
    }

    public static function getFlags()
    {
      $flags = array();
      if (!empty($_GET['filter'])) {
          foreach (explode(' ', $_GET['filter']) as $value) {
              if (strpos($value, ':') === false) {
                $flags[] = $value;
              }
          }
      }
      return $flags;
    }

    public static function getFilters()
    {
      $filters = array();
      if (!empty($_GET['filter'])) {
          foreach (explode(' ', $_GET['filter']) as $f) {
              if (strpos($f, ':')) {
                $filters[] = explode(':', trim($f));
              }
          }
      }
      return $filters;
    }

    public static function getFilterKeys()
    {
        $keys = array();
        foreach (self::getFilters() as $filter) {
            list($filterKey, $filterValue) = $filter;
            if (strpos($filterKey, '-') !== 0) {
                $keys[$filterKey] = $filterValue;
            }
        }
        return $keys;
    }

    public static function tableHeader($keys)
    {
         echo '<tr>';
         foreach ($keys as $key) {
             if ($key == 'id') {
                 echo '<th class="cb" colspan="2">', 'Identity', '</th>';
             } elseif ($key == 'fingerprint') {
                 if (self::$_detailed_fingerprint) {
                    echo '<th class="cb" colspan="3">', 'Fingerprint', '</th>';
                 } else {
                    echo '<th class="cb" colspan="2">', 'Fingerprint', '</th>';
                 }
             } elseif ($key == 'ua') {
                 if (self::$_detailed_ua) {
                    echo '<th class="cb" colspan="4">', 'User Agent', '</th>';
                 } else {
                    echo '<th class="cb" colspan="2">', 'User Agent', '</th>';
                 }
             } elseif ($key == 'addr') {
                 if (self::$_detailed_host) {
                     echo '<th class="cb" colspan="3">', 'Addr', '</th>';
                 } else {
                     echo '<th class="cb" colspan="2">', 'Addr', '</th>';
                 }
            } elseif ($key == 'agent') {
                 // echo '<th style="width:14px">', '', '</th>';
                 echo '<th colspan="2">', 'Agent', '</th>';
             } elseif ($key == 'features') {
                 echo '<th colspan="3">', ucfirst($key), '</th>';
             } elseif ($key == 'connection_id') {
                echo '<th>', 'Connection', '</th>';
             } elseif ($key == 'exec_time') {
                echo '<th>', 'Exec.', '</th>';
             } elseif ($key == 'memory') {
                echo '<th>', 'Mem.', '</th>';
             } elseif ($key == 'method') {
                echo '<th>', 'Meth.', '</th>';
             } else {
                 echo '<th>', ucfirst($key), '</th>';
             }
         }
         echo '</tr>' . "\n";
    }

    public static function agents()
    {
         $filters = self::getFilters();
         foreach ($filters as $filter) {
             list($filterKey, $filterValue) = $filter;
             if ($filterKey == 'fingerprint') {
                 $agents = Bouncer::backend()->getAgentsIndexFingerprint($filterValue, self::$_namespace);
                 break;
             }
             if ($filterKey == 'hua') {
                 $agents = Bouncer::backend()->getAgentsIndexUa($filterValue, self::$_namespace);
                 break;
             }
             if ($filterKey == 'haddr') {
                 $agents = Bouncer::backend()->getAgentsIndexHost($filterValue, self::$_namespace);
                 break;
             }
         }
         if (!isset($agents)) {
             $agents = Bouncer::backend()->getAgentsIndex(self::$_namespace);
         }

         $keys = self::$_keys;

         echo '<table class="bouncer-table">' . "\n";

         self::tableHeader($keys);

         // Agents
         $count = 0;
         foreach ($agents as $time => $id) {
             // Get Identity
             if (!$identity = Bouncer::backend()->getIdentity($id)) {
                 continue;
             }
             // Ignored IPs
             if (in_array($identity['addr'], self::$_ignore_ips)) {
                continue;
             }
             // Get Last Connection
             if (!$connection = Bouncer::backend()->getLastAgentConnection($id, self::$_namespace)) {
                 continue;
             }
             // Add Connection Id
             $connection['connection_id'] = $connection['id'];
             // Merge
             $infos = $identity + $connection;
             // Temporary
             $values = $infos;
             // Filters
             if (self::filterMatch($filters, $values)) {
                continue;
             }
             // Display
             self::display($infos, $keys);
             // Limit
             $count ++;
             if ($count >= self::$_max_items) {
                 break;
             }
         }

         echo '</table>';
    }

    public static function agent($id)
    {
        $identity = Bouncer::getIdentity($id);
        if (empty($identity)) {
            return;
        }

        echo '<tr>', '<th colspan="2">', 'Identity', '</th>', '</tr>';

        echo '<tr>', '<td>', 'User Agent', '</td>',
                     '<td>', '<a href="?filter=hua%3A' . $identity['hua'] . '">', $identity['ua'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Fingerprint', '</td>',
                     '<td>', '<a href="?filter=fingerprint%3A' . $identity['fingerprint'] . '">', $identity['fingerprint'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Agent Type', '</td>',
                     '<td>', '<a href="?filter=agent_type%3A' . $identity['agent_type'] . '">', $identity['agent_type'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Agent Name', '</td>',
                     '<td>', '<a href="?filter=agent_name%3A' . $identity['agent_name'] . '">', $identity['agent_name'], '</a></td>', '</tr>';

        if (isset($identity['agent_version'])) {
            echo '<tr>', '<td>', 'Agent Version', '</td>',
                         '<td>', $identity['agent_version'], '</td>', '</tr>';
        }

        if (isset($identity['system_name'])) {
            echo '<tr>', '<td>', 'OS Name', '</td>',
                         '<td>', $identity['system_name'], '</td>', '</tr>';
        }

        if (isset($identity['system_version'])) {
            echo '<tr>', '<td>', 'OS Version', '</td>',
                         '<td>', $identity['system_version'], '</td>', '</tr>';
        }

        echo '<tr>', '<th colspan="2">', 'Identity Headers', '</th>', '</tr>';
        foreach ($identity['headers'] as $key => $value) {
            echo '<tr>', '<td>', $key, '</td>', '<td>', $value, '</td>', '</tr>';
        }

        echo '<tr>', '<th colspan="2">', 'Addr', '</th>', '</tr>';

        echo '<tr>', '<td>', 'Addr', '</td>',
                     '<td>', '<a href="?filter=haddr%3A' . $identity['haddr'] . '">', $identity['addr'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Hostname', '</td>',
                     '<td>', '<a href="?filter=haddr%3A' . $identity['haddr'] . '">', $identity['host'], '</a></td>', '</tr>';

        echo '<tr>', '<td>', 'Extension', '</td>',
                     '<td>', '<a href="?filter=extension%3A' . $identity['extension'] . '">', $identity['extension'], '</a></td>', '</tr>';

        if (self::$_detailed_score) {
            list($identity, $result) = Bouncer::analyseIdentity($identity);
            list($status, $score, $details) = $result;
            echo '<tr>', '<th>', 'Score', '</th>', '</tr>';
            foreach ($details as $detail) {
                list($value, $message) = $detail;
                echo '<tr>', '<td>', $message, '</td>', '<td>', $value, '</td>', '</tr>';
            }
            echo '<tr>', '<td>', 'Total', '</td>', '<td><b>', $score, '</b></td>', '</tr>';
        }
    }

    public static function connections()
    {
        $filters = self::getFilters();
        foreach ($filters as $filter) {
            list($filterKey, $filterValue) = $filter;
            if ($filterKey == 'connection') {
                $connection = Bouncer::backend()->getConnection($filterValue);
                if ($connection) {
                  $connections = array($filterValue => $connection);
                  break;
                }
            }
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
            if (($filterKey == 'code' && $filterValue != 200) || ($filterKey == '-code' && $filterValue == 200)) {
              $ns = self::$_namespace;
              $not2xIndexKey = empty($ns) ? "connections-not200" : "connections-not200-$ns";
              $connections = Bouncer::backend()->getConnectionsWithIndexKey($not2xIndexKey);
              if (!empty($connections)) {
                break;
              }
            }
            if (($filterKey == 'method' && $filterValue != 'GET') || ($filterKey == '-method' && $filterValue == 'GET')) {
              $ns = self::$_namespace;
              $notGetIndexKey = empty($ns) ? "connections-notGET" : "connections-notGET-$ns";
              $connections = Bouncer::backend()->getConnectionsWithIndexKey($notGetIndexKey);
              if (!empty($connections)) {
                break;
              }
            }
            if ($filterKey == 'exec_time' && $filterValue >= 0.25) {
              $ns = self::$_namespace;
              if ($filterValue >= 2.5) {
                $slowIndexKey = empty($ns) ? "connections-veryslow" : "connections-veryslow-$ns";
              } else {
                $slowIndexKey = empty($ns) ? "connections-slow" : "connections-slow-$ns";
              }
              $connections = Bouncer::backend()->getConnectionsWithIndexKey($slowIndexKey);
              if (!empty($connections)) {
                break;
              }
            }
        }
        if (empty($connections)) {
            $connections = Bouncer::backend()->getConnections(self::$_namespace);
        }

        echo '<table class="bouncer-table">' . "\n";

        $keys = self::$_connection_keys;

        self::tableHeader($keys);

        $count = 0;
        foreach ($connections as $id => $connection) {
          // Add Connection Id
          $connection['connection_id'] = $id;
          // Get Identity
          if (!$identity = Bouncer::backend()->getIdentity($connection['identity'])) {
              continue;
          }
          // Ignored IPs
          if (in_array($identity['addr'], self::$_ignore_ips)) {
            continue;
          }
          // Merge
          $infos = $identity + $connection + [];
          // Software Filter
          if (self::filterMatch($filters, $infos)) {
             continue;
          }
          self::display($infos, $keys);
          // Limit
          $count ++;
          if ($count >= self::$_max_items) {
              break;
          }
        }

        echo '</table>';
    }


    public static function connection($id)
    {
        $connection = Bouncer::get('connection-' . $id);
        if (empty($connection)) {
            return;
        }

        $identity = Bouncer::backend()->getIdentity($connection['identity']);

        // echo '<br>';

        self::agent($connection['identity']);

        // echo '<br>';

        // echo '<table class="bouncer-table">';

        if (!empty($connection['headers'])) {
            echo '<tr>', '<th colspan="2">', 'Request Headers', '</th>' , '</tr>';
            foreach ($connection['headers'] as $key => $value) {
                echo '<tr>', '<td>', $key, '</td>', '<td>', $value, '</td>', '</tr>';
            }
        }

        foreach (array('get', 'post', 'cookie') as $name) {
            if (!empty($connection[$name])) {
                echo '<tr>', '<th colspan="2">', ucfirst($name), '</th>' , '</tr>';
                foreach ($connection[$name] as $key => $value) {
                    echo '<tr>', '<td>', $key, '</td>', '<td>', $value, '</td>', '</tr>';
                }
            }
        }

        $result = Bouncer::analyseRequest($identity, $connection);
        list($status, $score, $details) = $result;

        echo '<tr>', '<th colspan="2">', 'Score', '</th>', '</tr>';
        foreach ($details as $detail) {
            list($value, $message) = $detail;
            echo '<tr>', '<td>', $message, '</td>', '<td>', $value, '</td>', '</tr>';
        }
        echo '<tr>', '<td>', 'Total', '</td>', '<td><b>', $score, '</b></td>', '</tr>';

        // echo '</table>';
    }

    public static function css()
    {
        echo '<style type="text/css">';
        echo '@import url("' . self::$_base_static_url . '/style/bouncer.css");' . "\n";
        echo '@import url("' . self::$_base_static_url . '/style/icons.css");' . "\n";
        echo '</style>';
    }

    public static function search()
    {
        echo '<form method="get" action="" style="margin:0">';
        $value = isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : '';
        echo '<input type="search" name="filter" id="bouncer-filter" class="bouncer-filter" value="' . $value . '"/>';
        echo '</form>';
    }

}
