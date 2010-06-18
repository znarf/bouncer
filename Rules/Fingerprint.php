<?php

class Bouncer_Rules_Fingerprint
{

    protected static $_cache = array();

    public static function load()
    {
        Bouncer::addRule('browser_identity', array('Bouncer_Rules_Fingerprint', 'analyseIdentity'));
        Bouncer::addRule('robot_identity', array('Bouncer_Rules_Fingerprint', 'analyseIdentity'));
    }

    public static $suspicious_fingerprints = array(
        // Empty
        'd41d8cd98f00b204e9800998ecf8427e',
        // Near empty fingerprints
        'd87a5617df45f58730aa2412008966e9', // Accept:*/*
        'd4ad31d6bbd2b13d7e9683b23b1f6680', // Mozilla/5.0
        '8d4e52f445afc04479700fb94f606ea2', // Mozilla/5.0 - Accept:*/*
        'd3c137acd8ada3e23b5d18a7773260ec', // Mozilla/4.0 - Accept:*/*
        'd28f73e67a253fb8503538b92ff5f33f', // Mozilla/3.0 (compatible)
        // Comment Spam
        '476f7382c6de03533d1d84302a3c16d6',    //  PL - Windows 7     - Explorer 7.0
        'd72e329d83dbc23e65b7d8412dbe31b8',    //  *  - Windows XP    - Explorer 6.0
        '00e9cd8e4ffc0d2d5ab8236bc062773b',    //  *  - Windows XP    - Explorer 6.0
        // Explorer
        'eb0fda75ba20c704925bc4fb8cdb1e70',    //  *  - Windows NT4   - Explorer 5.01
        '3d75028ca889d244929861337827fb0d',    //  *  - Windows NT4   - Explorer 5.01
        '201b89a0f2a212c9f6b73dab58ab9db3',    //  *  - Windows XP    - Explorer 6.0  - (No Accept)
        '71769c0690c09ac31cc2bd7898a107a5',    //  *  - Windows XP    - Explorer 6.0  - (Accept:*/*) - POST - .NET CLR 2.0.50727
        '9887c55fda215fd9fe03e9bab9d51839',    //  *  - Windows XP    - Explorer 6.0
        '6b132ced76c43a575a702ac7917c2991',    // TW  - Windows XP    - Explorer 6.0
        '4d12feadaaa0d2de366391b5f26d9723',    // PE  - Windows XP    - Explorer 6.0
        'a83d11e2c4b78a31f922ac5e6535bd02',    // CN  - Windows XP    - Explorer 6.0
        '407fa0dab1fc4043e1dd5d197b5d3b7c',    //  *  - Windows MC 6  - Explorer 8.0
        '7b9e8b3e15f083ffd4003d6348a862b5',    // OVH - Windows XP    - Explorer 7.0
        'b8d0719eff7b8a004be2d7f5448e925b',    // OVH - Windows 2000  - Explorer 5.01
        '2047328ac27d87da7e4411f1ad2929f1',    // US  - Windows NT4   - Explorer 5.5
        '30f91bc221190f9aa1ae3c357300af11',    // US  - Windows 2000  - Explorer 6.0
        '938331c1534578621896d7be51bc4de3',    // US  - Windows XP    - Explorer 7.0
        '57b72e387d0933fe5633aea57423f26f',    // US  - Windows 98    - Explorer 6.0
        'b7449fcac8672fb618b33bbfe477981a',    // US  - Windows XP    - Explorer 7.0 - rrcs-24-39-1-XXX.nys.biz.rr.com
        'd15670bbecb02aa913a84504cd8d3616',    // CN  - Windows XP    - Explorer 6.0
        '21f73ced1ec3fc21bd9d74eb037ec189',    //  *  - Windows XP    - Explorer 6.0
        '14988d153a79b82f7be01fe79d606cba',    //  *  - Windows XP    - Explorer 6.0
        '867b704a2a13789b9a3a750b4ed43bec',    //  *  - Windows 2000  - Explorer 5.01
        // Firefox
        '2e4572613564df07f322e9d6411afd91',    // CN  - Windows XP    - Firefox 3.0.2
        'ae21b88a5f9d9e0f194d197bf3c1b16a',    // KR  - Unknown       - Firefox 3.0.5
        '91ab232dff0c02f0cf76e32ebbe7ad42',    //  *  - Windows XP    - Firefox 3.5.1
        'eadca6976d78c7a0add477370a5080c1',    //  *  - Windows XP    - Firefox 2.0.0.1
        'a450670526ac41f8280e1c8ec229ab7f',    //  *  - Windows XP    - Firefox 2.0.0.1
        '95fb4f4df53accd38acbe819b75e36ec',    //  *  - Windows XP    - Firefox 2.0.0.11
        'db8a6ab35b03950699e416f7ca192509',    //  *  - Windows Vista - Firefox 3.0.1
        // Chrome
        'e73fee5fd0fe91662c379982c08acc9e',    //  *  - Windows 7     - Chrome 4.0.221.7
        // Bots
        '40fc775be2dcad9d6d0d798276a6177d', // Mozilla 5.0 - static.theplanet.com
        'df67b45c12fea8e8e177b7610ecc5d89', // Picmole
        '1d6f0010eec88a0f3ff5f19375a1069d', // CN - Heritrix
        'd7fa3f69257dc55089917fc571daedbc', // acquia-crawler
        '3e2a346099d1c651e4df4bb47f158532', // suchmaschinenoptimierung.de
        'd05580236d7563115237363dc740f983', // TREND MICRO
    );

