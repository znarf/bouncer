<?php

class Bouncer_Rules_Bbclone
{

    public static function load()
    {
        Bouncer::addRule('agent_infos', array('Bouncer_Rules_Bbclone', 'agentInfos'));
        // Bouncer::addRule('ip_infos', array('Bouncer_Rules_Bbclone', 'ipInfos'));
    }

    public static function agentInfos($infos)
    {
        $user_agent = $infos['user_agent'];

        if ($robot = self::detect('robot', $user_agent)) {
            $infos['type'] = Bouncer::ROBOT;
            $infos['name'] = $robot[0];
            $infos['version'] = $robot[1];

        } else if ($browser = self::detect('browser', $user_agent)) {
            $infos['type'] = Bouncer::BROWSER;
            $infos['name'] = $browser[0];
            $infos['version'] = $browser[1];
            $infos['os'] = $os = self::detect('os', $user_agent);
            $infos['os_name'] = $os[0];
            $infos['os_version'] = $os[1];
        }

        return $infos;
    }

    public static function ipInfos($infos)
    {
        $infos['extension'] = self::getExtension($infos['host'], $infos['addr']);
        return $infos;
    }

    protected static function detect($type = 'browser', $user_agent)
    {
        require (dirname(__FILE__) . "/../lib/$type.php");

        foreach ($$type as $id => $b) {
            if ($id == 'other') {
                continue;
            }
            foreach ($b['rule'] as $pattern => $note) {
                // id = name
                if (preg_match('~'.$pattern.'~i', $user_agent, $regs)) {
                     // str = version
                     $str = '';
                     if (preg_match(":\\\\[\d]{1}:", $note)) {
                        $str = preg_replace(":\\\\([\d]{1}):", "\$regs[\\1]", $note);
                        eval("\$str = \"$str\";");
                    }
                    $detect = array($id, $str);
                    return $detect;
                }
            }
        }

        return null;
    }

    protected static function legacy_ext($ext, $array)
    {
      if (preg_match(":^[\d]+$:", $ext)) return "numeric";
      elseif (!in_array($ext, $array)) return "unknown";
      else return $ext;
    }

    public static function getExtension($host, $addr)
    {
      $BBC_IP2EXT_PATH = dirname(__FILE__) . '/../ip2ext/';

      // generic extensions which need to be looked up first
      $gen_ext = array(
        "ac", "aero", "ag", "arpa", "as", "biz", "cc", "cd", "com", "coop", "cx", "edu", "eu", "gb", "gov", "gs", "info",
        "int", "la", "mil", "ms", "museum", "name", "net", "nu", "org", "pro", "sc", "st", "su", "tc", "tf", "tk", "tm",
        "to", "tv", "vu", "ws"
      );
      // hosts with reliable country extension don't need to be looked up
      $cnt_ext = array(
        "ad", "ae", "af", "ai", "al", "am", "an", "ao", "aq", "ar", "at", "au", "aw", "az", "ba", "bb", "bd", "be", "bf",
        "bg", "bh", "bi", "bj", "bm", "bn", "bo", "br", "bs", "bt", "bv", "bw", "by", "bz", "ca", "cf", "cg", "ch", "ci",
        "ck", "cl", "cm", "cn", "co", "cr", "cs", "cu", "cv", "cy", "cz", "de", "dj", "dk", "dm", "do", "dz", "ec", "ee",
        "eg", "eh", "er", "es", "et", "fi", "fj", "fk", "fm", "fo", "fr", "ga", "gd", "ge", "gf", "gg", "gh", "gi", "gl",
        "gm", "gn", "gp", "gq", "gr", "gt", "gu", "gw", "gy", "hk", "hm", "hn", "hr", "ht", "hu", "id", "ie", "il", "im",
        "in", "io", "iq", "ir", "is", "it", "je", "jm", "jo", "jp", "ke", "kg", "kh", "ki", "km", "kn", "kp", "kr", "kw",
        "ky", "kz", "lb", "lc", "li", "lk", "lr", "ls", "lt", "lu", "lv", "ly", "ma", "mc", "md", "me", "mg", "mh", "mk",
        "ml", "mm", "mn", "mo", "mp", "mq", "mr", "mt", "mu", "mv", "mw", "mx", "my", "mz", "na", "nc", "ne", "nf", "ng",
        "ni", "nl", "no", "np", "nr", "nz", "om", "pa", "pe", "pf", "pg", "ph", "pk", "pl", "pm", "pn", "pr", "ps", "pt",
        "pw", "py", "qa", "re", "ro", "ru", "rs", "rw", "sa", "sb", "sd", "se", "sg", "sh", "si", "sj", "sk", "sl", "sm",
        "sn", "so", "sr", "sv", "sy", "sz", "td", "tg", "th", "tj", "tl", "tn", "tp", "tr", "tt", "tw", "tz", "ua", "ug",
        "uk", "um", "us", "uy", "uz", "va", "vc", "ve", "vg", "vi", "vn", "wf", "ye", "yt", "yu", "za", "zm", "zr", "zw"
      );

      $file = $BBC_IP2EXT_PATH.(substr($addr, 0, strpos($addr, ".")).".inc");
      $ext = strtolower(substr($host, (strrpos($host, ".") + 1)));

      // Don't look up if there's already a country extension
      if (in_array($ext, $cnt_ext)) return $ext;
      if (!is_readable($file)) return self::legacy_ext($ext, $gen_ext);

      $long = ip2long($addr);
      $long = sprintf("%u", $long);
      $fp = fopen($file, "rb");

      while (($range = fgetcsv($fp, 32, "|")) !== false) {
        if (($long >= $range[1]) && ($long <= ($range[1] + $range[2] - 1))) {
          // don't hose our stats if the database returns an unexpected extension
          $db_ext = (in_array($range[0], $cnt_ext) || in_array($range[0], $gen_ext)) ? $range[0] :
                    self::legacy_ext($ext, $gen_ext);
          break;
        }
      }
      fclose($fp);

      return (!empty($db_ext) ? $db_ext : self::legacy_ext($ext, $gen_ext));
    }

}
