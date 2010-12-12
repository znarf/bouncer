<?php
$banned_fingerprints = array(
// Most Popular
'cd3ea020baf312a8dc8e12e8ecd524ab',
// Browsers
'800debb6bf463b5c72336a2ab6c76176', // JP - Windows XP   - Explorer 6.0   (.asianetcom.net),
'd4a3108acff0dd17752192df5d175333', // KR - MacOS X 10.5 - Firefox 3.0.6
// Forum Spam
// Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US)
'd7a9c865d751ab1f54216b99c3233f4e', // Accept-Encoding:none
'26266e23a1e673220591d891f2aa2b5f', // Accept-Encoding:gzip
'a7f6ebb46b5f7a3d6618ac0caed7eb83', // Accept-Encoding:gzip,deflate
'b4bc915a34ea449382e1d1d849864cf4', // Accept-Encoding:identity,gzip,deflate
// Comment Spam
'd72e329d83dbc23e65b7d8412dbe31b8', //  *  - Windows XP    - Explorer 6.0
'00e9cd8e4ffc0d2d5ab8236bc062773b', //  *  - Windows XP    - Explorer 6.0
'14ae981d20516d71505ed67a4564c7d5', //  CN - Windows XP    - Explorer 6.0
'863791545df8ec86ddda02d961fb332c', //  US - Windows XP    - Explorer 6.0
'476f7382c6de03533d1d84302a3c16d6', //  PL - Windows 7     - Explorer 7.0
'36b92335e826e9c7a6e615fa34073a86', //  US - Windows XP    - Firefox 2.0.0.6
'd87616417f6659d290c46a9e246d54f8', //  *  - Windows XP    - Firefox 3.6
// BM Spam
'2d427eaca8980ae196a9c003780057c8', //  *  - Windows 2000  - Explorer 6.0
// Bots
'6135b0ff46c9c6168ef13c221f3528b5', // SN - DTS Agent
'dcf57bea9a755eea1f8de282f4c3279a', // CN - Indy Library
'61dc815933fe47026e1cdf0f5dc7ffbc', // CN - Indy Library
'ea61161ef904102c26654f77fbc1af27', //  * - larbin 2.6.3
'e001df5efb3b7e2392430eea763ef765', //  * - binlar 2.6.3
'c3519edceadd1945fdeb626ad9c2a5fe', //  * - larbin 2.6.3
'1eee5009bfa152ad21b863af9cb134c6', //  * - page_test - larbin 2.6.3
'ed6a32ee2c78863ad5a1f007a95ae420', //  * - larbin 2.6.3
'ab37081000071ae3ced2a659889930c3', //  * - larbin 2.6.3
'41690152a7d0c8c259a8854cc72b65f5', //  * - AutoHotkey
// ICS
'4c67cac030adba659c1ad691368db27e',
// Security Exploits
'1145d630273e73472fb728301b95b362', //  * - dex Bot Search
'bd3ddc784afb3d4c98278e86cd2e38a8', // RU - Casper Bot Search
'f6c56d66353ed1d75d9d6510e665afef', //  * - plaNETWORK Bot Search
'b0f23770497882623698007998676f4c', //  * - MaMa CaSpEr
'5d5185a11ffe776821edd761a57f87ad', //  * - SunOS 5.7 - Netscape 4.76
'84b22310b79b5acf19637583f88e56a5', //  * - kmccrew Bot Search
'56cb5aa3bc50560382d31c887cde3696', //  * - MaMa CyBer
// Fake Google
'a8c59cca16eb7d753659ae07aa6745bb',
'834f20c97f18fc1fa04ddd63f11ec2e8',
'b1c0361564c267d2786dd731a346af77',
'b56beeee346852e3f2928964b2eb97c7',
'704e985ee38d27eb605fe94507f854a1',
'f94e6a904f7d6a185755e6bf7d144129',
'bd071fdfb2a7ad087cca666b86a23b9c',
'f94e6a904f7d6a185755e6bf7d144129',
'f82fb91416713cbf302217d272f18c6f',
'8ea3fb6a8c5cc988ceb18877e9d0f698',
'cf7496791c144f929120f056fc42d834',
'b50457ec8e01d50f1d6c9aa1f358ab32',
// Advanced Email Extractor
'a71a3073b82c5f249cacdae80c0e154e', // 2.61
'f739bf1bfb67daadf0cc3462dfc5dc59', // 2.76
// Lib WWW
'4380852845d037820bfd4e0b9ea4e555', // libWWW 5.64
'fb01926b55f6a61d0d619dca6a6e905b', // libWWW 5.65
'dd2cce743b64f2b797fa3bba306f387a', // libWWW 5.76
'c67c0196c4ad44c35b1f2f3160a96fcd', // libWWW 5.79
'f706d25efc54ba36bbc61a288612071e', // libWWW 5.800
'020801d2d515f2fa3a50d70dd8f846be', // libWWW 5.808
'2a50b1f21abfc30c5b6494d19e672866', // libWWW 5.803
'6ca73eacc292a19896f58dd5b17b6652', // libWWW 5.805
'1d38e98da2e7509bb37d14989560800f', // libWWW 5.810
'a029b4d65c51fcd4d67551c0ae97f529', // libWWW 5.811
'95dde41a36a4c266b9bc520a9d4a8f1f', // libWWW 5.812
'bfe5caacf3af775ccc94e927a5737372', // libWWW 5.813
'e917d52c6b22468b1db1b27bfa4062b4', // libWWW 5.814
'9405658d078823e6df4c8429ea72be46', // libWWW 5.816
'5654842294d6f200197b6f4d73f39743', // libWWW 5.819
'7bd5d06c1c4905e13a94c5dffcb3d55f', // libWWW 5.820
'46b9d16c1ebc9cb234f8d47929ff9390', // libWWW 5.822
'da24c0264d4d16452c89d130d981eaed', // libWWW 5.823
'49a2baabfc2a9ed50086f75b4dda5a0b', // libWWW 5.825
'07c84c7364627aa6477de824d6faf06d', // libWWW 5.826
'f93f7902bf8d9dfee536e5c8c29e8fc0', // libWWW 5.827
'c5e51aa28d70b9c5ed76d2c48f3a2e6e', // libWWW 5.829
'6df364481412ce3c51b624f39d68dae5', // libWWW 5.830
'63fe534afc8cfc5afb0c90c40619dafa', // libWWW 5.831
'0b4741579b71d0108e950fbd0aee0cf4', // libWWW 5.832
'ca6b56b9244a2201fedad435c76333c2', // libWWW 5.833
'953a6b376f8c3cf19d6a99cd52f933bc', // libWWW 5.834
'10cabc19da6511f5655f29c4aa871d85', // libWWW 5.836
'4c075896ef53d0ed43f0a73606e4bb99', // libWWW 5.837
// Java (text/html, image/gif, image/jpeg, *; q=.2, */*; q=.2)
'513b66a05ab4f042df726ddf252287ad', // Java/1.4.1_01
'013c9e2e72d01a71528ea3e5828287f0', // Java/1.4.1_04
'e89cb5d761fd739e0ce7a50e78c7fe48', // Java/1.4.2_07
'9bb1516b745d69e208c52aeb1eb86550', // Java/1.5.0
'b9d80793083ab72eecb293c49a4e97be', // Java/1.5.0_04
'78d335088097bc4a390e84f287230480', // Java/1.5.0_05
'0d360766d1b65022c2fad9a8e1017a3b', // Java/1.5.0_08
'c7619398ca9cc62676bc22470b30e292', // Java/1.5.0_09
'935ddbfef63f064602c28059b71e4f48', // Java/1.5.0_11
'5303f135ebdd3e4a13e2c018681db268', // Java/1.5.0_12
'c06ed801086df06f47d2e59a72475b50', // Java/1.5.0_15
'589908d6348c10b42e0ec53f35a6b7e0', // Java/1.5.0_17
'fa1d0fa9804e415239b734d215563a0d', // Java/1.6.0-rc
'07bebae5fabaf4fe78686e0333bda69b', // Java/1.6.0
'ecc03938cc08478c23e6fe702ae7b715', // Java/1.6.0_0
'84b593f1747616af0c09232b7f7435e8', // Java/1.6.0_02
'dcf79fc274f3da000292130426613878', // Java/1.6.0_04
'c100a6673ba6f6bc15df8ac130939659', // Java/1.6.0_05
'917375f84c04b9515fee277caa61a1c9', // Java/1.6.0_06
'5aa8fd37461acc8b03fd6c1c59f45671', // Java/1.6.0_07
'9832958bd7e3208b73dda84c05055e1f', // Java/1.6.0_10
'7611f5198af4e6cb85ea0edaa1144c31', // Java/1.6.0_11
'f53bff6acc2e26e7b78da6831eb467f0', // Java/1.6.0_12
'2a528f5db7431cd4e2904a3a16ad6806', // Java/1.6.0_13
'aa8ba6fd98fd9085ec08ede5cd67b941', // Java/1.6.0_14
'29c425f154b362acd18fdd54d58cd82c', // Java/1.6.0_15
'28a71f390ac85707e2f71fda43de578a', // Java/1.6.0_16
'5416d4958dd6569e17f2269de5f64f46', // Java/1.6.0_17
'b1844cc5196d7f0642a7f390e2d028f7', // Java/1.6.0_18
'4616e11d99bdf4cdf877be2b67cb61c2', // Java/1.6.0_19
'cd0e52f56c70ca6b149c9d41af4f698b', // Java/1.6.0_20
'7b8a8409e605ab281c8efc7c4366fd02', // Java/1.6.0_21
'19bce80c4af0e5cae656fff133f7902a', // Java/1.6.0_22
'615f3cb1f1a256d34e0c99cd389bb784', // Java/1.7.0-ea
// Various
'69c914f8638b73983cc50aaad91257f1', // Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
);
return $banned_fingerprints;
?>