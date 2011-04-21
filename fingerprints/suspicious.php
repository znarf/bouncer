<?php
$suspicious_fingerprints = array(
// Empty
'd41d8cd98f00b204e9800998ecf8427e',
// Near empty fingerprints
'd87a5617df45f58730aa2412008966e9', // Accept:*/*
'd4ad31d6bbd2b13d7e9683b23b1f6680', // Mozilla/5.0
'34cc6f29ce8920ec9cc8b983ff7b482d', // Mozilla/4.0
'8d4e52f445afc04479700fb94f606ea2', // Mozilla/5.0 - Accept:*/*
'd3c137acd8ada3e23b5d18a7773260ec', // Mozilla/4.0 - Accept:*/*
'0c6fa6c4c6aa8561509d62a0346908d9', // Mozilla 4.0 - Accept:*/*
'208b39e00387100e0dfde392d73736f6', // Mozilla/4.0 - Accept:*/* - deflate, gzip
'd28f73e67a253fb8503538b92ff5f33f', // Mozilla/3.0 (compatible)
'a55dbce033e47342f4493b6b8e317a11', // Accept-Encoding:identity
'b8a1d0f6c953cb9ff2dca95425cf4a67', // Mozilla/4.0 (compatible)
'9f4b085b10875940bce19a6c7c1b6ed4', // Mozilla/4.0 (compatible;) - Accept:*/*
'2a39dc7dfa441a5e059af1454e37215e', // Mozilla/4.0 (compatible;) - Accept:text/html, */* - Accept-Encoding:identity
'e261d653a34451b1db31d6613aace1f7', // Mozilla/5.0 (compatible)
'4331cc92d234b76eb0b5926b62ca28b9', // Mozilla/4.0 (compatible; Windows;) - Accept:*/*
'6dcd6a16db48630f077725a134f636fc', // Mozilla/4.0 - Accept-Language:en-us
'338ffbfe35cb0aecf3da2dcba64c89f0', // Mozilla/4.0 - Accept-Language:en-us - Accept:text/*,*/*
'e36cf8d82aaacacd2533bf7779f362bd', // Spider - Accept:*/*
'04ddfa686115af0c3306828f9572591b', // Accept:text/html
'8d0c98829565508d1da3fdaf38dedb2b', // Mozilla/5.0 - Accept-Encoding:gzip,deflate
'ebcb99603c2fc2706bb8d2098e4ceba1', // Mozilla/5.0 - Accept:*/* - Accept-Encoding:deflate, gzip
'ab22831f067a00592826609ce4453410', // Mozilla/4.0 - Accept:*/* - Accept-Encoding:gzip,deflate - Accept-Language:zh-cn, zh - Accept-Charset:GB2312,utf-8;q=0.7,*;q=0.7
'982301312ae692bbf1eab93007cd823f', // Mozilla/4.0 (compatible;) - Accept:*/*, */* - Accept-Language:nl,en,*
// Programming languages defaults
'd7c338fc5292ac8b15bacd0808ee1245', // Ruby
'e92acd969162f34aaac2099466e58464', // Ruby/1.8.7
'023beda1cb2cb7eea339c13a304b8d22', // Python-urllib/2.5
'db71ede31df67309d22fba536bb786ae', // Python-urllib/2.6
'790f947b2a7fe78890c8fa9a1ab50749', // PycURL/7.18.2
'0460db53bfafffc480d718d089c99908', // PycURL/7.19.5
'7501eb1d36df266c545527806e540e09', // The Incutio XML-RPC PHP Library
// Bots
'2c898764f97fa4c47459724a4125f5ff', // Mozilla/4.0 (compatible; RSS Reader)
'40fc775be2dcad9d6d0d798276a6177d', // Mozilla 5.0 (US - static.theplanet.com)
'd05580236d7563115237363dc740f983', // TREND MICRO
'8ec0b03883d2aa93b6de3ac919701912', // Quipply V1 RT
'c1ad0a278f5ce9abff581debb14273de', // UCANN2_CRAWLER
'4bc612ee1ba0b0fa110b0171b88acd2b', // FDM 3.x
// Security / Brand / Media bots
'1db826142acf332a4aadefe24c1c1bf4', // MacOS X 10.6.4 - Safari 5.0.1 (MediaDefender)
'448c515c192c8292a77b980803bec31d', // Windows 7 - Explorer 8.0 (brandprotect)
// Popular
'3dfed844dc126275d6d535bd0128a037', //  BM  - Windows XP    - Firefox 3.0.5
'9f2c5a729cf256ae7df689a153233397', //  BM  - Windows XP    - Firefox 3.0.10
'71769c0690c09ac31cc2bd7898a107a5', //  BM  - Windows XP    - Explorer 6.0
'95fb4f4df53accd38acbe819b75e36ec', //  BM  - Windows XP    - Firefox 2.0.0.11
'407fa0dab1fc4043e1dd5d197b5d3b7c', //  BM  - Windows 7     - Explorer 8.0
'4d12feadaaa0d2de366391b5f26d9723', //  BM  - Windows XP    - Explorer 6.0     (PERU)
'57b72e387d0933fe5633aea57423f26f', //   *  - Windows 98    - Explorer 6.0
'7b26ac3bd2948a47704fc69202858d9c', //  BM  - Windows XP    - Explorer 8.0
'12291b04e3b9f13e50446a069f7f617f', //  BM  - Windows XP    - Firefox 3.5.3
'59cab5f2ded9964a860dfa438c81a35c', //  BM  - Linux         - Firefox 3.0      (CN)
'a8d05109ce1452f434c41086c58763e3', //  BM  - Windows XP    - Explorer 6.0
'a83d11e2c4b78a31f922ac5e6535bd02', //  BM  - Windows XP    - Explorer 6.0     (CN - 61.135.162.*|61.135.169.*|61.135.190.*)
'c0166151e7c005b85564f16c63403223', //  BM  - Windows XP    - Explorer 6.0     (US - *.cust.propagation.net)
'e6742e43e21e965e69f31e5b3cd68fb3', //  BM  - Windows 2000  - Explorer 5.5
'99565980df77d3c44fcf13b7005e3099', //  BM  - Windows 2000  - Explorer 8.0     (US - 207.70.*)
'867b704a2a13789b9a3a750b4ed43bec', //   *  - Windows 2000  - Explorer 5.01
'7ec64413568c18029b11e0d69458b54f', //  BM  - Windows XP    - Explorer 7.0
'ae21b88a5f9d9e0f194d197bf3c1b16a', //  BM  - Unknown       - Firefox 3.0.5    (KR - 211.43.152.*)
'7b9e8b3e15f083ffd4003d6348a862b5', //  BM  - Windows XP    - Explorer 7.0     (FR - OVH)
'fd614978f3c2536172c5d9793aead2c1', //  BM  - Windows Vista - Explorer 7.0
'519e876fa6e446447a2a58181fb0b17c', //  BM  - Windows 7     - Explorer 8.0
'6f0e54a31a8f0d3d034a68992c84108f', //  BM  - Windows XP    - Firefox 3.0.6
'cd69d5dad03f5b309d4a7984a5ead486', //  BM  - Windows XP    - Explorer 7.0     (US - cubbsnet.com)
'464ad59abcf3e7adca9ccc8f09eee82b', //  BM  - Windows Vista - Firefox 3.0.1    (US - theplanet.com + DE - 82.140)
'1b058b4df8b81189043a99fe1049435e', //  BM  - Windows Vista - Firefox 3.0.1    (US - theplanet.com + DE - 82.140)
'485b4542bb733fe4474fa2a51681712a', //  BM  - Windows Vista - Explorer 7.0     (US - theplanet.com + DE - 82.140)
'54b2f182c6c9e764fbb75e40624f50f4', //  BM  - MacOS X       - Safari 3.0.2     (US - theplanet.com + DE - 82.140)
'3321732e13739fcdd7c727f11bf87623', //  BM  - MacOS X       - Safari 3.0.2     (US - theplanet.com + DE - 82.140)
'e51ea93b3fa9c835eaecf9541c59e58b', //  BM  - Ubuntu/9.25   - Firefox/3.8
// Explorer
'201b89a0f2a212c9f6b73dab58ab9db3',    //  *  - Windows XP    - Explorer 6.0     (Default IE - User Agent only)
'21f73ced1ec3fc21bd9d74eb037ec189',    //  *  - Windows XP    - Explorer 6.0     (US - yahoo.com)
'2a945eb820e0fb959e0eb42ebcae9c9f',    // LD  - Windows XP    - Explorer 8.0     (US - Vrtservers)
'c58abcb98a1260e3cb7de50b305b5cd1',    // BM  - Windows XP    - Explorer 6.0     (US - websitewelcome.com|hostgator.com)
'6b132ced76c43a575a702ac7917c2991',    // BM  - Windows XP    - Explorer 6.0     (TW - dynamic.hinet.net)
'3bf0133e96c47bc69333c04926ae855a',    // BM  - Windows XP    - Explorer 6.0     (TW - dynamic.hinet.net)
'938331c1534578621896d7be51bc4de3',    // BM  - Windows XP    - Explorer 7.0
'b7449fcac8672fb618b33bbfe477981a',    // BM  - Windows XP    - Explorer 7.0     (US - 24.39.1.*|nys.biz.rr.com)
'd15670bbecb02aa913a84504cd8d3616',    // BM  - Windows XP    - Explorer 6.0
'5a02b5cee84ff465518e063a71662b03',    // LD  - Windows 2000  - Explorer 5.01    (US - wp-signup.php)
'ed60634f7ee0c743a9a95961b87cc092',    // BM  - Windows XP    - Explorer 6.0     (CA - unassigned-XXX.164.14.72.net.blink.ca)
'16ab19e56f54f1efa86e5f7060b02c46',    // H6E - Windows XP    - Explorer 6.0
'22e59e278b28502334751892cff578bb',    // H6E - Windows XP    - Explorer 6.0     (CN)
'a4b3022d0d4ff28fad16fd845cb42cd4',    // BM  - Windows 98    - Explorer 5.5
'f72c352dbcdc69fb88972d00d71c9dfc',    // BM  - Windows XP    - Explorer 7.0
'c2b9e792f84679113f96096a30796afe',    // BM  - Windows XP    - Explorer 6.0
'e351339f31f2539989d4b0602ac13369',    // LD  - Windows XP    - Explorer 6.0     (UK)
'3b5bc629ffaf7c8b2f32a88b6bc17f40',    // BM  - Windows XP    - Explorer 7.0     (CN - xk-1-2-a8.bta.net.cn)
'8186edb76937779324d8b10c698844a0',    // BM  - Windows 2000  - Explorer 5.5
'894a16a61da0d1d61ffb219d78512f7c',    // BM  - Windows XP    - Explorer 7.0b   (Cookie2:$Version="1")
'b50cca9d908989cd453b12186d86c172',    // BM  - Windows XP    - Explorer 6.0
'9887c55fda215fd9fe03e9bab9d51839',    // BM  - Windows XP    - Explorer 6.0    (Cookie2:$Version="1")
'ab634d6c80c5623084a5d473b00edb01',    // BM  - Windows 2000  - Explorer 6.0    (SG)
'117b1b8071a055fe718af3514106618b',    // BM  - Windows 7     - Explorer 8.0    (US - amazonaws.com)
'16ee5bc3202e9b89691ae7444903345c',    // BM  - Windows 7     - Explorer 7.0
'b084a51c35d46608ad9362771584dee4',    // BM  - Windows 98    - Explorer 6.0
'ee0d0214224ecf467c7ebffe821c0b87',    // BM  - Windows 98    - Explorer 5.5
'af4007d2dba1445d17da5ec5fa36060e',    // BM  - Windows 2003  - Explorer 6.0
'2ce0b31b84400c36e225c9956aaf44ff',    // BM  - Windows 7     - Explorer 8.0
'd97a041302e88ecbd175e12eef58aa52',    // BM  - Windows XP    - Explorer 7.0
'0f60bb152cdf85950b4a3b07c8fa7ce9',    // BM  - Windows XP    - Explorer 8.0
'db0fd8380f835bf22c7d1be492b2c495',    // BM  - Windows XP    - Explorer 6.0
'215918d9c55686ac9e03690fd29b41d1',    // BM  - Windows XP    - Explorer 6.0
'8e697fdd503a58332e6c2d83fb68dbb4',    // BM  - Windows XP    - Explorer 6.0
'e9a534838bc9cfe4e62d9138e809fe34',    // LD  - Windows XP    - Explorer 6.0
'db53522067b6eb10190cef2c5423e506',    // BM  - Windows NT    - Explorer 5.5
'f4729cd0668887add1040b489565ffea',    // BM  - Windows XP    - Explorer 7.0
'a0ce16be2e2cec3a3d8a8d7bd75f997d',    // BM  - Windows NT    - Explorer 7.0
'29bbd4fb83ba06d25a22ba81951b11de',    // BM  - Windows XP    - Explorer 6.0
'9af86456abb3ec6e781c614083fe90a0',    // BM  - No Agent
// Firefox
'8310c5852ee8d17f39094a923bf537b8',    //  LD - MacOS X 10.5  - Firefox 3.6.3    (US - NatCoWeb Corp)
'4679192bb2f9d7a8a77c564a80f7dbd8',    //  LD - Windows Vista - Firefox 3.0.11   (US - comcastbusiness.net)
'93faf5eb2b3ef9321bb4269ba3f98940',    //  LD - Windows Vista - Firefox 3.5.3    (US - comcastbusiness.net)
'b64337e5058a34655a36e2c386e38b5a',    //  LD - Gentoo        - Firefox 3.5.6    (US - hostgator.com)
'6e0b261a641d3f6ad9c53f4f0bcff690',    //  LD - MacOS X       - Firefox 2.0.0.7  (US - amazonaws.com)
'2e4572613564df07f322e9d6411afd91',    //  BM - Windows XP    - Firefox 3.0.2    (CN - 110.75.169.*)
'e2bc467bfa309e5ec9e7db02d793c3f4',    //  BM - Windows XP    - Firefox 2.0.0.7  (US - theplanet.com)
'4833036355f39be011809cc013aeef78',    //  BM - Windows 7     - Firefox 3.6.8    (US)
'db8a6ab35b03950699e416f7ca192509',    //  BM - Windows Vista - Firefox 3.0.1    (US - theplanet.com)
'eb1ba78b8e255f14d22f976c403fdeca',    //  BM - Windows XP    - Firefox 1.5      (FR - EOLAS)
'dd481608e3b776fbcdaa3aa0e5300593',    //  BM - Windows XP    - Firefox 3.0.10
'a931efbf109f44739e7e5e8389559bf8',    //  BM - Ubuntu        - Firefox 3.8
'dbc083352c46b6675bac4f808bf91604',    //  BM - Linux i686    - Firefox 1.5.0.7  (Cookie2:$Version="1")
'5e59f3afcb8128b5e19d23c56a6f7eca',    //  BM - SuSE          - Firefox 2.0.0.2
'88543674fb7f5dd2b89843583883b522',    //  BM - Windows XP    - Firefox 1.0.6
'fb368ab6e982e18747cf240a7bf9ea70',    //  BM - Windows XP    - Firefox 3.0.10   (Cookie2:$Version="1")
'a450670526ac41f8280e1c8ec229ab7f',    //  BM - Windows XP    - Firefox 2.0.0.1
'036bedfc8b7bc46374f895c9673a2dca',    //  BM - Windows XP    - Firefox 3.0.7
'e589d8a655a5ba4f71f11128e6aeba8d',    //  BM - Windows 2003  - Firefox 3.0.6
'561440dbfdff525f24210ab3b34202db',    //  BM - Windows Vista - Firefox 3.0.8
'ed267132b191ab450717e155e558cb54',    //  BM - Windows XP    - Firefox 3.0.10
'1c784cefba12a813271b02cbd28e8e01',    //  BM - Ubuntu        - Firefox 3.0.10
'3a17ee0aa964b2fa5e1b074634906ded',    //  BM - Windows XP    - Firefox 3.6.8
'98a1c8b514f2c9a80b7fbb989a3d831e',    //  BM - Windows XP    - Firefox 3.0.4
'e9865916118c88b06343747baca52250',    //  BM - MacOS X 10.5  - Firefox 3.6.3
'e98b2e22977e0e8532d16e7379989a65',    //  BM - Windows 7     - Firefox 3.5.3
'88bb897e01d35d13a751f6341122022f',    //  BM - Windows XP    - Firefox 3.5.2    (> 1000 hosts)
'a1129a8148c232076fb22355ae978f1d',    //  BM - Windows XP    - Firefox 3.6.8    (CN - 110.75.*.*)
'648b3d0bacbd3ac92fc18b8db3733fdb',    //  BM - Windows XP    - Firefox 3.5.3
'6a542ee4f1b4c69d236964ff34b4062f',    //  BM - Windows 7     - Firefox 3.5.3
'b75dece5437610be31a13d2091765f4a',    //  BM - Windows XP    - Firefox 3.0.14
'e2f0fdf998e66e90cf77aad56d518b25',    //  BM - Ubuntu Linux  - Firefox 3.5.6
'6eaae0609f44edabbc8bb51e59ec1e90',    //  BM - Windows 2003  - Firefox 3.0.6
'3eba1a9bd9518f83b6739c122586f8f1',    //  BM - Windows XP    - Firefox 1.5      (EGYPT)
'7d046900370014646c98ae2f4c439f98',    //  BM - Windows 7     - Firefox 3.6.12   (squidproxies.com)
'c31245fb9c7ae1bda265fb110f64f5e5',    //  BM - Windows 2000  - Firefox 3.5.8
'a1f1d332025979db7ea517f4d51a07bc',    //  BM - Windows XP    - Firefox 3.0.1    (US - theplanet.com)
'0e8ac149f40d409683b80470ecce4225',    //  BM - Windows Vista - Firefox 3.5.7    (JP)
'f82f849c1705c8850c75f3753c1131fc',    //  BM - Windows Vista - Firefox 3.6.11
// Chrome
'41a9eef3b03840b0010e98edeba739d2',    //  BM - Windows XP    - Chrome 0.2.149.27
'e9d4fade18f51767545e142eb4b6de5e',    //  BM - Windows XP    - Chrome 2.0.172.28
'f6f9ffca44cc504c999a537c7483ea70',    //  BM - Linux         - Chrome 5.0.307.7
// Various
'0b7496c8208ce55d66d79cbabdca71ff',    //  BM - Opera Mini 2.0.4719
'b59e6ad8917389de9fc4ac545affa31c',    //  BM - MacOS PPC     - Netscape 4.7     (RU)
'6ee31a0f6b63c451af5a393eae58ee98',    //  BM - Windows XP    - Netscape 7.2
'8bc18a42e16e1948417d403c2507b5ce',    //  BM - Windows Vista - Opera 9.64       (Cookie2:$Version="1")
'c08f1df2c2936d8f931c07ef495ad3c4',    //  BM - Windows 98    - MSN Explorer 2.5
'6046298b97a8fa9cab264f472979790f',    //  BM - Linux i686    - Epiphany 2.14
'740876e7892358828a368929b64f314d',    //  BM - Linux Debian  - Mozilla 1.8.0.5-3
'4483e1104a5c9d42f526f0ff0798898a',    //  BM - Windows XP    - Opera 9.60
'9d88f6206f5191eeb591ac4b2c90911f',    //  BM - Mozilla/5.0 (compatible; MSIE 6.0; ) Gecko (US - 65.36.241)
'8524ec628d095062da5c063a8bbf5405',    //  BM - MacOS X 10.6.4 - Safari 5.0.1
'a0847fb857a6c7bd4a630a3501d4e5fa',    //  BM - Mozilla/5.0 (compatible; OpenWeb 5.7.4-09)
// BM - inferno.name
'a19471cdfd5262b77d9c2edb6ebc1510', // Windows 2003 - Opera 7.60
'b6a988533111b50e812790f44de838aa', // Windows XP   - Explorer 6.0
'c7345ab14c9c39e36737b503b6f11239', // Windows 2000 - Explorer 5.5
'1f5e448c64308bf6732cc9d2df4eb538', // Windows XP   - Explorer 7.0
'9da99f80922dc5c710dbc8602ea9ce83', // Windows 2003 - Explorer 6.0
'870660ecfc39667a3fd987a147c51170', // Windows 2000 - Explorer 5.5
'19b8d1b99b6dd00dbcb4251b013969d5', // Windows XP   - Explorer 6.0
'7ae7fbc9e52c64fd2fb5883381bce8a9', // Windows      - BrowseX 2.0.0
// BM - zh-cn
// Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)
'026c8cf2970607f6c96af64ab56d04a7', // (IMAGE), (SHOCKWAVE), (EXCEL-POWERPOINT-WORD), */*
'5dabbb1c536b58d7a6bb234fcdaa71bd', // (IMAGE), (SHOCKWAVE), (WORD-EXCEL-POWERPOINT), */*`
'09bdb6e078f595fcabce84998fe79937', // (IMAGE), (SHOCKWAVE), (EXCEL-WORD), */*
'7af33aa6587b0842bbbbbf004e6119e8', // (IMAGE), (SHOCKWAVE), (WORD), */*
'596d5af304c3d0e12cb62fb8bb6e4c4e', // (IMAGE), (SHOCKWAVE), (EXCEL-POWERPOINT-WORD), application/QVOD, application/QVOD, */*
'59af10c63722a89e9b60a66d2699e923', // (IMAGE), (SHOCKWAVE), (EXCEL-POWERPOINT-WORD), (SILVERLIGHT), application/QVOD, application/QVOD, */*
'66174ec5746225e33e8f74764dd885ad', // (SHOCKWAVE), (IMAGE), (EXCEL-POWERPOINT-WORD), application/QVOD, application/QVOD, */*
'942b04de06c753de6cf9769d2ec8d7e9', // (IMAGE), (SHOCKWAVE), (WORD-EXCEL-POWERPOINT), application/QVOD, application/QVOD, */*
'0f8d23baea1ccbdef05ebfe6ebd54c3b', // (SHOCKWAVE), (IMAGE), (EXCEL-POWERPOINT-WORD), */*
'eca27dd804d8e5e7cc9d7a0d066dde75', // (SHOCKWAVE), (IMAGE), (WORD-EXCEL-POWERPOINT), */*
'0c0e1983235b857a7a60791c4d972126', // (SHOCKWAVE), (IMAGE), (WORD), */*
'e5a8a17b5747b0407b31c7279d0cb7ff', // (IMAGE), (SHOCKWAVE), */*
'212e3663f2db25278a9c6f6fe9ea064f', // (IMAGE), (SHOCKWAVE), (EXCEL-POWERPOINT-WORD), (SILVERLIGHT), */*
// Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)
'94f4688c821da35bf6e3246f3c53eaee', // (IMAGE), (SHOCKWAVE), (EXCEL-POWERPOINT-WORD), */*
// Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; 360SE)
'edac95c3e40d567074e7725ffc9ecef0', // (IMAGE), (SHOCKWAVE), (EXCEL-POWERPOINT-WORD), */*
'a9a45b69b9ee66dd7ca4c9594f392c7d', // (IMAGE), (SHOCKWAVE), (WORD-EXCEL-POWERPOINT), */*
'39910cd50e37317faa23c829627aaf95', // (SHOCKWAVE), (IMAGE), (EXCEL-POWERPOINT-WORD), */*
// Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0)
'0341a77de94437c77a8a1813bae88224',
// Web Sniffer
'3098ff1030d58eb6db388a85cdb63e75',    //  BM - Windows XP    - Explorer 7.0     (US - referer:http://web-sniffer.net/)
);
return $suspicious_fingerprints;
?>