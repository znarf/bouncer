<?php

namespace Bouncer;

class Challenge
{

    protected static $challenged;

    public static function challenge()
    {
        if (isset($_GET['bouncer-identity']) && isset($_GET['bouncer-feature'])) {
            $id = $_GET['bouncer-identity'];
            $identity = Bouncer::backend()->getIdentity($id);
            if (isset($identity)) {
                if ($_GET['bouncer-feature'] == 'image') {
                    $identity['features']['image'] = $identity['features']['image'] + 2;
                    Bouncer::setIdentity($identity['id'], $identity);
                    header('Content-Type:image/gif');
                    echo base64_decode("R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");
                } elseif ($_GET['bouncer-feature'] == 'javascript') {
                    $identity['features']['javascript'] = $identity['features']['javascript'] + 2;
                    Bouncer::setIdentity($identity['id'], $identity);
                    header('Content-Type:text/javascript');
                    echo base64_decode("R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");
                } elseif ($_GET['bouncer-feature'] == 'iframe') {
                    $identity['features']['iframe'] = $identity['features']['iframe'] + 2;
                    Bouncer::setIdentity($identity['id'], $identity);
                    header("Content-Type:text/html");
                    echo '<html><head><meta name="robots" content="noindex,nofollow"></head><body>&nbsp;</body></html>';
                }
            }
            exit;
        }

        if (self::$challenged) {
            return;
        }

        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        if ($method == 'HEAD' || $method == 'OPTIONS') {
            return;
        }

        if (isset($_SERVER['HTTP_X_MOZ'])) {
            return;
        }

        $identity = Bouncer::identity();
        if (empty($identity)) {
            return;
        }

        if ($identity['agent_type'] == Bouncer::BROWSER) {
            $store = false;
            if (empty($identity['features'])) {
                $identity['features'] = array('iframe' => 0, 'javascript' => 0, 'image' => 0);
            }
            if ($identity['features']['image'] < 1 && $identity['features']['image'] > -5) {
                $url = '?bouncer-challenge=1&bouncer-identity=' . $identity['id']  . '&bouncer-feature=image&t=' . time();
                $style = 'position:absolute;border:0;width:1px;height:1px;left:0;top:0;background:red;';
                echo '<img style="' . $style . '" src="' . $url  . '"/>';
                $identity['features']['image'] = $identity['features']['image'] - 1;
                $store = true;
            }
            if ($identity['features']['iframe'] < 1 && $identity['features']['iframe'] > -5) {
                $url = '?bouncer-challenge=1&bouncer-identity=' . $identity['id']  . '&bouncer-feature=iframe&t=' . time();
                $style = 'position:absolute;border:0;width:1px;height:1px;left:2px;top:0;background:transparent;';
                echo '<iframe style="' . $style . '" src="' . $url  . '"></iframe>';
                $identity['features']['iframe'] = $identity['features']['iframe'] - 1;
                $store = true;
            }
            if ($identity['features']['javascript'] < 1 && $identity['features']['javascript'] > -5) {
                $url = '?bouncer-challenge=1&bouncer-identity=' . $identity['id']  . '&bouncer-feature=javascript&t=' . time();
                $style = 'position:absolute;border:0;width:1px;height:1px;left:1px;top:0;background:lime;';
                echo '<script type="text/javascript">';
                echo 'document.write(\'<img style="' . $style . '" src="' . $url  . '"/>\');';
                echo '</script>';
                $identity['features']['javascript'] = $identity['features']['javascript'] - 1;
                $store = true;
            }
            if ($store) {
                Bouncer::setIdentity($identity['id'], $identity);
            }
            self::$challenged = true;
        }
    }

}
