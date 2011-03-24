<?php
$known_fingerprints = array(
// Top Bots
'793f840d86e2554135283d9aef58c7ff',  // Googlebot
'c81a634f3f75e335030284bf4c72bd2f',  // Yahoo! Slurp
'cabf78b12c02f825861abeeacc4882fa',  // Yahoo! Slurp
'273cf731218cee6bbea75c880c6de3c3',  // Baidu (cn)
'8f810bd4a1eec86aec316f2245500d47',  // Baidu (jp)
'35d55b760b985cf233ad9466fd38dee8',  // Baidu (jp - mobile)
'72604be2402cd5d1cfc84a413516a0da',  // Bingbot
'6dcd83439ea1c096a43b0f06811e64d2',  // Bingbot
'ab12474fbc997f8655ca93952784393b',  // Yandex
'43d28f2be01110e87ffe3cb9d62d1f44',  // Mj12
'51a89973db58d37e29a07b0823157318',  // Mj12
'1ba3e09e05c3a64578777e53d4f20a3c',  // DotBot
'a86f74048055ff8ea8a8570615c478f4',  // Sogou
'd970c6ffb8d5547d9f6052207200b0dd',  // ScoutJet
'62f42b9e966080ce33cdaef257458dd7',  // Spinn3r
// Facebook
'22a5eee46083360de8bc4beca9c8fe2d',  // http://www.facebook.com/externalhit_uatext.php
'ddb1e86b32cf145e05a6e0a52e92f174',  // FacebookFeedParser
'6d7c13b80393caf44744488e477e7e55',  // facebook share (http://facebook.com/sharer.php)
'afa4788739136af0b8de6d47868ee2f7',  // http://friendfeed.com/about/bot
'9e717c7cb2cddb32396c2cd53c06080d',  // facebookexternalhit/1.0 (+http://www.facebook.com/externalhit_uatext.php)
'09f23681d71f4a667432fa11c8465f5c',  // facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)
'656fbf00aebce50ee22eb07b115c6395',  // Facebook share follower
// Google
'6f82b98fc53efbaca170d51e67469860',  //  * - Google Translate
'e06615d3118241037d7314f5b9411105',  //  * - Google Desktop
'3ae6cc7f31314756b846e1b49bf2f09c',  //  * - Google Web Preview
'11f6da515b0304a457a4e449c6053127',  // urlresolver
// MSN / Bing
'34f895d7de2f45b4ee2a57a6ece95518',
'f546324447d3ea14f88b35dc4083454f',
'84c29cf970522cd3727c8627bd01a949',
'788ac1a26b08052bc106a19dc505e3c9',
'55a3ca444259a2b25c0072a7454ab99c',
// App Engine Apps
'ab44e9e98d2763d6dd77a88fad021077',  // networkedhub
'e625657d8c7bbdd6e9fa2c5502086ef7',  // linksalpha
'380c7335752386c015df396e2616bf2d',  // networkedblogs
'7392c65f7872a8be46b2c68c9bc46fb4',  // lookingglass-server
'962a8dc6b0c4f1f0d67568c50b31da66',  // mapthislink
'06ca030f40974c9f8a30718e261bdfe5',  // rtweetme
'86da1e9551b784725ced8434be16755d',  // getfavicon
'337fb2b23192d6dbdfa9031e1468fb92',  // rtweetme
'5577bdd018c3f246007dd1bb07f0d81f',  // pubsubhubbub
'377ded6a5ede231bc66e65c80a4437ac',  // unblock4myspace
'55971403dc3cbdd67d3dcf3ad872d5ca',  // twitter-trending-topics
'8c1bfd4e130c5ae33d180bea4d96b5a6',  // botanyfree
'2254fbea58cd0557c6ac4e08fdc7aad1',  // kiwi78
// Crawlers
'2e3e78982b709fcee9558e17726c7638',  // BNF
'0a524df12ce230d76cf2abc04d94e7ad',  // DotSpotsBot/0.2 (crawler; support at dotspots.com)
'eea168b7c9d0d958c6e9b29e1212414b',  // Search17 Web Crawler
'65a6a88c94f8a9f6dbd11f129271843b',  // SheenBot
'4244fa19396ed9f656d60a0f424abcd5',  // Twenga
'b553cdef9205ddab1b33c9f4777ebd4f',  // Brandwatch
'db01ac7d8b3807323e1e1db2069fd679',  // http://www.chainn.com/mxbot.html
'98e414a4caa45ad58ce03028adee6cdb',  // bitlybot
'37a95c66ec11cc628a1aeadf2dfbb84f',  // WebVac
'934b30bd6857304ebb8cdbc0e2be3953',  // TweetmemeBot
'4244fa19396ed9f656d60a0f424abcd5',  // TwengaBot-Discover (http://www.twenga.fr/bot-discover.html)
'c6ee697b0d3ed706ac974e45fa16221a',  // http://www.ellerdale.com/crawler.html
'eb69ec8038e09c15dc6c7bf544814076',  // http://www.hpi.uni-potsdam.de/meinel/bross/feedcrawler
'00bb892963ac734a8eeb681e23d01395',  // Twitterbot/0.1
'a42e96a3dc3f855d3d60264307ad28aa',  // http://support.embed.ly/home
'ba1b1f5bd2fff182d02bebcae1238b62',  // Twitturly / v0.6
'b02ebc3b48874c4b0a101a709dbdd379',  // acquia-crawler
'be659eb627ef3c2fd42705e4e5d39044',  // ThingFetcher; (+http://thinglabs.com)
'8ccb889b7d69bb8e0453258c55db3c07',  // SurveyBot/2.3 (DomainTools)
'2708e9c06a83250e6bcab443f73c71e3',  // http://page-store.com/
'6afae750923289d89eb638a6a7ae8947',  // librabot/2.0 (+http://academic.research.microsoft.com/)
'9c1bb51b327c07997fe1971925a5149e',  // librabot/2.0 (+http://academic.research.microsoft.com/)
'87d77eade01d9fcc73680ed520ea5e81',  // Netvibes - BM
'6df8bda832ecbb4ad20ec624d6c86fdb',  // Netvibes - Mozilla/5.0 (compatible)
'776e9d435c5a3b3fd4024863e771a7f2',  // Netvibes - Mozilla/5.0 (compatible)
'68c1cbc196603b22c85c48b32a6bbd51',  // Clearbricks Feed Reader/0.2
'1084f8680db0ef2d421e257cc9739867',  // sfFeedReader/0.9
'3e2a346099d1c651e4df4bb47f158532',  // suchmaschinenoptimierung.de
'4de3da80257ab637e8612f9469fe968f',  // cloud4search.com ?
'81042c2f26c945a805781c10f675d23c',  // 80legs
'bfd0336b65cddb768fb25b2e994eb4d6',  // 80legs
// Flash (eg: WP image uploader)
'd22d47791a32b40fc841754dde0784e4',  // Adobe Flash Player 9
'4f4c2a419649c56cad7d3cca8dc9eeb6',  // Adobe Flash Player 10
'11ef0d39f0f9d3fb96063c9b867198aa',  // Shockwave Flash
// Nagios
'f13c1c8a68a515732ff72cc498f66dc4',
'5bffca1b20894579bd276a36a6f5ca86',
// Browsers
'c54cc4c78527d6b3d1a6c4e2c7985b2d',  // FR - Windows XP - Explorer 6.0
'f60a395ee95725480e2f56a68dbf6521',  // FR - Windows XP - Explorer 6.0
'ec0ca634072614e1a83522e857a6e0b7',  // ES - Windows XP - Explorer 6.0
'14387686ae699c119579e09342d35c65',  // IN - Windows XP - Explorer 6.0
'b5f86f22b42c905d30ecd11d0e767bb1',  // FR - Windows XP - Explorer 8.0
'98382a7339a5175ad37a386a5bf74b89',  // BR - Windows XP - Explorer 7.0
'98382a7339a5175ad37a386a5bf74b89',  // BR - Windows XP - Explorer 6.0
// RSS
'5b2361fdf1c6e31b99a55def5adfea6e',  // SimplePie/1.1.1 (Moonmoon)
'09e5ec4c2fb7c5fcdced58de35f6e289',  // FR - Windows-RSS-Platform/2.0 (MSIE 8.0; Windows NT 5.1)
'672d83bd134d933f94213e574809e979',  // US - Apple-PubSub 65.21
'38e1732d732fe5a8713ef5777d7cd1e9',  // FR - Apple-PubSub 65.21
'7b472e49a23538d70cf75623e6de1bd5',  // ES - Apple-PubSub 65.21
'9f7f585c45cfdc3dad31fad8e504b68e',  // DE - Apple-PubSub 65.21
'38f90373f8230038ba302dbfb4366540',  // IT - Apple-PubSub 65.21
'568e4f198f840ab6a3b346ec14edd866',  // JP - Apple-PubSub 65.21
'48f48b60e48af65e9fc20bc99971e76d',  // US - Apple-PubSub 65.20
'7322bf08f0f24445f48613e0c3488610',  // FR - Apple-PubSub 65.20
'1d50ef3c11cbeb999a8aa3ab5dfbe966',  // EN - Apple-PubSub 65.20
'29573c121c6b60491cfbf82e021b2f43',  // ES - Apple-PubSub 65.20
'0ef25273f985d74a4d5268e921fece79',  // JP - Apple-PubSub 65.20
'49150c78f0d39898e3ddba9cbcac2d4e',  // DE - Apple-PubSub 65.20
'c57228f2504118b78c338cf6c62299e7',  // IT - Apple-PubSub 65.20
'47702517895b09e7e3e3d383de0bc613',  // BR - Apple-PubSub 65.20
'dd707631423f5bc61abdb61af6c58295',  // DK - Apple-PubSub 65.20
'b74efe030453e0bf7094bd03d136adde',  // NL - Apple-PubSub 65.20
'8e756bbd8fd1b053856ce00735d9fe6f',  // US - Apple-PubSub 65.19
'7ac14d372759acefcf867c15ffeffec0',  // GB - Apple-PubSub 65.19
'9acfacf72fee443f8ee3c437ed847fac',  // FR - Apple-PubSub 65.19
'fdc2442a41e8d683b8583643489f59e4',  // DE - Apple-PubSub 65.19
'4749f1c7f7346a7f1f5b7f0d0e543467',  // JP - Apple-PubSub 65.19
'1ab88260c3c9d004408d693c7cd770fb',  // IT - Apple-PubSub 65.19
'2569e538829f558ef9eafa94ba67718e',  // PT - Apple-PubSub 65.19
'd25f04999693ba3952141a7ef4c10dc2',  // TH - Apple-PubSub 65.19
'74d290fabe4e2612bff76aeff9228dcd',  // ES - Apple-PubSub 65.19
'208d89f614e603099fedc836d297c16e',  // DK - Apple-PubSub 65.19
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
'38f04bbd00765a16fac050023827723c',  // BR - Apple-PubSub 65.11
'8b8a6e95efd7e75a32dee57182c77d53',  // IT - Apple-PubSub 65.11
'8808c9db1008304e0e77cdb45cd852c9',  // FR - Apple-PubSub 65.1.4
'2a24a50989d3d498054a46cb252e2f93',  // US - Apple-PubSub 65
'4426ccebdb8efd4884ad3c8b187bbbd0',  // FR - Apple-PubSub 65
'2aab3c9ff6725a0ee0e39691604f2a70',  // BR - Apple-PubSub 65
'b906752d12c59f44cc54f26e090a0c6d',  // FR - AppleSyndication
'456b14879e2280c76c1c949b805f821d',  // FR - AppleSyndication/56.1
'f25748fc2c3c617fba53199f337f7131',  // IT - AppleSyndication/56.1
'741a1e269a2ce4f51bf8f1520c9b288d',  // DE - AppleSyndication/56.1
'66c3e3add8b34e15cc1d48aea1b7919b',  // US - AppleSyndication/56.1
'6687a5f945ec7dcd34bb8cf5ec050baa',  // PT - AppleSyndication/56.1
'b214c600f9febae38b24a81608f1428a',  // ES - AppleSyndication/56.1
// Reeder
'2794356c8fa75873666f9eb796a252b7',  // Reeder/1.4 CFNetwork/485.12.7 Darwin/10.4.0
'c731f9328e05afdd157996f032288166',  // Reeder/2.3 CFNetwork/485.12.7 Darwin/10.4.0
);
return $known_fingerprints;
?>