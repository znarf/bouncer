<?php
$known_fingerprints = array(
// Facebook
'22a5eee46083360de8bc4beca9c8fe2d',  // http://www.facebook.com/externalhit_uatext.php
'ddb1e86b32cf145e05a6e0a52e92f174',  // FacebookFeedParser
'6d7c13b80393caf44744488e477e7e55',  // facebook share (http://facebook.com/sharer.php)
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
'812a7eb82cd88810f66bd415598828ac',  // US - Windows 2003  - Explorer 6.0
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
'98e414a4caa45ad58ce03028adee6cdb',  // bitlybot
'37a95c66ec11cc628a1aeadf2dfbb84f',  // WebVac
// Nagios
'f13c1c8a68a515732ff72cc498f66dc4',
'5bffca1b20894579bd276a36a6f5ca86',
// Browsers
'c54cc4c78527d6b3d1a6c4e2c7985b2d',  // FR - Windows XP - Explorer 6.0
'f60a395ee95725480e2f56a68dbf6521',  // FR - Windows XP - Explorer 6.0
'ec0ca634072614e1a83522e857a6e0b7',  // ES - Windows XP - Explorer 6.0
'14387686ae699c119579e09342d35c65',  // IN - Windows XP - Explorer 6.0
'b5f86f22b42c905d30ecd11d0e767bb1',  // FR - Windows XP - Explorer 8.0
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
return $known_fingerprints;
?>