    public static $banned_fingerprints = array(
        // Browsers
        '800debb6bf463b5c72336a2ab6c76176', // JP - Windows XP   - Explorer 6.0   - (.asianetcom.net),
        'd4a3108acff0dd17752192df5d175333', // KR - MacOS X 10.5 - Firefox 3.0.6
        // BM Spam
        '2d427eaca8980ae196a9c003780057c8', //  *  - Windows 2000  - Explorer 6.0
        // Bots
        '6135b0ff46c9c6168ef13c221f3528b5', // SN - DTS Agent
        'dcf57bea9a755eea1f8de282f4c3279a', // CN - Indy Library
        '61dc815933fe47026e1cdf0f5dc7ffbc', // CN - Indy Library
        'ea61161ef904102c26654f77fbc1af27', //  * - Larbin 2.6.3
        // Fake Google
        'a8c59cca16eb7d753659ae07aa6745bb',
        '834f20c97f18fc1fa04ddd63f11ec2e8',
        'b1c0361564c267d2786dd731a346af77',
        // Lib WWW
        'dd2cce743b64f2b797fa3bba306f387a', //  * - libWWW 5.76
        'c67c0196c4ad44c35b1f2f3160a96fcd', //  * - libWWW 5.79
        'f706d25efc54ba36bbc61a288612071e', //  * - libWWW 5.800
        '020801d2d515f2fa3a50d70dd8f846be', //  * - libWWW 5.808
        '2a50b1f21abfc30c5b6494d19e672866', //  * - libWWW 5.803
        '6ca73eacc292a19896f58dd5b17b6652', //  * - libWWW 5.805
        '1d38e98da2e7509bb37d14989560800f', //  * - libWWW 5.810
        'a029b4d65c51fcd4d67551c0ae97f529', //  * - libWWW 5.811
        '95dde41a36a4c266b9bc520a9d4a8f1f', //  * - libWWW 5.812
        '49a2baabfc2a9ed50086f75b4dda5a0b', //  * - libWWW 5.825
        '63fe534afc8cfc5afb0c90c40619dafa', //  * - libWWW 5.831
        'ca6b56b9244a2201fedad435c76333c2', //  * - libWWW 5.833
        '953a6b376f8c3cf19d6a99cd52f933bc', //  * - libWWW 5.834
        '10cabc19da6511f5655f29c4aa871d85', //  * - libWWW 5.836
        // Java
        '013c9e2e72d01a71528ea3e5828287f0', // Java/1.4.1_04
        'ecc03938cc08478c23e6fe702ae7b715', // Java/1.6.0_0
        'dcf79fc274f3da000292130426613878', // Java/1.6.0_04
        '917375f84c04b9515fee277caa61a1c9', // Java/1.6.0_06
        'aa8ba6fd98fd9085ec08ede5cd67b941', // Java/1.6.0_14
        '5416d4958dd6569e17f2269de5f64f46', // Java/1.6.0_17
        'b1844cc5196d7f0642a7f390e2d028f7', // Java/1.6.0_18
        '4616e11d99bdf4cdf877be2b67cb61c2', // Java/1.6.0_19
        'cd0e52f56c70ca6b149c9d41af4f698b', // Java/1.6.0_20
    );

