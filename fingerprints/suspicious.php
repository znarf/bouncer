<?php
$suspicious_fingerprints = array(
// Empty
'd41d8cd98f00b204e9800998ecf8427e',
// Near empty fingerprints
'd87a5617df45f58730aa2412008966e9', // Accept:*/*
'd4ad31d6bbd2b13d7e9683b23b1f6680', // Mozilla/5.0
'8d4e52f445afc04479700fb94f606ea2', // Mozilla/5.0 - Accept:*/*
'd3c137acd8ada3e23b5d18a7773260ec', // Mozilla/4.0 - Accept:*/*
'd28f73e67a253fb8503538b92ff5f33f', // Mozilla/3.0 (compatible)
'a55dbce033e47342f4493b6b8e317a11', // Accept-Encoding:identity
'4c67cac030adba659c1ad691368db27e', // Mozilla/4.0 (compatible; ICS)
// Explorer
'eb0fda75ba20c704925bc4fb8cdb1e70',    //  *  - Windows NT4   - Explorer 5.01
'3d75028ca889d244929861337827fb0d',    //  *  - Windows NT4   - Explorer 5.01
'201b89a0f2a212c9f6b73dab58ab9db3',    //  *  - Windows XP    - Explorer 6.0
'71769c0690c09ac31cc2bd7898a107a5',    //  *  - Windows XP    - Explorer 6.0
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
'b7449fcac8672fb618b33bbfe477981a',    // US  - Windows XP    - Explorer 7.0
'd15670bbecb02aa913a84504cd8d3616',    // CN  - Windows XP    - Explorer 6.0
'21f73ced1ec3fc21bd9d74eb037ec189',    //  *  - Windows XP    - Explorer 6.0
'14988d153a79b82f7be01fe79d606cba',    //  *  - Windows XP    - Explorer 6.0
'867b704a2a13789b9a3a750b4ed43bec',    //  *  - Windows 2000  - Explorer 5.01
'05828816332f8981aceacd2f34bda8d4',    //  *  - Windows 98    - Explorer 6.0
'45e08751b9fdccabfdbd9d443d31d1a1',    // HU  - Windows XP    - Explorer 6.0
'49c58c34941eb8e95db60c61a8428d20',    //  *  - Windows XP    - Explorer 6.0
'a8d05109ce1452f434c41086c58763e3',    //  *  - Windows XP    - Explorer 6.0
'f5186afe88cb261c8ec1f312b2a2cbac',    //  *  - Windows Vista - Explorer 7.0
'73c881e466ab54d19382a9a939c9fab7',    // TH  - Windows XP    - Explorer 7.0
'71450477e5b03a0c1204902d8fb522e8',    // AMZ - Windows *     - Explorer 7.0 (user-agent in lowercase)
'2a945eb820e0fb959e0eb42ebcae9c9f',    // US  - Windows XP    - Explorer 8.0
'314bebd09a5bf6aab9b54fd3fdf9ae80',    // CN  - Windows XP    - Explorer 6.0
// Firefox
'2e4572613564df07f322e9d6411afd91',    // CN  - Windows XP    - Firefox 3.0.2
'ae21b88a5f9d9e0f194d197bf3c1b16a',    // KR  - Unknown       - Firefox 3.0.5
'91ab232dff0c02f0cf76e32ebbe7ad42',    //  *  - Windows XP    - Firefox 3.5.1
'eadca6976d78c7a0add477370a5080c1',    //  *  - Windows XP    - Firefox 2.0.0.1
'a450670526ac41f8280e1c8ec229ab7f',    //  *  - Windows XP    - Firefox 2.0.0.1
'95fb4f4df53accd38acbe819b75e36ec',    //  *  - Windows XP    - Firefox 2.0.0.11
'db8a6ab35b03950699e416f7ca192509',    //  *  - Windows Vista - Firefox 3.0.1
'8310c5852ee8d17f39094a923bf537b8',    //  US - MacOS X 10.5  - Firefox 3.6.3
'4679192bb2f9d7a8a77c564a80f7dbd8',    //  US - Windows Vista - Firefox 3.5.3
// Chrome
'e73fee5fd0fe91662c379982c08acc9e',    //  *  - Windows 7     - Chrome 4.0.221.7
// Bots
'40fc775be2dcad9d6d0d798276a6177d', // Mozilla 5.0 - static.theplanet.com
'df67b45c12fea8e8e177b7610ecc5d89', // Picmole
'1d6f0010eec88a0f3ff5f19375a1069d', // CN - Heritrix
'3e2a346099d1c651e4df4bb47f158532', // suchmaschinenoptimierung.de
'd05580236d7563115237363dc740f983', // TREND MICRO
);
return $suspicious_fingerprints;
?>