    public static $known_fingerprints = array(
        // Google Wireless
        '0f90768387e17021566a40bdc5ed4b0c',  //  * - Google Wireless Transcoder
        '46c694c4e4e26cd05657ff74cf9300da',  //  * - Google Wireless Transcoder
        // Microsoft Suspicous Crawlers
        '970fa08c4ee995e7dde6b45b69bd9fb9',  // US - Windows Vista - Explorer 7.0
        '0d8c0fe3cbecc12b7c4d416786be82bd',  // US - Windows 2003  - Explorer 6.0
        '498aa0376230d5dd29b93242493a47d1',  // US - Windows 2003  - Explorer 6.0
        '86b514d5a14bff1d237affaee680dbe1',  // US - Windows XP    - Explorer 6.0
        '9f93e51b6cfe93f6da579b96452e4e22',  // US - Windows 2003  - Explorer 6.0
        '7db6eb564b3454843085b7e112fc08a0',  // US - Windows 2003  - Explorer 6.0
        'a03692f17fca1183f81571b323b06603',  // US - Windows XP    - Explorer 6.0
        '680cf2aea17429b27f8f43e3332cf20d',  // US - Windows XP    - Explorer 6.0
        // Crawlers
        'e69ff737f65a3b12adf29016e5ada98d',  // http://www.seoprofiler.com/bot
        '2e3e78982b709fcee9558e17726c7638',  // BNF
        '16e7bbc8f77ff058af8b2343b3115e72',  // INA
        '0a524df12ce230d76cf2abc04d94e7ad',  // DotSpotsBot/0.2 (crawler; support at dotspots.com)
        '8c3c59cf7f249feecf359881ef36576e',  // Mozilla crawl/5.0 (compatible; fairshare.cc +http://fairshare.cc)
        'eea168b7c9d0d958c6e9b29e1212414b',  // Search17 Web Crawler
        '65a6a88c94f8a9f6dbd11f129271843b',  // SheenBot
        '4244fa19396ed9f656d60a0f424abcd5',  // Twenga
        'b553cdef9205ddab1b33c9f4777ebd4f',  // Brandwatch
        'db01ac7d8b3807323e1e1db2069fd679',  // http://www.chainn.com/mxbot.html
        // Browsers
        'c54cc4c78527d6b3d1a6c4e2c7985b2d',  // FR - Windows XP - Explorer 6.0
        'f60a395ee95725480e2f56a68dbf6521',  // FR - Windows XP - Explorer 6.0
        'ec0ca634072614e1a83522e857a6e0b7',  // ES - Windows XP - Explorer 6.0
        '14387686ae699c119579e09342d35c65',  // IN - Windows XP - Explorer 6.0
        // RSS
        '8e756bbd8fd1b053856ce00735d9fe6f',  // US - Apple-PubSub 65.19
        '7ac14d372759acefcf867c15ffeffec0',  // GB - Apple-PubSub 65.19
        '9acfacf72fee443f8ee3c437ed847fac',  // FR - Apple-PubSub 65.19
        'fdc2442a41e8d683b8583643489f59e4',  // DE - Apple-PubSub 65.19
        '4749f1c7f7346a7f1f5b7f0d0e543467',  // JP - Apple-PubSub 65.19
        '21f0cb2cdf1f6f93f5a3b10e577df842',  // US - Apple-PubSub 65.12.1
        '34ce75b388f7d016655d3e8f4e9b4dc3',  // FR - Apple-PubSub 65.12.1
        '60248970d4202b916d13bc9634f1c9cf',  // IT - Apple-PubSub 65.12.1
        '9056d759336e5c04a43e8fc53d4d83f5',  // DK - Apple-PubSub 65.12.1
        '54cc3a0885c3de1d510251a77b893a8d',  // DE - Apple-PubSub 65.12.1
        '5b9716640f9bda92f449edb1ab65ad75',  // BR - Apple-PubSub 65.12.1
        'd69a16e600d8bcf2e62247e50b939bf6',  // TW - Apple-PubSub 65.12.1
        'ae956247ba90b100d8a6f84f56694f2f',  // KR - Apple-PubSub 65.12.1
        'f9a94ccbf9a5c4a1d89a325ec48b4a82',  // JP - Apple-PubSub 65.12.1
        '08d540eadd7470c7cff1270c0e34c7ea',  // ES - Apple-PubSub 65.12.1
        '4651e1f2972c049bcd63cdc7fdaa5e47',  // US - Apple-PubSub 65.11
        'd364febb3fb6afee911877589738e6e4',  // FR - Apple-PubSub 65.11
        '52790b3c1e9e7707e420725a0e6fd161',  // DE - Apple-PubSub 65.11
        '4d908f72752d2a627f8d057ef18b86a0',  // ES - Apple-PubSub 65.11
        'b29c7c4d8fa9ebf7847cccc913f2a3f9',  // NL - Apple-PubSub 65.11
        '8808c9db1008304e0e77cdb45cd852c9',  // FR - Apple-PubSub 65.1.4
        '4426ccebdb8efd4884ad3c8b187bbbd0',  // FR - Apple-PubSub 65
        'b906752d12c59f44cc54f26e090a0c6d',  // FR - AppleSyndication
        '456b14879e2280c76c1c949b805f821d',  // FR - AppleSyndication/56.1
        'f25748fc2c3c617fba53199f337f7131',  // IT - AppleSyndication/56.1
    );

    public static function analyseIdentity($identity)
    {
        $scores = array();

        $fingerprint = $identity['fingerprint'];

        if (in_array($fingerprint, self::$banned_fingerprints)) {
            $scores[] = array(-10, 'Banned Fingerprint');

        } else if (in_array($fingerprint, self::$known_fingerprints)) {
            $scores[] = array(0, 'Known Fingerprint');

        } else if (in_array($fingerprint, self::get('browser'))) {
            $scores[] = array(5, 'Browser Fingerprint');

        } else if (in_array($fingerprint, self::$suspicious_fingerprints)) {
            $scores[] = array(-5, 'Suspicious Fingerprint');

        } else if (in_array($fingerprint, self::get('botnet'))) {
            $scores[] = array(-5, 'Botnet Fingerprint');

        }

        return $scores;
    }

    public static function getType($fingerprint)
    {
        if (in_array($fingerprint, self::$banned_fingerprints)) {
            return 'banned';

        } else if (in_array($fingerprint, self::$suspicious_fingerprints)) {
            return 'suspicious';

        } else if (in_array($fingerprint, self::$known_fingerprints)) {
            return 'known';

        } else if (in_array($fingerprint, self::get('browser'))) {
            return 'browser';

        } else if (in_array($fingerprint, self::get('botnet'))) {
            return 'botnet';

        }
        return null;
    }

    public static function get($type)
    {
        if (isset(self::$_cache[$type])) {
            return self::$_cache[$type];
        }
        return self::$_cache[$type] = include dirname(__FILE__) . '/../fingerprints/' . $type . '.php';
    }

}
