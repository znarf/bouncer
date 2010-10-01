<?php
/*This file is part of BBClone (The PHP web counter on steroids)
 *
 * $Header: /srv/cvs/bbclone/bbclone/lib/robot.php,v 1.259 2009/10/26 05:57:56 prad Exp $
 *
 * Copyright (C) 2001-2009, the BBClone Team (see file doc/authors.txt
 * distributed with this library)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * See doc/copying.txt for details
 */

// Missing:
// 128.255.xx.xx - - [08/Feb/2004:16:38:00 +0100] "GET /robots.txt HTTP/1.0" 200 280 "-" "Generic"
// 128.107.xx.xx - - [21/Feb/2004:06:56:11 +0100] "GET /robots.txt HTTP/1.0" 200 280 "-" "CE-Preload"

$robot = array(
  "1noon" => array(
    "icon" => "1noon",
    "title" => "1noon",
    "rule" => array(
      "1Noonbot[/ ]([0-9.]{1,10})" => "\\1",
      "^Yeti$" => ""
    )
  ),
  "123spider" => array(
    "icon" => "robot",
    "title" => "123Spider",
    "rule" => array(
      "123spider-Bot \(Version: ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.123spider.de/"
  ),
  "192com" => array(
    "icon" => "robot",
    "title" => "192.com",
    "rule" => array(
      "192.comAgent" => ""
    ),
    "uri" => "http://www.192.com/"
  ),
  "2dehands" => array(
    "icon" => "2dehands",
    "title" => "2deHands",
    "rule" => array(
      "2dehands\.nl" => ""
    )
  ),
  "80legs" => array(
    "icon" => "80legs",
    "title" => "80legs",
    "rule" => array(
      "008[/ ]([0-9.]{1,10}).*80legs" => "\\1"
    ),
    "uri" => "http://www.80legs.com/"
  ),
  "a1sitemap" => array(
    "icon" => "a1sitemap",
    "title" => "A1 Sitemap",
    "rule" => array(
      "^A1 Sitemap Generator[ /]([0-9.]{1,10})" => "\\1",
      "miggibot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.micro-sys.dk/products/sitemap-generator/"
  ),
  "a2b" => array(
    "icon" => "a2b",
    "title" => "A2B",
    "rule" => array(
      "www\.a2b\.cc" => ""
    ),
    "uri" => "http://www.a2b.cc"
  ),
  "abacho" => array(
    "icon" => "robot",
    "title" => "Abacho",
    "rule" => array(
      "^ABACHOBot" => ""
    )
  ),
  "abcdatos" => array(
    "icon" => "abcdatos",
    "title" => "ABCdatos",
    "rule" => array(
      "^ABCdatos BotLink[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.abcdatos.com/"
  ),
  "abot" => array(
    "icon" => "abot",
    "title" => "aBot",
    "rule" => array(
      "^abot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "about" => array(
    "icon" => "about",
    "title" => "About",
    "rule" => array(
      "Libby[_/ ]([0-9.]{1,10})" => "\\1",
      "About[_/ ]([0-9.]{1,10})libwww-perl" => "\\1"
    )
  ),
  "aboutus" => array(
    "icon" => "aboutus",
    "title" => "AboutUs",
    "rule" => array(
      "^AboutUsBot" => ""
    ),
    "uri" => "http://www.aboutus.org/"
  ),
  "ackerm" => array(
    "icon" => "robot",
    "title" => "Ackerm",
    "rule" => array(
      "www.ackerm.com" => ""
    ),
    "uri" => "http://www.ackerm.com/"
  ),
  "acoi" => array(
    "icon" => "acoi",
    "title" => "AcoiRobot",
    "rule" => array(
      "^AcoiRobot" => ""
    ),
    "uri" => "http://monetdb.cwi.nl/acoi/projects.html"
  ),
  "acoon" => array(
    "icon" => "acoon",
    "title" => "Acoon",
    "rule" => array(
      "Acoon[ \-]?Robot" => ""
    )
  ),
  "accoona" => array(
    "icon" => "accoona",
    "title" => "Accoona",
    "rule" => array(
      "Accoona-AI-Agent[/ ]([0-9.]{1,10})" => "\\1",
      "^accoona" => ""
    )
  ),
  "acme" => array(
    "icon" => "acme",
    "title" => "Acme",
    "rule" => array(
      "^Acme\.Spider" => ""
    ),
    "uri" => "http://www.acme.com/java/software/Acme.Spider.html"
  ),
  "active" => array(
    "icon" => "robot",
    "title" => "ActiveBookmark",
    "rule" => array(
      "ActiveBookmark[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "admuncher" => array(
    "icon" => "robot",
    "title" => "Ad Muncher",
    "rule" => array(
      "Ad Muncher[/ v]*([0-9.]{1,10})" => "\\1"
    )
  ),
  "aesop" => array(
    "icon" => "robot",
    "title" => "Aesop",
    "rule" => array(
      "^AESOP_com_SpiderMan" => ""
    ),
    "uri" => "http://www.aesop.com"
  ),
  "agada" => array(
    "icon" => "robot",
    "title" => "Agada",
    "rule" => array(
      "^agadine[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "aibot" => array(
    "icon" => "robot",
    "title" => "Aibot",
    "rule" => array(
      "AIBOT[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "aipbot" => array(
    "icon" => "robot",
    "title" => "Aipbot",
    "rule" => array(
      "aipbot[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "aleksika" => array(
    "icon" => "aleksika",
    "title" => "Aleksika",
    "rule" => array(
      "Aleksika Spider[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "alertsite" => array(
    "icon" => "alertsite",
    "title" => "AlertSite",
    "rule" => array(
      "ipd[ /]([0-9.]{1,10}).*Alertsite\.com" => "\\1"
    ),
    "uri" => "http://www.alertsite.com/index.html"
  ),
  "alexa" => array(
    "icon" => "alexa",
    "title" => "Alexa",
    "rule" => array(
      "^ia_archive" => ""
    )
  ),
  "almaden" => array(
    "icon" => "almaden",
    "title" => "IBM Crawler",
    "rule" => array(
      "www\.almaden\.ibm\.com/cs/crawler" => ""
    )
  ),
  "altavista" => array(
    "icon" => "altavista",
    "title" => "Altavista",
    "rule" => array(
      "Scooter[ /\-]*[a-z]*([0-9.]{1,10})" => "\\1",
      "AltaVista V([0-9.]{1,10})" => "\\1",
      "AltaVista Intranet V([0-9.]{1,10})" => "\\1"
    )
  ),
  "amazon" => array(
    "icon" => "amazon",
    "title" => "Amazon",
    "rule" => array(
      "^(aranhabot|amzn_assoc)" => "",
      "^NutchEC2Test" => ""
    ),
    "uri" => "http://www.amazon.com/"
  ),
  "amidalla" => array(
    "icon" => "amidalla",
    "title" => "Amidalla",
    "rule" => array(
      "^amibot" => ""
    )
  ),
  "amfibi" => array(
    "icon" => "amfibi",
    "title" => "Amfibi",
    "rule" => array(
      "Amfibibot[/ ]([0-9.]{1,10})" => "\\1",
      "Amfibibot" => ""
    )
  ),
  "amphetadesk" => array(
    "icon" => "robot",
    "title" => "AmphetaDesk",
    "rule" => array(
      "AmphetaDesk[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "amphetameme" => array(
    "icon" => "robot",
    "title" => "Amphetameme",
    "rule" => array(
      "amphetameme[ \-]?crawler" => ""
    )
  ),
  "annomille" => array(
    "icon" => "robot",
    "title" => "AnnoMille",
    "rule" => array(
      "^AnnoMille( spider)?[/ ]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.annomille.it"
  ),
  "ansearch" => array(
    "icon" => "robot",
    "title" => "Ansearch",
    "rule" => array(
      "AnsearchBot[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "answerchase" => array(
    "icon" => "answerchase",
    "title" => "AnswerChase",
    "rule" => array(
      "AnswerChase( PROve)?[/ ]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.answerchase.com/"
  ),
  "antibot" => array(
    "icon" => "robot",
    "title" => "antibot",
    "rule" => array(
      "antibot-V([0-9.]{1,10})" => "\\1"
    )
  ),
  "aonde" => array(
    "icon" => "aonde",
    "title" => "Aonde",
    "rule" => array(
      "^AONDE-Spider" => ""
    )
  ),
  "aonline" => array(
    "icon" => "robot",
    "title" => "A-Online.at",
    "rule" => array(
      "^A-Online Search" => ""
    ),
    "uri" => "http://www.a-online.at/"
  ),
  "aol" => array(
    "icon" => "aol",
    "title" => "AOLserver",
    "rule" => array(
      "^AOLserver-Tcl[/ ]([0-9.]{1,10})" => "\\1",
      "^AOLserver" => ""
    )
  ),
  "apachebench" => array(
    "icon" => "robot",
    "title" => "ApacheBench",
    "rule" => array(
      "ApacheBench[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "apassion4jazz" => array(
    "icon" => "robot",
    "title" => "Passion 4 Jazz",
    "rule" => array(
      "^BebopBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.apassion4jazz.net/bebopbot.html"
  ),
  "apexoo" => array(
    "icon" => "robot",
    "title" => "Apexoo",
    "rule" => array(
      "^Apexoo Spider ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.apexoo.com/"
  ),
  "apnoti" => array(
    "icon" => "apnoti",
    "title" => "apnoti",
    "rule" => array(
      "apnoti.*Robot[ /]v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.apnoti.com/"
  ),
  "aport" => array(
    "icon" => "aport",
    "title" => "Aport",
    "rule" => array(
      "^Aport" => ""
    )
  ),
  "appie" => array(
    "icon" => "walhello",
    "title" => "Walhello",
    "rule" => array(
      "appie[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "arachmo" => array(
    "icon" => "arachmo",
    "title" => "Arachmo",
    "rule" => array(
      "compatible; Arachmo" => ""
    )
  ),
  "arexera" => array(
    "icon" => "arexera",
    "title" => "Arexera",
    "rule" => array(
      "^X-Crawler" => "",
      "^TECOMAC-Crawler[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.arexera.de/"
  ),
  "arianna" => array(
    "icon" => "arianna",
    "title" => "Arianna",
    "rule" => array(
      "^www.arianna.it" => ""
    ), "uri" => "http://www.arianna.it/"
  ),
  "artface" => array(
    "icon" => "robot",
    "title" => "Artface",
    "rule" => array(
      "^ArtfaceBot" => ""
    )
  ),
  "artviper" => array(
    "icon" => "artviper",
    "title" => "artViper",
    "rule" => array(
      "artViper" => ""
    ), "uri" => "http://www.artviper.net/"
  ),
  "asinfo" => array(
    "icon" => "robot",
    "title" => "Any Search Info",
    "rule" => array(
      "Sleek Spider[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://search-info.com/"
  ),
  "ask" => array(
    "icon" => "askjeeves",
    "title" => "Ask Jeeves",
    "rule" => array(
      "Ask[ \-]?Jeeves" => "",
      "teomaagent" => ""
    )
  ),
  "askaboutoil" => array(
    "icon" => "robot",
    "title" => "ASPseek",
    "rule" => array(
      "^AskAboutOil[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://askaboutoil.com/"
  ),
  "asked" => array(
    "icon" => "robot",
    "title" => "askEd!",
    "rule" => array(
      "^asked[ /]Nutch[ \-]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://asked.jp"
  ),
  "aspseek" => array(
    "icon" => "robot",
    "title" => "ASPseek",
    "rule" => array(
      "^ASPseek[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "atlocal" => array(
    "icon" => "robot",
    "title" => "At Local",
    "rule" => array(
      "AtlocalBot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.atlocal.com/"
  ),
  "atomz" => array(
    "icon" => "atomz",
    "title" => "Atomz",
    "rule" => array(
      "Atomz[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "axel" => array(
    "icon" => "robot",
    "title" => "Axel",
    "rule" => array(
      "^axel" => ""
    )
  ),
  "axmo" => array(
    "icon" => "axmo",
    "title" => "Axmo",
    "rule" => array(
      "AxmoRobot" => ""
    )
  ),
  "answerbus" => array(
    "icon" => "answerbus",
    "title" => "AnswerBus",
    "rule" => array(
      "answerbus" => ""
    )
  ),
  "automapit" => array(
    "icon" => "robot",
    "title" => "AutoMapIt",
    "rule" => array(
      "AutoMapIt[ /](Bot)?" => ""
    ),
    "uri" => "http://www.automapit.com/bot.html"
  ),
  "augurnfind" => array(
    "icon" => "robot",
    "title" => "Augurnfind",
    "rule" => array(
      "augurnfind[/ ][v\-]*([0-9.]{1,10})" => "\\1"
    )
  ),
  "awasu" => array(
    "icon" => "awasu",
    "title" => "Awasu",
    "rule" => array(
      "Awasu[/ ]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "babe" => array(
    "icon" => "robot",
    "title" => "ba.be",
    "rule" => array(
      "BACS http://www.ba.be" => ""
    ),
    "uri" => "http://www.ba.be/"
  ),
  "baidu" => array(
    "icon" => "baidu",
    "title" => "Baidu",
    "rule" => array(
      "Baiduspider" => "",
      "BaiduImagespider" => "",
      "baidu Transcoder" => "",
      "BaiduMobaider[/ ]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "bananatree" => array(
    "icon" => "robot",
    "title" => "BananaTree",
    "rule" => array(
      "www\.thebananatree\.org" => ""
    )
  ),
  "bdcindexer" => array(
    "icon" => "robot",
    "title" => "bdcindexer",
    "rule" => array(
      "bdcindexer_([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.business.com/"
  ),
  "bdfetch" => array(
    "icon" => "robot",
    "title" => "BDFetch",
    "rule" => array(
      "^BDFetch" => ""
    ),
    "uri" => ""
  ),
  "bdbrandprotect" => array(
    "icon" => "robot",
    "title" => "Brand Protect",
    "rule" => array(
      "^BP Spider[ /]([0-9.]{1,10})" => ""
    ),
    "uri" => ""
  ),
  "bdncentral" => array(
    "icon" => "robot",
    "title" => "Bdncentral",
    "rule" => array(
      "BDNcentral Crawler v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.bdncentral.com/robot.html"
  ),
  "beammachine" => array(
    "icon" => "robot",
    "title" => "BeamMachine",
    "rule" => array(
      "^BeamMachine[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.beammachine.net/"
  ),
  "become" => array(
    "icon" => "become",
    "title" => "Become",
    "rule" => array(
      "Become(JP)?Bot[/ ]([0-9.]{1,10})" => "\\2",
      "(BecomeBot|Exabot)@exava\.com\)$" => ""
    ),
    "uri" => "http://www.become.com/"
  ),
  "beebware" => array(
    "icon" => "robot",
    "title" => "Beebware",
    "rule" => array(
      "BeebwareDirectory[/ ]v?([0-9.]{1,10})" => "\\2"
    ),
    "uri" => ""
  ),
  "bigbrother" => array(
    "icon" => "robot",
    "title" => "Big Brother",
    "rule" => array(
      "^Big Brother" => ""
    ),
    "uri" => "http://pauillac.inria.fr/~fpottier/"
  ),
  "bigclique" => array(
    "icon" => "robot",
    "title" => "BigClique",
    "rule" => array(
      "^BigCliqueBOT[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.bigclique.com"
  ),
  "biglotron" => array(
    "icon" => "robot",
    "title" => "Biglotron",
    "rule" => array(
      "^BIGLOTRON" => ""
    ),
    "uri" => "http://www.bigclique.com"
  ),
  "bigsearch" => array(
    "icon" => "bigsearch",
    "title" => "Bigsearch",
    "rule" => array(
      "Bigsearch.ca[/ ]Nutch[- ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "bilbo" => array(
    "icon" => "robot",
    "title" => "Bilbo",
    "rule" => array(
      "Bilbo[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://home.broadpark.no/~tnilsen-1/Linux/Bilbo_-_Nessus_WEB/bilbo_-_nessus_web.html"
  ),
  "bilgi" => array(
    "icon" => "bilgi",
    "title" => "Bilgi",
    "rule" => array(
      "Bilgi(Beta)?Bot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.bilgi.com/"
  ),
  "bitacle" => array(
    "icon" => "bitacle",
    "title" => "Bitacle",
    "rule" => array(
      "Bitacle (ro)?bot[ \(/V\:]+([0-9.]{1,10})" => "\\2",
    ),
    "uri" => "http://bitacle.org/"
  ),
  "bitbeamer" => array(
    "icon" => "bitbeamer",
    "title" => "BitBeamer",
    "rule" => array(
      "BitBeamer/([0-9.]{1,10})" => "\\1"
    )
  ),
  "bixolabs" => array(
    "icon" => "robot",
    "title" => "Bixolabs",
    "rule" => array(
      "bixolabs/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://bixolabs.com/crawler/general/"
  ),
  "biz360" => array(
    "icon" => "biz360",
    "title" => "Biz360",
    "rule" => array(
      "^Biz360 spider" => "\\1"
    )
  ),
  "blaizbee" => array(
    "icon" => "blaiz-bee",
    "title" => "Blaiz-Bee",
    "rule" => array(
      "Blaiz-Bee[ /]([0-9.]{1,10})" => ""
    )
  ),
  "blogbotde" => array(
    "icon" => "robot",
    "title" => "blogbot.de",
    "rule" => array(
      "Naamah[ /]([0-9.a-z]{1,10})[ /]Blogbot" => "\\1",
    ),
    "uri" => "http://blogbot.de/"
  ),
  "blogcensus" => array(
    "icon" => "blogcensus",
    "title" => "Blogcensus",
    "rule" => array(
      "^Blogcensus" => "\\1",
    ),
    "uri" => "http://blogcensus.de/bot/"
  ),
  "blogdex" => array(
    "icon" => "robot",
    "title" => "Blogdex",
    "rule" => array(
      "Blogdex[ /]([0-9.]{1,10})" => "\\1",
    )
  ),
  "blogg" => array(
    "icon" => "blogg",
    "title" => "Blogg",
    "rule" => array(
      "^blogg\.de" => ""
    )
  ),
  "blogland" => array(
    "icon" => "robot",
    "title" => "BlogLand",
    "rule" => array(
      "BlogLand[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "bloglines" => array(
    "icon" => "bloglines",
    "title" => "Bloglines",
    "rule" => array(
      "Bloglines[ /]([0-9.]{1,10})" => "\\1",
      "Bloglines" => ""
    )
  ),
  "bloglovin" => array(
    "icon" => "robot",
    "title" => "Bloglovin",
    "rule" => array(
      "Bloglovin[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "blogmap" => array(
    "icon" => "robot",
    "title" => "Blogmap",
    "rule" => array(
      "blogmap" => ""
    )
  ),
  "blogosphere" => array(
    "icon" => "robot",
    "title" => "Blogosphere",
    "rule" => array(
      "Blogosphere" => ""
    )
  ),
  "blogpeople" => array(
    "icon" => "robot",
    "title" => "BlogPeople",
    "rule" => array(
      "BlogPeople" => ""
    )
  ),
  "blogpulse" => array(
    "icon" => "blogpulse",
    "title" => "Blogpulse",
    "rule" => array(
      "Blogpulse" => ""
    )
  ),
  "blogranking" => array(
    "icon" => "blogranking",
    "title" => "BlogRanking",
    "rule" => array(
      "^BlogRanking(/RSS checker)?" => ""

    )
  ),
  "blogs" => array(
    "icon" => "blogs",
    "title" => "Blo.gs",
    "rule" => array(
      "blo\.gs[ /]([0-9.]{1,10})" => "\\1",
      "blo\.gs" => ""

    )
  ),
  "blogshares" => array(
    "icon" => "blogshares",
    "title" => "BlogShares",
    "rule" => array(
      "BlogShares[ /]V?([0-9.]{1,10})" => "\\1",
      "(^| |\()Blogshares(\.com| |\))" => ""
    ),
    "uri" => ""
  ),
  "blogslife" => array(
    "icon" => "robot",
    "title" => "BlogsLife",
    "rule" => array(
      "Blogslive" => ""
    )
  ),
  "blogsnow" => array(
    "icon" => "blogsnow",
    "title" => "BlogsNow",
    "rule" => array(
      "blogsnowbot" => "",
      "BlogsNow" => ""
    )
  ),
  "blogstreet" => array(
    "icon" => "blogstreet",
    "title" => "BlogStreet",
    "rule" => array(
      "^BlogStreetBot" => ""
    )
  ),
  "blogsurf" => array(
    "icon" => "robot",
    "title" => "BlogSurf",
    "rule" => array(
      "nomadscafe_ra[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "blogtick" => array(
    "icon" => "robot",
    "title" => "BlogTick",
    "rule" => array(
      "BlogTickServer" => ""
    )
  ),
  "blogwatcher" => array(
    "icon" => "blogwatcher",
    "title" => "Blogwatcher",
    "rule" => array(
      "blogWatcher_Spider[/ ]([0-9.]{1,10})" => "\\1",
    )
  ),
  "blogwise" => array(
    "icon" => "blogwise",
    "title" => "Blogwise",
    "rule" => array(
      "Blogwise\.com(-MetaChecker)?[/ ]([0-9.]{1,10})" => "\\2",
    )
  ),
  "boardreader" => array(
    "icon" => "boardreader",
    "title" => "BoardReader",
    "rule" => array(
      "BoardReader[ \-](Image|Favicon)[ \-]Fetcher[ /]+([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.boardreader.com"
  ),
  "bobby" => array(
    "icon" => "bobby",
    "title" => "Bobby",
    "rule" => array(
      "bobby[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "boitho" => array(
    "icon" => "robot",
    "title" => "Boitho",
    "rule" => array(
      "Boitho\.com[ \-](dc|robot)?[/ ]([0-9.]{1,10})" => "\\2"
    )
  ),
  "booch" => array(
    "icon" => "robot",
    "title" => "Booch",
    "rule" => array(
      "^booch[_ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "book" => array(
    "icon" => "book",
    "title" => "Bookmark",
    "rule" => array(
      "http://www\.bookmark\.ne\.jp" => ""
    )
  ),
  "bookdog" => array(
    "icon" => "bookdog",
    "title" => "Bookdog",
    "rule" => array(
      "^Bookdog[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "botje" => array(
    "icon" => "botje",
    "title" => "Botje",
    "rule" => array(
      "Plukkie[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.botje.com/"
  ),
  "bordermanager" => array(
    "icon" => "bordermanager",
    "title" => "Border Manager",
    "rule" => array(
      "BorderManager[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "bottomfeeder" => array(
    "icon" => "bottomfeeder",
    "title" => "BottomFeeder",
    "rule" => array(
      "BottomFeeder[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "browseremulator" => array(
    "icon" => "browseremulator",
    "title" => "BrowserEmulator",
    "rule" => array(
      "BrowserEmulator[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.dejavu.org/emulator.htm"
  ),
  "browsershots" => array(
    "icon" => "browsershots",
    "title" => "Browsershots",
    "rule" => array(
      "Browsershots URL Check" => ""
    ),
    "uri" => "http://browsershots.org"
  ),
  "browserspy" => array(
    "icon" => "robot",
    "title" => "BrowserSpy",
    "rule" => array(
      "BrowserSpy" => ""
    )
  ),
  "bruinbot" => array(
    "icon" => "robot",
    "title" => "BruinBot",
    "rule" => array(
      "BruinBot" => ""
    )
  ),
  "bruno" => array(
    "icon" => "robot",
    "title" => "Bruno",
    "rule" => array(
      "^Bruno" => ""
    )
  ),
  "btbot" => array(
    "icon" => "btbot",
    "title" => "BitTorrent",
    "rule" => array(
      "BTbot/([0-9.]{1,10})" => "\\1"
    )
  ),
  "bulkfeeds" => array(
    "icon" => "robot",
    "title" => "Bulkfeeds",
    "rule" => array(
      "Bulkfeeds[/ ]([a-z0-9.]{1,10})" => "\\1"
    )
  ),
  "burf" => array(
    "icon" => "burf",
    "title" => "Burf.com",
    "rule" => array(
      "^Norbert the Spider" => ""
    ),
    "uri" => "http://www.burf.com/"
  ),
  "butch" => array(
    "icon" => "robot",
    "title" => "Butch",
    "rule" => array(
      "Butch(__| )?([a-z0-9.]{1,10})" => "\\2"
    ),
    "uri" => ""
  ),
  "catchbot" => array(
    "icon" => "catchbot",
    "title" => "CatchBot",
    "rule" => array(
      "^CatchBot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.catchbot.com"
  ),
  "camdiscover" => array(
    "icon" => "robot",
    "title" => "Camdiscover",
    "rule" => array(
      "^Camcrawler" => ""
    )
  ),
  "cazoodle" => array(
    "icon" => "cazoodle",
    "title" => "Cazoodle",
    "rule" => array(
      "^CazoodleBot/(Nutch|CazoodleBot)[/ \-]([0-9.]{1,10})" => "\\2",
      "^CazoodleBot[/ ]([a-z0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.cazoodle.com/cazoodlebot"
  ),
  "ccbot" => array(
    "icon" => "robot",
    "title" => "CCBot",
    "rule" => array(
      "CCBot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.commoncrawl.org/bot.html"
  ),
  "ccgcrawl" => array(
    "icon" => "robot",
    "title" => "CCGCrawl",
    "rule" => array(
      "CCGCrawl[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.myworkbase.com/bot.html"
  ),
  "cerberian" => array(
    "icon" => "robot",
    "title" => "Cerberian Drtrs",
    "rule" => array(
      "^Cerberian Drtrs" => ""
    )
  ),
  "cfnetwork" => array(
    "icon" => "robot",
    "title" => "Cerberian Drtrs",
    "rule" => array(
      "^CFNetwork[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.cfnetwork.be/"
  ),
  "charlotte" => array(
    "icon" => "charlotte",
    "title" => "Charlotte",
    "rule" => array(
      "Charlotte[/ ]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "cirilizator" => array(
    "icon" => "cirilizator",
    "title" => "Cirilizator",
    "rule" => array(
      "Cirilizator[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "claria" => array(
    "icon" => "robot",
    "title" => "Claria",
    "rule" => array(
      "(Claria|Diamond)(Bot)?[ /]([0-9.]{1,10})" => "\\3",
      "(Claria|Diamond)(Bot)" => "",

    )
  ),
  "claymont" => array(
    "icon" => "claymont",
    "title" => "Claymont",
    "rule" => array(
      "claymont\.com" => "",
      "OliverPerry" => ""
    ),
    "uri" => "http://www.claymont.com"
  ),
  "clush" => array(
    "icon" => "clush",
    "title" => "Clush",
    "rule" => array(
      "Clus(tered-Search-|h)Bot[ /]([0-9.]{1,10})" => "\\2"
    )
  ),
  "cobion" => array(
    "icon" => "robot",
    "title" => "Cobion",
    "rule" => array(
      " (QXW03018|obot)\)" => ""
    )
  ),
  "coldfusion" => array(
    "icon" => "coldfusion",
    "title" => "ColdFusion",
    "rule" => array(
      "^coldfusion" => ""
    )
  ),
  "combine" => array(
    "icon" => "robot",
    "title" => "Combine",
    "rule" => array(
      "Combine[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "combot" => array(
    "icon" => "robot",
    "title" => "comBot",
    "rule" => array(
      "^comBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "comet" => array(
    "icon" => "comet",
    "title" => "Comet",
    "rule" => array(
      "cometsearch@cometsystems" => ""
    )
  ),
  "commerobo" => array(
    "icon" => "robot",
    "title" => "Commerobo",
    "rule" => array(
      "Commerobo[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "comrite" => array(
    "icon" => "robot",
    "title" => "ComRite",
    "rule" => array(
      "Comrite[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.comrite.com/"
  ),
  "convera" => array(
    "icon" => "convera",
    "title" => "Convera",
    "rule" => array(
      "Convera(MultiMedia)?Crawler[/ ]([0-9.]{1,10})" => "\\2",
      "Convera Internet Spider V([0-9.]{1,10})" => "\\1"
    )
  ),
  "coolbot" => array(
    "icon" => "robot",
    "title" => "CoolBot",
    "rule" => array(
      "^CoolBot" => ""
    )
  ),
  "cosmix" => array(
    "icon" => "robot",
    "title" => "Cosmix",
    "rule" => array(
      "^(voyager|cfetch|CosmixCrawler|carleson)[/ ]([0-9.]{1,10})" => "\\2",
    )
  ),
  "cosmos" => array(
    "icon" => "robot",
    "title" => "Cosmos",
    "rule" => array(
      "^cosmos" => ""
    )
  ),
  "cosmoty" => array(
    "icon" => "robot",
    "title" => "Cosmoty",
    "rule" => array(
      "^beautybot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.uchoose.de/crawler/beautybot/"
  ),
  "creativecommons" => array(
    "icon" => "creativecommons",
    "title" => "Creative Commons",
    "rule" => array(
    "CreativeCommons[/ ]([0-9.]{1,6}(-dev)?)" => "\\1"
    )
  ),
  "cscrawler" => array(
    "icon" => "robot",
    "title" => "CsCrawler",
    "rule" => array(
      "CsCrawler" => ""
    ),
    "uri" => "http://www.kde.cs.uni-kassel.de/lehre/ss2005/googlespam/crawler.html"
  ),
  "csscheck" => array(
    "icon" => "w3c",
    "title" => "W3C CSS Validator",
    "rule" => array(
      "CSS(Check|_Validator)+[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://jigsaw.w3.org/css-validator/"
  ),
  "custo" => array(
    "icon" => "robot",
    "title" => "Custo",
    "rule" => array(
      "Custo[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "cybernavi" => array(
    "icon" => "robot",
    "title" => "CyberNavi",
    "rule" => array(
      "CyberNavi_WebGet[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "cyberpatrol" => array(
    "icon" => "cyberpatrol",
    "title" => "CyberPatrol",
    "rule" => array(
      "^CyberPatrol" => ""
    ),
    "uri" => "http://www.cyberpatrol.com/cyberpatrolcrawler.asp"
  ),
  "cyberz" => array(
    "icon" => "cyberz",
    "title" => "Cyberz",
    "rule" => array(
      "Cyberz Communication Agent" => ""
    )
  ),
  "cydral" => array(
    "icon" => "robot",
    "title" => "Cydral",
    "rule" => array(
      "CydralSpider[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "cynthia" => array(
    "icon" => "cynthia",
    "title" => "Cynthia Says",
    "rule" => array(
      "Cynthia[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "d4x" => array(
    "icon" => "d4x",
    "title" => "Downloader for X",
    "rule" => array(
      "Downloader for X[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "da" => array(
    "icon" => "da",
    "title" => "DA",
    "rule" => array(
      "^DA[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "daum" => array(
    "icon" => "daum",
    "title" => "DAUM",
    "rule" => array(
      "DAUMOA[ /]([0-9.]{1,10})" => "\\1",
      "DAUM Web Robot" => "",
      "Daum Communications Corp" => "",
      "EDI[ /]([0-9.]{1,10})" => "\\1",
      "Edacious.*Intelligent Web Robot" => "",
      "RaBot[/ ]([0-9.]{1,10}) Agent" => "\\1"
    ),
    "uri" => ""
  ),
  "daypop" => array(
    "icon" => "robot",
    "title" => "Daypop",
    "rule" => array(
      "daypopbot[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "delfi" => array(
    "icon" => "delfi",
    "title" => "Delfi",
    "rule" => array(
      "crawl at delfi dot lt" => ""
    )
  ),
  "depspid" => array(
    "icon" => "depspid",
    "title" => "DepSpid",
    "rule" => array(
      "DepSpid[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "devonagent" => array(
    "icon" => "devonagent",
    "title" => "DEVONagent",
    "rule" => array(
      "DEVONtech" => ""
    )
  ),
  "diffbot" => array(
    "icon" => "diffbot",
    "title" => "Diffbot",
    "rule" => array(
      " Diffbot" => ""
    ),
    "uri" => "http://www.diffbot.com"
  ),
  "digest" => array(
    "icon" => "robot",
    "title" => "dige.st",
    "rule" => array(
      "dige.st" => ""
    ),
    "uri" => "http://dige.st/"
  ),
  "directhit" => array(
    "icon" => "robot",
    "title" => "Direct Hit",
    "rule" => array(
      "EZResult -- Internet Search Engine" => ""
    ),
    "uri" => "http://www.directhit.com"
  ),
  "disco" => array(
    "icon" => "disco",
    "title" => "disco",
    "rule" => array(
      "disco/Nutch[/ -]([0-9.]{1,10})" => "\\1",
      "discobot[/ -]([0-9.]{1,10})" => "\\1",
      "disco-crawl@discoveryengine.com" => ""
    ),
    "uri" => "http://www.discoveryengine.com/"
  ),
  "discopump" => array(
    "icon" => "robot",
    "title" => "DISCo Pump",
    "rule" => array(
      "DISCo Pump[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "dnsdigger" => array(
    "icon" => "dnsdigger",
    "title" => "DNS-Digger",
    "rule" => array(
      "DNS-Digger-Explorer[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.dnsdigger.com"
  ),
  "doctorhtml" => array(
    "icon" => "robot",
    "title" => "DoctorHTML",
    "rule" => array(
      "Doctor[ \-]?HTML" => ""
    )
  ),
  "domaindatei" => array(
    "icon" => "robot",
    "title" => "Domaindatei",
    "rule" => array(
      "DomaindateiSpider[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "dontbuylists" => array(
    "icon" => "dontbuylists",
    "title" => "Dontbuylists",
    "rule" => array(
      "DBLBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.dontbuylists.com/"
  ),
  "dotbot" => array(
    "icon" => "robot",
    "title" => "DotBot",
    "rule" => array(
      "DotBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.dotnetdotcom.org"
  ),
  "doweb" => array(
    "icon" => "doweb",
    "title" => "DoWeb",
    "rule" => array(
      "^www.doweb.co.uk" => "\\1"
    ),
    "uri" => "http://www.doweb.co.uk/"
  ),
  "downloadninja" => array(
    "icon" => "robot",
    "title" => "Download Ninja",
    "rule" => array(
      "Download Ninja[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "drupal" => array(
    "icon" => "drupal",
    "title" => "Drupal",
    "rule" => array(
      "^Drupal" => ""
    )
  ),
  "dsns" => array(
    "icon" => "robot",
    "title" => "DSNS Scanner",
    "rule" => array(
      "^DSNS" => ""
    )
  ),
  "dtsagent" => array(
    "icon" => "robot",
    "title" => "DTS Agent",
    "rule" => array(
      "DTS Agent" => ""
    )
  ),
  "earthcom" => array(
    "icon" => "earthcom",
    "title" => "Earthcom",
    "rule" => array(
      "EARTHCOM\.info[/ ]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "ebay" => array(
    "icon" => "ebay",
    "title" => "eBay",
    "rule" => array(
      "eBay Relevance Ad Crawler" => ""
    )
  ),
  "ecairn-grabber" => array(
    "icon" => "robot",
    "title" => "eCairn Grabber",
    "rule" => array(
      "eCairn-Grabber[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://ecairn.com/grabber"
  ),
  "echo" => array(
    "icon" => "robot",
    "title" => "Echo.com",
    "rule" => array(
      "_TrueRobot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.echo.com/"
  ),
  "eert" => array(
    "icon" => "robot",
    "title" => "eert",
    "rule" => array(
      "eert spdr[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://bot.eert.net"
  ),
  "eknip" => array(
    "icon" => "eknip",
    "title" => "E-Knip",
    "rule" => array(
      "eknip[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "eliyon" => array(
    "icon" => "zoominfo",
    "title" => "zoominfo",
    "rule" => array(
      "NextGenSearchBot[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "emeraldshield" => array(
    "icon" => "emeraldshield",
    "title" => "EmeraldShield",
    "rule" => array(
      "^EmeraldShield" => ""
    )
  ),
  "empas" => array(
    "icon" => "empas",
    "title" => "Empas",
    "rule" => array(
      "DigExt; empas\)$" => "",
      "^EMPAS[_\-]ROBOT" => ""
    )
  ),
  "entireweb" => array(
    "icon" => "entireweb",
    "title" => "Entireweb",
    "rule" => array(
      "Speedy[ ]?Spider" => ""
    )
  ),
  "envolk" => array(
    "icon" => "envolk",
    "title" => "Envolk",
    "rule" => array(
      "envolk\[ITS\]spider[/ ]([0-9.]{1,10})" => "\\1",
      "envolk[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "esnet" => array(
    "icon" => "robot",
    "title" => "ES.NET",
    "rule" => array(
      "ES.NET Crawler[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "estyle" => array(
    "icon" => "estyle",
    "title" => "eStyle Search",
    "rule" => array(
      "eStyleSearch[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "eurip" => array(
    "icon" => "robot",
    "title" => "Eurip",
    "rule" => array(
      "EuripBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.eurip.com"
  ),
  "eurodirectory" => array(
    "icon" => "robot",
    "title" => "Euro Directory",
    "rule" => array(
      "www\.euro-directory\.com" => ""
    ),
    "uri" => "http://www.euro-directory.com/"
  ),
  "euroseek" => array(
    "icon" => "euroseek",
    "title" => "EuroSeek",
    "rule" => array(
      "Arachnoidea" => ""
    )
  ),
  "evaal" => array(
    "icon" => "evaal",
    "title" => "Evaal",
    "rule" => array(
      "^EvaalSE" => ""
    ),
    "uri" => "http://www.evaal.com/"
  ),
  "eventax" => array(
    "icon" => "eventax",
    "title" => "Eventax",
    "rule" => array(
      "^eventax[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.eventax.de/"
  ),
  "everbee" => array(
    "icon" => "everbee",
    "title" => "Everbee",
    "rule" => array(
      "EverbeeCrawler" => ""
    )
  ),
  "everest" => array(
    "icon" => "everest",
    "title" => "Everest",
    "rule" => array(
      "Everest-Vulcan Inc.[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "exabot" => array(
    "icon" => "exabot",
    "title" => "ExaBot",
    "rule" => array(
      "^NG[ /]([0-9.]{1,10})" => "\\1",
      "Exabot/([0-9.]{1,10})" => "\\1",
      "ExaBotTest/([0-9.]{1,10})" => "\\1",
      "ExaBot-(Test|Images)/([0-9.]{1,10})" => "\\2",
      "ExaBot-Thumbnails" => ""
    ),
    "uri" => "http://www.exabot.com/go/robot"
  ),
  "exactseek" => array(
    "icon" => "exactseek",
    "title" => "ExactSeek",
    "rule" => array(
      "^exactseek[ \-]?(pagereaper|crawler)[ \-]?([0-9.]{1,10})" => "\\2",
      "ExactSeek[ \.\-]?(Crawler|com)" => ""
    )
  ),
  "excite" => array(
    "icon" => "excite",
    "title" => "Excite",
    "rule" => array(
      "Architext[ \-]?Spider" => ""
    )
  ),
  "execrawl" => array(
    "icon" => "robot",
    "title" => "Execrawl",
    "rule" => array(
      "Execrawl[ /]([0-9.]{1,10})" => "\\1",
      "Execrawl" => ""
    )
  ),
  "expertmonitor" => array(
    "icon" => "robot",
    "title" => "ExpertMonitor",
    "rule" => array(
      "^NetMonitor[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "explorerrss" => array(
    "icon" => "rss",
    "title" => "Explorer RSS",
    "rule" => array(
      "^Windows-RSS-Platform[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "facebook" => array(
    "icon" => "facebook",
    "title" => "Facebook",
    "rule" => array(
      "^facebook" => "",
      "FacebookFeedParser[/ ]([0-9a-z.\-]{1,10})" => "\\1"
    ),
    "uri" => "http://www.facebook.com/"
  ),
  "fairshare" => array(
    "icon" => "robot",
    "title" => "FairShare",
    "rule" => array(
      "FairShare" => ""
    )
  ),
  "fast" => array(
    "icon" => "fast",
    "title" => "Fast",
    "rule" => array(
      "^FAST( Enterprise |-Web| MetaWeb )?Crawler[ /]([0-9.]{1,10})" => "\\2",
      "^FAST( Enterprise |-Web| MetaWeb | PartnerSite )?Crawler" => "",
      "^Fast Crawler" => "",
      "^libwww-perl[ /]([0-9.]{1,10}) FP[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.alltheweb.com/"
  ),
  "fastbuzz" => array(
    "icon" => "fastbuzz",
    "title" => "Fastbuzz",
    "rule" => array(
      "^fastbuzz\.com" => ""
    )
  ),
  "favorg" => array(
    "icon" => "robot",
    "title" => "FavOrg",
    "rule" => array(
      "^FavOrg" => ""
    )
  ),
  "favorstar" => array(
    "icon" => "favorstar",
    "title" => "favorstar",
    "rule" => array(
      "favorstarbot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://favorstar.com/bot.html"
  ),
  "faxo" => array(
    "icon" => "robot",
    "title" => "Faxo",
    "rule" => array(
      "^Faxobot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.faxo.com/"
  ),
  "fdse" => array(
    "icon" => "robot",
    "title" => "FDSE Robot",
    "rule" => array(
      "FDSE[ \-]?robot" => ""
    )
  ),
  "feedback" => array(
    "icon" => "robot",
    "title" => "FeedBack",
    "rule" => array(
      "FeedBack[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "feedburner" => array(
    "icon" => "feedburner",
    "title" => "FeedBurner",
    "rule" => array(
      "^FeedBurner[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "feeddemon" => array(
    "icon" => "feeddemon",
    "title" => "FeedDemon",
    "rule" => array(
      "FeedDemon[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "feedfind" => array(
    "icon" => "feedfind",
    "title" => "FeedFind",
    "rule" => array(
      "Feed::Find[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "feedonfeeds" => array(
    "icon" => "robot",
    "title" => "Feed On Feeds",
    "rule" => array(
      "FeedOnFeeds[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "feedparser" => array(
    "icon" => "robot",
    "title" => "Feedparser",
    "rule" => array(
      "UniversalFeedParser[/ ]([0-9a-z.\-]{1,10})" => "\\1",
      "FeedParser" => ""
    )
  ),
  "feedreader" => array(
    "icon" => "feedreader",
    "title" => "Feedreader",
    "rule" => array(
      "^Feedreader" => ""
    )
  ),
  "feedserver" => array(
    "icon" => "robot",
    "title" => "FeedServer",
    "rule" => array(
      "FeedServer[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "feedster" => array(
    "icon" => "feedster",
    "title" => "Feedster",
    "rule" => array(
      "Feedster Crawler[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "feedvalidator" => array(
    "icon" => "feedvalidator",
    "title" => "Feed Validator",
    "rule" => array(
      "^FeedValidator[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "fdm" => array(
    "icon" => "robot",
    "title" => "Free Download Manager",
    "rule" => array(
      "^FDM[/ ]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "filangy" => array(
    "icon" => "robot",
    "title" => "Filangy",
    "rule" => array(
      "Filangy[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.filangy.com/"
  ),
  "findanisp" => array(
    "icon" => "robot",
    "title" => "FindAnISP",
    "rule" => array(
      "FindAnISP" => ""
    ),
    "uri" => "http://www.findanisp.com/"
  ),
  "findengines" => array(
    "icon" => "findengines",
    "title" => "FindEngines",
    "rule" => array(
      "FindEngines! Bot" => ""
    )
  ),
  "findexa" => array(
    "icon" => "findexa",
    "title" => "Findexa",
    "rule" => array(
      "Findexa Crawler" => ""
    )
  ),
  "findlinks" => array(
    "icon" => "findlinks",
    "title" => "FindLinks",
    "rule" => array(
      "findlinks[ /]([0-9.]{1,10})" => "\\1",
      "^FindLinks" => ""
    )
  ),
  "findoor" => array(
    "icon" => "findoor",
    "title" => "findoor",
    "rule" => array(
      "^findoor(-Bot)?" => "\\1"
    )
  ),
  "firefly" => array(
    "icon" => "firefly",
    "title" => "Firefly",
    "rule" => array(
      "Firefly" => ""
    )
  ),
  "flashget" => array(
    "icon" => "flashget",
    "title" => "FlashGet",
    "rule" => array(
      "^FlashGet" => ""
    )
  ),
  "flatland" => array(
    "icon" => "flatland",
    "title" => "Flatland",
    "rule" => array(
      "^flatlandbot" => ""
    ),
    "uri" => "http://www.flatlandindustries.com/flatlandbot"
  ),
  "flickbot" => array(
    "icon" => "flickbot",
    "title" => "FlickBot",
    "rule" => array(
      "FlickBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "forex" => array(
    "icon" => "robot",
    "title" => "Forex",
    "rule" => array(
      "^Forex Trading Network Organization" => ""
    ),
    "uri" => "http://www.netforex.org/"
  ),
  "freshmeat" => array(
    "icon" => "freshmeat",
    "title" => "freshmeat",
    "rule" => array(
      "fmII URL validator[ /]([0-9.]{1,10})" => "\\1",
      "freshmeat.net URL validator[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.freshmeat.net/"
  ),
  "friend" => array(
    "icon" => "friend",
    "title" => "Friend",
    "rule" => array(
      "www\.friend\.fr" => ""
    )
  ),
  "friendfeed" => array(
    "icon" => "robot",
    "title" => "FriendFeed",
    "rule" => array(
      "FriendFeedBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "frontier" => array(
    "icon" => "frontier",
    "title" => "Frontier",
    "rule" => array(
      "Frontier[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "gaisbot" => array(
    "icon" => "gais",
    "title" => "Gaisbot",
    "rule" => array(
      "Gaisbot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "galaxy" => array(
    "icon" => "galaxy",
    "title" => "Galaxy",
    "rule" => array(
      "GalaxyBot[ /]([0-9.]{1,10})" => "\\1",
      "www.galaxy.com" => ""
    ),
    "uri" => "http://www.galaxy.com/"
  ),
  "gamespy" => array(
    "icon" => "gamespy",
    "title" => "GameSpy",
    "rule" => array(
      "GameSpyHTTP[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "gdesktop" => array(
    "icon" => "gdesktop",
    "title" => "Google Desktop",
    "rule" => array(
      "compatible; Google Desktop" => ""
    )
  ),
  "genome" => array(
    "icon" => "robot",
    "title" => "Genome Machine",
    "rule" => array(
      "Genome[ \-]?Machine" => ""
    )
  ),
  "geohash" => array(
    "icon" => "geohash",
    "title" => "Geohash",
    "rule" => array(
      "GeoHasher(/Nutch)[ /-]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://geohash.org/"
  ),
  "geona" => array(
    "icon" => "robot",
    "title" => "Geona",
    "rule" => array(
      "GeonaBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "geoblog" => array(
    "icon" => "robot",
    "title" => "The World as a Blog",
    "rule" => array(
      "The World as a Blog" => ""
    )
  ),
  "geourl" => array(
    "icon" => "geourl",
    "title" => "GeoUrl",
    "rule" => array(
      "geourl[ /]([0-9.]{1,10})" => "\\1",
      "^GeoURLBot[ /]([0-9.]{1,10})" => "\\1",
    )
  ),
  "getnetwise" => array(
    "icon" => "robot",
    "title" => "GetNetWise",
    "rule" => array(
      " Crayon Crawler" => ""
    )
  ),
  "getright" => array(
    "icon" => "getright",
    "title" => "GetRight",
    "rule" => array(
      "GetRight[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "getsmart" => array(
    "icon" => "getsmart",
    "title" => "GetSmart",
    "rule" => array(
      "GetSmart[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "ginger" => array(
    "icon" => "ginger",
    "title" => "GingerCrawler",
    "rule" => array(
      "GingerCrawler[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.gingersoftware.com/crawler_agent.htm"
  ),
  "gigabot" => array(
    "icon" => "gigablast",
    "title" => "Gigablast",
    "rule" => array(
      "(Gigabot|Sitesearch)[/ ]([0-9.]{1,10})" => "\\2",
      "GigabotSiteSearch[/ ]([0-9.]{1,10})" => "\\1",
    )
  ),
  "girafabot" => array(
    "icon" => "girafa",
    "title" => "Girafa",
    "rule" => array(
      "Girafabot" => ""
    )
  ),
  "globalspec" => array(
    "icon" => "globalspec",
    "title" => "GlobalSpec",
    "rule" => array(
      "Ocelli[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "glucose" => array(
    "icon" => "glucose",
    "title" => "Glucose",
    "rule" => array(
      "glucose[ /]([0-9a-z.\-]{1,10})" => "\\1"
    )
  ),
  "gnomit" => array(
    "icon" => "gnomit",
    "title" => "Gnomit",
    "rule" => array(
      "gnomit[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.gnomit.com/",
  ),
  "goforit" => array(
    "icon" => "goforit",
    "title" => "GoForIt",
    "rule" => array(
      "^GoForIt\.com" => "",
      "^GOFORITBOT" => ""
    )
  ),
  "goguides" => array(
    "icon" => "robot",
    "title" => "GoGuides",
    "rule" => array(
      "^GoGuidesBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.goguides.org/"
  ),
  "goo" => array(
    "icon" => "goo",
    "title" => "Goo",
    "rule" => array (
      "(gazz|ichiro|mog(et|imogi))[ /]([0-9.]{1,10})" => "\\3"
    )
  ),
//TODO: Must be before google... sigh
  "mediapartners" => array(
    "icon" => "google",
    "title" => "Mediapartners",
    "rule" => array (
      "Mediapartners-Google[ /]([0-9.]{1,10})" => "\\1",
      "Mediapartners-Google" => ""
    )
  ),
  "google" => array(
    "icon" => "google",
    "title" => "Google",
    "rule" => array (
      "Googl(e|ebot)(-Image)?/([0-9.]{1,10})" => "\\3",
      "Googl(e|ebot)(-Image)?/" => "",
      "^gsa-crawler" => ""
    )
  ),
//TODO: Merge with google?
  "googlesitemaps" => array(
    "icon" => "google",
    "title" => "Google-Sitemaps",
    "rule" => array (
      "Googl(e|ebot)(-Sitemaps)?/([0-9.]{1,10})" => "\\3",
      "GSiteCrawler[ /v]*([0-9.a-z]{1,10})" => "\\1",
      "Googl(e|ebot)(-Sitemaps)?/" => ""
    )
  ),
//TODO: Merge with google?
  "googlemobile" => array(
    "icon" => "google",
    "title" => "Google-Mobile",
    "rule" => array (
      "Googl(e|ebot)(-Mobile)?/([0-9.]{1,10})" => "\\3",
      "Googl(e|ebot)(-Mobile)?/" => ""
    )
  ),
  "googleads" => array(
    "icon" => "google",
    "title" => "Google-AdsBot",
    "rule" => array (
      "^AdsBot-Google" => "",
    )
  ),
  "googlefeeds" => array(
    "icon" => "google",
    "title" => "Google-Feedfetcher",
    "rule" => array (
      "^Feedfetcher-Google" => "",
    )
  ),
  "googlewireless" => array(
    "icon" => "google",
    "title" => "Google Wireless Transcoder",
    "rule" => array (
      "Google Wireless Transcoder" => "",
    )
  ),
  "goongee" => array(
    "icon" => "robot",
    "title" => "GoonGee",
    "rule" => array (
      "^Big Fish[ /]v?([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.goongee.com/"
  ),
  "gpost" => array(
    "icon" => "gpost",
    "title" => "GPost",
    "rule" => array(
      "^GPostbot" => ""
    )
  ),
  "gregarius" => array(
    "icon" => "robot",
    "title" => "Gregarius",
    "rule" => array(
      "^Gregarius[/ ]([0-9.]{1,10})" => ""
    )
  ),
  "grub" => array(
    "icon" => "grub",
    "title" => "Grub",
    "rule" => array(
      "grub[ \-]?client[ /\-]{1,5}([0-9.]{1,10})" => "\\1",
      "grub crawler" => "",
      "grub[/ ]([0-9.]{1,10})" => "\\1",
      "^GrubNG" => ""
    ),
    "uri" => "http://www.grub.org/"
  ),
  "gulliver" => array(
    "icon" => "robot",
    "title" => "Gulliver",
    "rule" => array(
      "Gulliver" => ""
    )
  ),
  "guruji" => array(
    "icon" => "guruji",
    "title" => "Guruji",
    "rule" => array(
      "GurujiBot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.guruji.com/"
  ),
  "gush" => array(
    "icon" => "robot",
    "title" => "Gush",
    "rule" => array(
      "^Gush[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "gziptester" => array(
    "icon" => "robot",
    "title" => "Gzip Tester",
    "rule" => array(
      "g(id)?zip[ \-]?test(er)?" => ""
    )
  ),
  "hanzoweb" => array(
    "icon" => "hanzoweb",
    "title" => "Hanzoweb",
    "rule" => array(
      "^Hanzoweb" => ""
    )
  ),
  "harbot" => array(
    "icon" => "harbot",
    "title" => "Harbot",
    "rule" => array(
      "^Harbot GateStation" => ""
    )
  ),
  "hatena" => array(
    "icon" => "hatena",
    "title" => "Hatena",
    "rule" => array(
      "Hatena (Antenna|Bookmark|Pagetitle Agent)[ /]([0-9.]{1,10})" => "\\2"
    )
  ),
  "helix" => array(
    "icon" => "Helix",
    "title" => "Heritrix",
    "rule" => array(
      "^helix[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sitesearch.ca/helix/"
  ),
  "heritrix" => array(
    "icon" => "heritrix",
    "title" => "Heritrix",
    "rule" => array(
      "heritrix[ /]([0-9.]{1,10})" => "\\1",
      "archive.org_bot" => "",
      "InternetArchive[ /]([0-9.a-z]{1,10})" => "\\1"
    ),
    "uri" => "http://archive.org"
  ),
  "hiddenmarket" => array(
    "icon" => "robot",
    "title" => "HiddenMarket",
    "rule" => array(
      "HiddenMarket[ /\-]([0-9.]{1,10})" => "\\1"
    )
  ),
  "honda" => array(
    "icon" => "robot",
    "title" => "Honda",
    "rule" => array(
      "Honda-Search[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.honda-search.com"
  ),
  "hoowwwer" => array(
    "icon" => "hoowwwer",
    "title" => "HooWWWer",
    "rule" => array(
      "HooWWWer[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "hotzonu" => array(
    "icon" => "hotzonu",
    "title" => "Hotzonu",
    "rule" => array(
      "Hotzonu[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "houxou" => array(
    "icon" => "robot",
    "title" => "Houxou",
    "rule" => array(
      "HouxouCrawler[ /]Nutch.([0-9.]{1,10})" => "\\1",
      "HouxouCrawler" => ""
    )
  ),
  "htdig" => array(
    "icon" => "htdig",
    "title" => "ht://Dig",
    "rule" => array(
      "htdig[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "html2jpg" => array(
    "icon" => "html2jpg",
    "title" => "HTML2JPG",
    "rule" => array(
      "^HTML2JPG" => ""
    )
  ),
  "httperf" => array(
    "icon" => "robot",
    "title" => "HTTPerf",
    "rule" => array(
      "httperf[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "httpunit" => array(
    "icon" => "httpunit",
    "title" => "HttpUnit",
    "rule" => array(
      "httpunit[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "httrack" => array(
    "icon" => "httrack",
    "title" => "HTTrack",
    "rule" => array(
      "HTTrack[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "hungary" => array(
    "icon" => "hungary",
    "title" => "Hungary",
    "rule" => array(
      "HuRob[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "iakke" => array(
    "icon" => "iakke",
    "title" => "Iakk&eacute;",
    "rule" => array(
      "^iakke_bot[ /]v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://fr.iakke.com/"
  ),
  "iask" => array(
    "icon" => "iask",
    "title" => "IAsk",
    "rule" => array(
      "iaskspider[ /]([0-9.]{1,10})" => "\\1",
      "^iaskspider" => ""
    ),
    "uri" => "http://iask.com"
  ),
  "icc" => array(
    "icon" => "icc",
    "title" => "ICC-Crawler",
    "rule" => array(
      "^ICC-Crawler" => ""
    ),
    "uri" => "http://kc.nict.go.jp/icc/crawl.html"
  ),
  "icerocket" => array(
    "icon" => "icerocket",
    "title" => "Icerocket",
    "rule" => array(
      "BlogzIce[ /]([0-9.]{1,10})" => "\\1",
      "BlogSearch[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "icra" => array(
    "icon" => "icra",
    "title" => "ICRA",
    "rule" => array(
      "^ICRA_Semantic_spider[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.icra.org"
  ),
  "ics" => array(
    "icon" => "robot",
    "title" => "ICS",
    "rule" => array(
      "^Mozilla[/ ]([0-9.]{1,10})[/ ]\(compatible[ ;]*ICS" => "\\1"
    )
  ),
  "iknow" => array(
    "icon" => "robot",
    "title" => "I know",
    "rule" => array(
      "Comaneci_bot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "ilial" => array(
    "icon" => "robot",
    "title" => "Ilial",
    "rule" => array(
      "ilial[ /]Nutch[ \-]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "ilse" => array(
    "icon" => "ilse",
    "title" => "Ilse",
    "rule" => array(
      "I(NGRID|lseRobot|lseBot)[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://ilse.nl/"
  ),
  "iltrovatore" => array(
    "icon" => "iltrovatore",
    "title" => "IlTrovatore",
    "rule" => array(
      "iltrovatore-setaccio[ /]([0-9.]{1,10})" => "\\1",
      "Iltrovatore-Setaccio" => "",
      "iltrovatore[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "ina" => array(
    "icon" => "robot",
    "title" => "INA",
    "rule" => array(
      "INA dlweb" => ""
    ),
    "uri" => "http://www.ina-entreprise.com/entreprise/activites/depot-legal-radio-tele/depot-legal-web.html"
  ),
  "indylibrary" => array(
    "icon" => "robot",
    "title" => "Indy Library",
    "rule" => array(
      "Indy[ \-]?Library" => ""
    )
  ),
  "inela" => array(
    "icon" => "robot",
    "title" => "Inela",
    "rule" => array(
      "InelaBot[ /]([0-9.]{1,10})" => ""
    ),
    "uri" => "http://inelegant.org/bot"
  ),
  "ineturl" => array(
    "icon" => "robot",
    "title" => "InetURL",
    "rule" => array(
      "InetURL.?[ /]([0-9.]{1,10})" => ""
    ),
    "uri" => ""
  ),
  "infoart" => array(
    "icon" => "robot",
    "title" => "InfoArt",
    "rule" => array(
      "InfoArt crawler" => ""
    )
  ),
  "infomine" => array(
    "icon" => "infomine",
    "title" => "INFOMINE",
    "rule" => array(
      "^DataFountains/DMOZ" => "",
      "^INFOMINE[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://infomine.ucr.edu/"
  ),
  "infoseek" => array(
    "icon" => "infoseek",
    "title" => "Infoseek",
    "rule" => array(
      "SideWinder[ /]?([0-9a-z.]{1,10})" => "\\1",
      "Infoseek" => ""
    )
  ),
  "inktomi" => array(
    "icon" => "inktomi",
    "title" => "Inktomi",
    "rule" => array(
      "slurp@inktomi\.com" => ""
    )
  ),
  "innerprise" => array(
    "icon" => "robot",
    "title" => "Innerprise",
    "rule" => array(
      "^InnerpriseBot[ /]([0-9.]{1,10})" => "\\1",
      "URL[ _]Spider[ _]Pro[ /]([0-9.+]{1,10})" => "\\1",
      "^ES[ .]NET[ _]Crawler[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.innerprise.com/"
  ),
  "inria" => array(
    "icon" => "inria",
    "title" => "Inria",
    "rule" => array(
      "^xyro_" => ""
    )
  ),
  "insitor" => array(
    "icon" => "insitor",
    "title" => "Insitor",
    "rule" => array(
      "^Insitor(,|\.|naut)" => ""
    ),
    "uri" => "http://www.insitor.com/"
  ),
  "internetninja" => array(
    "icon" => "robot",
    "title" => "Internet Ninja",
    "rule" => array(
      "^Internet Ninja[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "internetseer" => array(
    "icon" => "internetseer",
    "title" => "InternetSeer",
    "rule" => array(
      "^InternetSeer\.com" => ""
    )
  ),
  "interseek" => array(
    "icon" => "interseek",
    "title" => "Interseek",
    "rule" => array(
      "Interseek.com" => ""
    ),
    "uri" => "http://www.interseek.com"
  ),
  "intravnews" => array(
    "icon" => "intravnews",
    "title" => "IntraVnews",
    "rule" => array(
      "IntraVnews[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.intravnews.com/"
  ),
  "ip2location" => array(
    "icon" => "ip2location",
    "title" => "IP2LocationBot",
    "rule" => array(
      "^IP2(Map|Location)Bot[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.ip2location.com"
  ),
  "ipworks" => array(
    "icon" => "ipworks",
    "title" => "IP*Works",
    "rule" => array(
      "^IP\*Works\! V([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.nsoftware.com/ipworks/"
  ),
  "irca" => array(
    "icon" => "robot",
    "title" => "Novell iChain Cool Solutions caching",
    "rule" => array(
      "^ICRA_(label_generator|Semantic_spider)[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.icra.org"
  ),
  "irvine" => array(
    "icon" => "robot",
    "title" => "Irvine",
    "rule" => array(
      "Irvine[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "ips-agent" => array(
    "icon" => "robot",
    "title" => "ips-agent",
    "rule" => array(
      "ips-agent" => ""
    ),
    "uri" => ""
  ),
  "isara" => array(
    "icon" => "isara",
    "title" => "isara",
    "rule" => array(
      "Isara[ -]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.isara.org/"
  ),
  "isspider" => array(
    "icon" => "robot",
    "title" => "ISSpider",
    "rule" => array(
      "ISSpider[ /\-]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "ivia" => array(
    "icon" => "robot",
    "title" => "iVia",
    "rule" => array(
      "iVia Site Checker.?[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "jeteye" => array(
    "icon" => "jeteye",
    "title" => "Jeteye",
    "rule" => array(
      "Jetbot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "jigsaw" => array(
    "icon" => "jigsaw",
    "title" => "Jigsaw",
    "rule" => array(
      "Jigsaw[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "jobsde" => array(
    "icon" => "jobsde",
    "title" => "jobs.de",
    "rule" => array(
      "www\.jobs\.de" => "",
      "jobs.de-Robot" => ""
    ),
    "uri" => "http://www.jobs.de/"
  ),
  "jpluck" => array(
    "icon" => "robot",
    "title" => "Jpluck",
    "rule" => array(
      "JPluck[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "jxta" => array(
    "icon" => "robot",
    "title" => "Jxta",
    "rule" => array(
      "falcon[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "jyte" => array(
    "icon" => "jyte",
    "title" => "Jyte",
    "rule" => array(
      "jyte_fetcher[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "jyxo" => array(
    "icon" => "jyxo",
    "title" => "Jyxo",
    "rule" => array(
      "Jyxobot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "kalooga" => array(
    "icon" => "kalooga",
    "title" => "Kalooga",
    "rule" => array(
      "kalooga[ /-]([0-9.]{1,10})" => "\\1",
      "^kalooga" => "",
      "KaloogaBot" => ""
    ),
    "uri" => "http://www.kalooga.com"
  ),
  "keywen" => array(
    "icon" => "keywen",
    "title" => "Keywen",
    "rule" => array(
      "EasyDL[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "kilomonkey" => array(
    "icon" => "robot",
    "title" => "Kilomonkey",
    "rule" => array(
      "kmky-not-a-bot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.kilomonkey.com/notabot.txt"
  ),
  "kinja" => array(
    "icon" => "kinja",
    "title" => "Kinja",
    "rule" => array(
      "kinjabot[ /]([0-9.]{1,10})" => "\\1",
      "^kinjabot" => ""
    )
  ),
  "lachesis" => array(
    "icon" => "robot",
    "title" => "Lachesis",
    "rule" => array(
      "lachesis" => ""
    )
  ),
  "lanshan" => array(
    "icon" => "robot",
    "title" => "Lachesis",
    "rule" => array(
      "lanshanbot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "lapozz" => array(
    "icon" => "lapozz",
    "title" => "Lapozz",
    "rule" => array(
      "LapozzBot[/ ]?([0-9.]{1,10})" => "\\1"
    )
  ),
  "larbin" => array(
    "icon" => "robot",
    "title" => "Larbin",
    "rule" => array(
      "larbin[_/ ]?([0-9.]{1,10})" => "\\1"
    )
  ),
  "laurion" => array(
    "icon" => "robot",
    "title" => "Laurion",
    "rule" => array(
      "^IPiumBot" => ""
    ),
    "uri" => "http://www.laurion.com/"
  ),
  "leechget" => array(
    "icon" => "leechget",
    "title" => "LeechGet",
    "rule" => array(
      "^LeechGet[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "linguaseek" => array(
    "icon" => "linguaseek",
    "title" => "Linguaseek",
    "rule" => array(
      "^LinguaBot[ /]v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.linguaseek.com/"
  ),
  "linguee" => array(
    "icon" => "linguee",
    "title" => "Linguee",
    "rule" => array(
      "^Linguee Bot" => ""
    ),
    "uri" => "http://www.linguee.com/"
  ),
  "linkguard" => array(
    "icon" => "robot",
    "title" => "Linkguard",
    "rule" => array(
      "Linkguard Online[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.linkguard.com/"
  ),
  "linklint" => array(
    "icon" => "linklint",
    "title" => "Linklint",
    "rule" => array(
      "^Linklint[-\-a-z /]*([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.linklint.org/"
  ),
  "linkman" => array(
    "icon" => "linkman",
    "title" => "Linkman",
    "rule" => array(
      "\(compatible; Linkman\)" => ""
    )
  ),
  // Needs to be before linkcheck
  "linkchecker" => array(
    "icon" => "w3c",
    "title" => "W3C Link Checker",
    "rule" => array(
      "^W3C-checklink[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://validator.w3.org/checklink"
  ),
  "linkcheck" => array(
    "icon" => "linkcheck",
    "title" => "Linkcheck",
    "rule" => array(
      "checklink[ /]([0-9.]{1,10})" => "\\1",
      "Link[ \-]?(Chec(k|ker)|Val(et|idator))" => "",
      "Adaxas Spider" => "",
      "Agent-SharewarePlazaFileCheckBot[ /]([0-9.]{1,10})" => "\\1",
//      "NetMechanic V([0-9.]{1,10})" => "\\1",
      "^InfoLink" => "",
      "InternetLinkAgent" => "",
      "; SPENG\)" => "",
      "SharewarePlazaFileCheckBot" => "",
      "fileboost.net" => "",
      "^billbot" => ""
    )
  ),
  "linkru" => array(
    "icon" => "robot",
    "title" => "Link.RU",
    "rule" => array(
      "^Link.RU bot" => ""
    )
  ),
  "linkssql" => array(
    "icon" => "robot",
    "title" => "Links SQL",
    "rule" => array(
      "links sql" => ""
    )
  ),
  "linksweeper" => array(
    "icon" => "robot",
    "title" => "Link Sweeper",
    "rule" => array(
      "LinkSweeper[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "linkwalker" => array(
    "icon" => "robot",
    "title" => "Link Walker",
    "rule" => array(
      "^LinkWalker" => ""
    )
  ),
  "lipperhey" => array(
    "icon" => "lipperhey",
    "title" => "Lipperhey",
    "rule" => array(
      "Lipperhey Spider" => ""
    ),
    "uri" => "http://www.lipperhey.com"
  ),
  "livedoor" => array(
    "icon" => "livedoor",
    "title" => "Livedoor",
    "rule" => array(
      "^Livedoor( SF( - California Crawl)?|Checkers)[ /]" => "",
      "^livedoor" => "",
    )
  ),
  "livejournal" => array(
    "icon" => "livejournal",
    "title" => "Live Journal",
    "rule" => array(
      "^LiveJournal\.com" => ""
    ),
    "uri" => "http://www.livejournal.com"
  ),
  "ljpic" => array(
    "icon" => "ljpic",
    "title" => "ljpic",
    "rule" => array(
      "LjSEEK Picture-Bot[ /]+([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.ljpic.com"
  ),
  "lmspider" => array(
    "icon" => "robot",
    "title" => "Lmspider",
    "rule" => array(
      "^lmspider" => ""
    )
  ),
  "locators" => array(
    "icon" => "robot",
    "title" => "Locaters",
    "rule" => array(
      "^FiNDoBot[/ ]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "look" => array(
    "icon" => "look",
    "title" => "Look",
    "rule" => array(
      "www\.look\.com" => "",
      "Lookbot" => ""
    )
  ),
  "looksmart" => array(
    "icon" => "looksmart",
    "title" => "LookSmart",
    "rule" => array(
      "^Martini" => "",
      "^MantraAgent" => "",
      "FurlBot" => "",
      "looksmart-sv-fw" => ""
    )
  ),
  "loop" => array(
    "icon" => "loop",
    "title" => "LOOP",
    "rule" => array(
      "NetResearchServer[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "lotkyll" => array(
    "icon" => "robot",
    "title" => "Lotkyll",
    "rule" => array(
      "Lotkyll" => ""
    )
  ),
  "lwp" => array(
    "icon" => "robot",
    "title" => "lwp",
    "rule" => array(
      "lwp(-trivial|::simple)[ /]([0-9.]{1,10})" => "\\2"
    )
  ),
  "lycos" => array(
    "icon" => "lycos",
    "title" => "Lycos",
    "rule" => array(
      "Lycos_Spider_" => ""
    )
  ),
  "magpierss" => array(
    "icon" => "rss",
    "title" => "MagpieRSS",
    "rule" => array(
      "MagpieRSS" => ""
    )
  ),
  "mailru" => array(
    "icon" => "mailru",
    "title" => "@mail.ru",
    "rule" => array(
      "^Mail.Ru[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "hhttp://www.mail.ru/"
  ),
  "mailsweeper" => array(
    "icon" => "robot",
    "title" => "Mail Sweeper",
    "rule" => array(
      "Mail[ \-]?Sweeper" => ""
    )
  ),
  "marvin" => array(
    "icon" => "robot",
    "title" => "Marvin",
    "rule" => array(
      "^Marvin" => ""
    )
  ),
  "matkurja" => array(
    "icon" => "matkurja",
    "title" => "Mat'Kurja",
    "rule" => array(
      "Mosad[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "mavicanet" => array(
    "icon" => "mavicanet",
    "title" => "Mavicanet",
    "rule" => array(
      "Mavicanet robot" => ""
    ),
    "uri" => ""
  ),
  "mediater" => array(
    "icon" => "robot",
    "title" => "Mediater",
    "rule" => array (
      "^libwww[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
//TODO: mercator is only used by altavista
  "mercator" => array(
    "icon" => "robot",
    "title" => "Mercator",
    "rule" => array(
      "Mercator" => ""
    )
  ),
  "metacarta" => array(
    "icon" => "robot",
    "title" => "Metacarta",
    "rule" => array(
      "^RRC (crawler_admin@bigfoot.com)" => "",
      "^flunky" => "",
      "^Mozilla.*\(samualt9@bigfoot.com\)$" => ""
    ),
    "uri" => "http://www.metacarta.com"
  ),
  "metager" => array(
    "icon" => "metager",
    "title" => "MetaGer",
    "rule" => array(
      "MetaGer" => ""
    )
  ),
  "metamark" => array(
    "icon" => "robot",
    "title" => "Metamark",
    "rule" => array(
      "^XRL[ /]([0-9.a-z]{1,10})" => "\\1"
    ),
    "uri" => "http://metamark.net"
  ),
  "metamedic" => array(
    "icon" => "metamedic",
    "title" => "MetaMedic",
    "rule" => array(
      "MediBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "mirago" => array(
    "icon" => "mirago",
    "title" => "Mirago",
    "rule" => array(
      "Mirago" => ""
    )
  ),
  "misterwong" => array(
    "icon" => "misterwong",
    "title" => "Mister Wong",
    "rule" => array(
      "Mister Wong-Bot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.mister-wong.de/"
  ),
  "miva" => array(
    "icon" => "miva",
    "title" => "Miva",
    "rule" => array(
      "AlgoFeedback@miva\.com" => ""
    ),
    "uri" => "http://www.miva.com/"
  ),
  "mj12" => array(
    "icon" => "mj12",
    "title" => "Majestic-12",
    "rule" => array(
      "Mj12bot[ /]v?([0-9.]{1,10})" => "\\1",
      "MJ12bot \(mini\)[ /]([0-9.]{1,10})" => "\\1",
    ),
    "uri" => "http://majestic12.co.uk/bot.php"
  ),
  "mlbot" => array(
    "icon" => "robot",
    "title" => "MLBot",
    "rule" => array(
      "^MLBot" => "",
    ),
    "uri" => "http://www.metadatalabs.com/mlbot"
  ),
  "mnogosearch" => array(
    "icon" => "mnogo",
    "title" => "mnoGoSearch",
    "rule" => array(
      "Mnogosearch[ /\-]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.mnogosearch.org/"
  ),
  "mobileok" => array(
    "icon" => "mobileok",
    "title" => "W3C mobileOK",
    "rule" => array(
      "^W3C-mobileOK" => ""
    ),
    "uri" => "http://www.w3.org/2006/07/mobileok-ddc"
  ),
  "mojeekbot" => array(
    "icon" => "robot",
    "title" => "MojeekBot",
    "rule" => array(
      "MojeekBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "momspider" => array(
    "icon" => "robot",
    "title" => "MOM Spider",
    "rule" => array(
      "MOMspider[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "moreover" => array(
    "icon" => "moreover",
    "title" => "Moreover",
    "rule" => array(
      "^Moreoverbot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "movabletype" => array(
    "icon" => "movabletype",
    "title" => "Movable Type",
    "rule" => array(
      "MovableType[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "mozdex" => array(
    "icon" => "mozdex",
    "title" => "MozDex",
    "rule" => array(
      "mozDex[ /]([0-9.]{1,6}(-dev)?)" => "\\1"
    )
  ),
  "mqbot" => array(
    "icon" => "robot",
    "title" => "MQbot",
    "rule" => array(
      "MQbot" => ""
    )
  ),
  "msnbot" => array(
    "icon" => "bing",
    "title" => "bing",
    "rule" => array(
      "MSN(BOT|PTC)[ /]([0-9.]{1,10})" => "\\2",
      "MS Search ([0-9.]{1,10}) Robot" => "\\1",
      "MSNBOT-(MEDIA|PRODUCTS|NewsBlogs)[ /]([0-9.]{1,10})" => "\\2",
      "bingbot[ /]([0-9.]{1,10})" => "\\1",
    )
  ),
  "msnbot-mobile" => array(
    "icon" => "msn",
    "title" => "MSN Mobile",
    "rule" => array(
      "MSNBOT-(MOBILE|)[ /]([0-9.]{1,10})" => "\\2",
      "MSNBOT_Mobile" => "",
      "MSMOBOT" => ""
    )
  ),
  "mslivebot" => array(
    "icon" => "livesearch",
    "title" => "MS Live",
    "rule" => array(
      "MSNBOT-(Academic)[ /]([0-9.]{1,10})" => "\\2"
    )
  ),
  "msproxy" => array(
    "icon" => "robot",
    "title" => "MSProxy",
    "rule" => array(
      "MSProxy[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "msrbot" => array(
    "icon" => "robot",
    "title" => "MSRBOT",
    "rule" => array(
      "^MSRBOT" => ""
    ),
    "uri" => "http://research.microsoft.com/research/sv/msrbot/"
  ),
  "mswebdav" => array(
    "icon" => "robot",
    "title" => "MS-WebDAV",
    "rule" => array(
      "Microsoft[ \-]?WebDAV[ \-]?MiniRedir" => ""
    )
  ),
  "mticon" => array(
    "icon" => "robot",
    "title" => "MTIcon",
    "rule" => array(
      "MTIcon[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "multipage validator" => array(
    "icon" => "multipage-validator",
    "title" => "Multipage Validator",
    "rule" => array(
      "^W3C_Multipage_Validator[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.validator.ca/"
  ),
  "myrss" => array(
    "icon" => "rss",
    "title" => "MyRSS",
    "rule" => array(
      "MyRSS.jp[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "multimap" => array(
    "icon" => "robot",
    "title" => "Multimap",
    "rule" => array(
      "Multimap Geotag Blog Parser[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "najdi" => array(
    "icon" => "najdi",
    "title" => "Najdi.si",
    "rule" => array(
      "Najdi.si" => ""
    ),
    "uri" => "http://www.najdi.si"
  ),
  "nameprotect" => array(
    "icon" => "nameprotect",
    "title" => "Name Protect",
    "rule" => array(
      "NPBot" => ""
    )
  ),
  "nationaldirectory" => array(
    "icon" => "robot",
    "title" => "National Directory",
    "rule" => array(
      "NationalDirectory-WebSpider[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "natsumican" => array(
    "icon" => "robot",
    "title" => "Natsu Mican",
    "rule" => array(
      "NATSU[ \-]MICAN[/ ]([0-9a-z.]{1,10})" => "\\1",
    )
  ),
  "naverbot" => array(
    "icon" => "naverbot",
    "title" => "Naver",
    "rule" => array(
      "NaverBot([_\-]dloader)?[/ \-]([0-9.]{1,10})" => "\\2",
      "Naver(Bot)?" => "",
      "^nabot" => ""
    )
  ),
  "navisso" => array(
    "icon" => "navisso",
    "title" => "Navisso",
    "rule" => array(
      "Navisso(Bot)?" => ""
    ),
    "uri" => "http://www.navisso.com"
  ),
  "neofonie" => array(
    "icon" => "robot",
    "title" => "neofonie",
    "rule" => array(
      "www.neofonie.de" => ""
    ),
    "uri" => "http://www.neofonie.de/loesungen/search/robot.html"
  ),
  "neomo" => array(
    "icon" => "robot",
    "title" => "Neomo",
    "rule" => array(
      "Francis[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "nessus" => array(
    "icon" => "nessus",
    "title" => "Nessus",
    "rule" => array(
      "Nessus\)$" => ""
    )
  ),
  "netants" => array(
    "icon" => "netants",
    "title" => "NetAnts",
    "rule" => array(
      "NetAnts[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "netcraft" => array(
    "icon" => "netcraft",
    "title" => "Netcraft",
    "rule" => array(
      "netcraft" => ""
    )
  ),
  "netinfo" => array(
    "icon" => "netinfo",
    "title" => "Netinfo",
    "rule" => array(
      "^NetinfoBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://netinfo.bg/"
  ),
  "netluchs" => array(
    "icon" => "netluchs",
    "title" => "Netluchs",
    "rule" => array(
      "Netluchs[ /]([0-9.a-z]{1,10})" => "\\1"
    ),
    "uri" => "http://www.netluchs.de/"
  ),
  "netmechanic" => array(
    "icon" => "netmechanic",
    "title" => "NetMechanic",
    "rule" => array(
      "NetMechanic[ /V]{1,5}([0-9.]{1,10})" => "\\1"
    )
  ),
  "netnose" => array(
    "icon" => "netnose",
    "title" => "NetNose",
    "rule" => array(
      "NetNose[ \-]Crawler[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "netoskop" => array(
    "icon" => "robot",
    "title" => "Netoskop",
    "rule" => array(
      "netoskop" => ""
    )
  ),
  "netpromoter" => array(
    "icon" => "netpromoter",
    "title" => "NetPromoter",
    "rule" => array(
      "NetPromoter Spider" => ""
    ),
    "uri" => "http://www.net-promoter.com/"
  ),
  "netprospector" => array(
    "icon" => "robot",
    "title" => "Netprospector",
    "rule" => array(
      "^netprospector" => ""
    )
  ),
  "netpumper" => array(
    "icon" => "robot",
    "title" => "Netpumper",
    "rule" => array(
      "^NetPumper[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "netscapeproxy" => array(
    "icon" => "netscape",
    "title" => "Netscape Proxy",
    "rule" => array(
      "Netscape-Proxy[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "netspective" => array(
    "icon" => "robot",
    "title" => "NetSpective",
    "rule" => array(
      "^WebFilter Robot ([0-9.]{1,10})" => "\\1"
    )
  ),
  "netvibes" => array(
    "icon" => "netvibes",
    "title" => " Netvibes",
    "rule" => array(
      "^Netvibes" => "\\1"
    )
  ),
  "newsfire" => array(
    "icon" => "newsfire",
    "title" => "NewsFire",
    "rule" => array(
      "NewsFire[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "newsgator" => array(
    "icon" => "newsgator",
    "title" => "NewsGator",
    "rule" => array(
      "NewsGato(r|rOnline)[/ ]([0-9.]{1,10})" => "\\2"
    )
  ),
  "newzcrawler" => array(
    "icon" => "newzcrawler",
    "title" => "NewzCrawler",
    "rule" => array(
      "NewzCrawler[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "nextopia" => array(
    "icon" => "newzcrawler",
    "title" => "NewzCrawler",
    "rule" => array(
      "^NextopiaBOT.*[v ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "ngsearch" => array(
    "icon" => "ngsearch",
    "title" => "NG Search",
    "rule" => array(
      "NG-Search[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "nimble" => array(
    "icon" => "robot",
    "title" => "Nimble",
    "rule" => array(
      "NimbleCrawler[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "nusearch" => array(
    "icon" => "robot",
    "title" => "NuSearch",
    "rule" => array(
      "^nuSearch" => ""
    ),
    "uri" => "http://www.nusearch.com/"
  ),
  "noago" => array(
    "icon" => "noago",
    "title" => "Noago",
    "rule" => array(
      "Noago Spider" => ""
    ),
    "uri" => "http://www.noago.com/"
  ),
  "noviforum" => array(
    "icon" => "noviforum",
    "title" => "Noviforum",
    "rule" => array(
      "TridentSpider[/ ]?([0-9.]{1,10})" => "\\1"
    )
  ),
  "noxtrum" => array(
    "icon" => "noxtrum",
    "title" => "noXtrum",
    "rule" => array(
      "noxtrumbot[/ ]?([0-9.]{1,10})" => "\\1"
    )
  ),
  "noyona" => array(
    "icon" => "robot",
    "title" => "Noyona",
    "rule" => array(
      "noyona.([0-9._]{1,10})" => "\\1"
    ),
    "uri" => "http://noyona.com/"
  ),
  "nsauditor" => array(
    "icon" => "nsauditor",
    "title" => "Nsauditor",
    "rule" => array(
      "Nsauditor[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.nsauditor.com/"
  ),
  "obidosbot" => array(
    "icon" => "robot",
    "title" => "Bookwatch",
    "rule" => array(
      "obidos[ \-]?bot" => ""
    )
  ),
  "objectssearch" => array(
    "icon" => "robot",
    "title" => "Objects Search",
    "rule" => array(
      "ObjectsSearch[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "obot" => array(
    "icon" => "obot",
    "title" => "oBot",
    "rule" => array(
      "^oBot " => ""
    ),
    "uri" => "http://www.onlysolutions.de/"
  ),
  "octora" => array(
    "icon" => "octora",
    "title" => "Octora",
    "rule" => array(
      "^Octora (Beta)?" => ""
    ),
    "uri" => "http://www.octora.com/"
  ),
  "offlineexplorer" => array(
    "icon" => "robot",
    "title" => "OfflineExplorer",
    "rule" => array(
      "^Offline Explorer[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "omea" => array(
    "icon" => "omea",
    "title" => "Omea Reader",
    "rule" => array(
      "Omea Reader[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "onet" => array(
    "icon" => "onet",
    "title" => "Onet",
    "rule" => array(
      "OnetSzukaj[ /]([0-9.]{1,10})" => "\\1",
      "Onet\.pl" => "",
      "inktomi.search.onet" => ""
    ),
    "uri" => "http://www.onet.pl"
  ),
  "online24" => array(
    "icon" => "robot",
    "title" => "online24",
    "rule" => array(
      "^Online24-Bot .* ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.online24.de"
  ),
  "onlinewebcheck" => array(
    "icon" => "csehtmlvalidator",
    "title" => "CSE HTML Validator",
    "rule" => array(
      "onlinewebcheck" => ""
    ),
    "uri" => "http://www.onlinewebcheck.com"
  ),
  "onsearch" => array(
    "icon" => "onsearch",
    "title" => "onsearch",
    "rule" => array(
      "^onCHECK-Robot" => ""
    ),
    "uri" => "http://www.onsearch.de"
  ),
  "onto" => array(
    "icon" => "robot",
    "title" => "OntoSpider",
    "rule" => array(
      "^OntoSpider[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://ontospider.i-n.info/"
  ),
  "openacoon" => array(
    "icon" => "robot",
    "title" => "OpenAcoon",
    "rule" => array(
      "^OpenAcoon v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.openacoon.de/"
  ),
  "openfind" => array(
    "icon" => "openfind",
    "title" => "Openfind",
    "rule" => array(
      "openbot[ /]([0-9.]{1,10})" => "\\1",
      "Openfind Robot[ /]([0-9.A-Z]{1,10})" => "\\1"
    )
  ),
  "opentagger" => array(
    "icon" => "robot",
    "title" => "OpenTagger",
    "rule" => array(
      "^OpenTaggerBot" => ""
    ),
    "uri" => "http://www.opentagger.com/opentaggerbot.htm"
  ),
  "opentext" => array(
    "icon" => "opentext",
    "title" => "OpenText",
    "rule" => array(
      "^OpenTextSiteCrawler[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.opentext.net/"
  ),
  "openweb" => array(
    "icon" => "robot",
    "title" => "OpenWebSpider",
    "rule" => array(
      "^OpenWebSpider[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.openwebspider.org"
  ),
  "openx" => array(
    "icon" => "openx",
    "title" => "OpenX Spider",
    "rule" => array(
      "OpenX" => ""
    ),
    "uri" => "http://www.openx.org"
  ),
  "orange" => array(
    "icon" => "orange",
    "title" => "Orange",
    "rule" => array(
      "OrangeBot-Mobile[ /]([0-9.]{1,10})" => "\\1",
      "OrangeBot-Mobile" => ""
    ),
    "uri" => "http://orange.com/"
  ),
  "organica" => array(
    "icon" => "robot",
    "title" => "Organica",
    "rule" => array(
      "crawler@organica\.us" => ""
    )
  ),
  "outfox" => array(
    "icon" => "robot",
    "title" => "Outfox Melon",
    "rule" => array(
      "OutfoxMelonBot[ /]([0-9.]{1,10})" => "\\1",
      "OutfoxBot[ /]([0-9.]{1,10})" => "\\1",
    ),
    "uri" => ""
  ),
  "overture" => array(
    "icon" => "overture",
    "title" => "Overture",
    "rule" => array(
      "Overture[ \-]?WebCrawler" => ""
    )
  ),
  "page2rss" => array(
    "icon" => "page2rss",
    "title" => "Page2RSS",
    "rule" => array(
      "Page2RSS[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://page2rss.com"
  ),
  "pagebytes" => array(
    "icon" => "robot",
    "title" => "PageBites",
    "rule" => array(
      "^PageBitesHyperBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "pagesjaunes" => array(
    "icon" => "pagesjaunes",
    "title" => "Pages Jaunes",
    "rule" => array(
      "PJBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.pagesjaunes.fr/"
  ),
  "page valet" => array(
    "icon" => "wdg",
    "title" => "WDG Page Valet",
    "rule" => array(
      "^Page Valet[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.htmlhelp.com/tools/validator/"
  ),
  "panopeabot" => array(
    "icon" => "robot",
    "title" => "PanopeaBot",
    "rule" => array(
      "PanopeaBot[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "parchmenthill" => array(
    "icon" => "robot",
    "title" => "Parchment Hill",
    "rule" => array(
      "ParchBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.parchmenthill.com/search.htm"
  ),
  "peerbot" => array(
    "icon" => "peerbot",
    "title" => "Peerbot",
    "rule" => array(
      "^PEERbot" => ""
    )
  ),
  "php" => array(
    "icon" => "php",
    "title" => "PHP",
    "rule" => array(
      "^PHP[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "phpcrawl" => array(
    "icon" => "robot",
    "title" => "PHPCrawl",
    "rule" => array(
      "^PHPCrawl" => ""
    ),
    "uri" => "http://phpcrawl.cuab.de/"
  ),
  "phpdig" => array(
    "icon" => "robot",
    "title" => "PhpDig",
    "rule" => array(
      "^PhpDig[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.finbot.com/"
  ),
  "phpversiontracker" => array(
    "icon" => "phpversiontracker",
    "title" => "PHP version tracker",
    "rule" => array(
      "^PHP version tracker" => ""
    ),
    "uri" => "http://www.nexen.net/phpversion/bot.php"
  ),
  "pictureofinternet" => array(
    "icon" => "robot",
    "title" => "PictureOfInternet",
    "rule" => array(
      "^PictureOfInternet[ /]([0-9.]{1,10})" => ""
    )
  ),
  "pingdom" => array(
    "icon" => "pingdom",
    "title" => "Pingdom",
    "rule" => array(
      "^Pingdom GIGRIB v([0-9.]{1,10})" => "\\1",
      "^Pingdom GIGRIB" => ""
    ),
    "uri" => "http://www.pingdom.com/"
  ),
  "pinseri" => array(
    "icon" => "pinseri",
    "title" => "Pinseri",
    "rule" => array(
      "www\.pinseri\.com/bloglist" => ""
    )
  ),
  "plagger" => array(
    "icon" => "plagger",
    "title" => "Plagger",
    "rule" => array(
      "Plagger[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.plugger.org"
  ),
  "planet" => array(
    "icon" => "planet",
    "title" => "Planet",
    "rule" => array(
      "Planet[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "plantynet" => array(
    "icon" => "robot",
    "title" => "PlantyNet",
    "rule" => array(
      "PlantyNet_WebRobot[_ /]V?([0-9.]{1,10})" => "\\1"
    )
  ),
  "pluck" => array(
    "icon" => "pluck",
    "title" => "Pluck",
    "rule" => array(
      "PluckFeedCrawler[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "plsearch" => array(
    "icon" => "plsearch",
    "title" => "PlanetSearch",
    "rule" => array(
      "fido[ /]([0-9.]{1,10}) Harvest" => "\\1"
    )
  ),
  "poe" => array(
    "icon" => "robot",
    "title" => "POE-Component",
    "rule" => array(
      "^POE-Component-Client-HTTP[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "pogodak" => array(
    "icon" => "pogodak",
    "title" => "Pogodak",
    "rule" => array(
      "Pogodak\.hr[/ ]?([0-9.]{1,10})" => "\\1"
    )
  ),
  "poodle" => array(
    "icon" => "robot",
    "title" => "Poodle predictor",
    "rule" => array(
      "P(oo|ooo)dle[ \-]?predictor[ \-]?([0-9.]{1,10})" => "\\1",
      "P(oo|ooo)dle[ \-]?predictor" => ""
    ),
    "uri" => "http://www.gritechnologies.com/tools/spider.go"
  ),
  "pompos" => array(
    "icon" => "pompos",
    "title" => "Pompos",
    "rule" => array(
      "Pompos[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "popdex" => array(
    "icon" => "robot",
    "title" => "Popdexter",
    "rule" => array(
      "Popdexter" => ""
    )
  ),
  "postrank" => array(
    "icon" => "robot",
    "title" => "PostRank",
    "rule" => array(
      "^PostRank[ /]+([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.postrank.com/"
  ),
  "powermarks" => array(
    "icon" => "robot",
    "title" => "Powermarks",
    "rule" => array(
      "Powermarks[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "probe" => array(
    "icon" => "robot",
    "title" => "PROBE!",
    "rule" => array(
      "^PROBE!" => ""
    )
  ),
  "projecthoneypot" => array(
    "icon" => "projecthoneypot",
    "title" => "Project Honeypot",
    "rule" => array(
      "^PHPot Verispider[ /v]+([0-9.]{1,10})" => "\\1",
      "projecthoneypot" => ""
    ),
    "uri" => "http://www.projecthoneypot.org"
  ),
  /*
  "proxycache" => array(
    "icon" => "robot",
    "title" => "Proxy Cache",
    "rule" => array(
      "^Mozilla/[0-9.]{1,10} \(compatible\;\)$" => ""
    )
  ),
  */
  "proxyhunter" => array(
    "icon" => "robot",
    "title" => "ProxyHunter",
    "rule" => array(
      "ProxyHunter" => ""
    )
  ),
  "psbot" => array(
    "icon" => "picsearch",
    "title" => "PicSearch",
    "rule" => array(
      "^psbot" => ""
    )
  ),
  "pubsub" => array(
    "icon" => "pubsub",
    "title" => "PubSub",
    "rule" => array(
      "^PubSub-RSS-Reader[ /]([0-9.]{1,10})" => "\\1",
      "^PubSub\.com" => ""
      )
  ),
  "pukiwiki" => array(
    "icon" => "pukiwiki",
    "title" => "PukiWiki",
    "rule" => array(
      "PukiWiki[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "pwebotxy" => array(
    "icon" => "pwebotxy",
    "title" => "PWeBot/X.Y",
    "rule" => array(
      "^PWeBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.programacionweb.net/robot.php"
  ),
  "pxys" => array(
    "icon" => "robot",
    "title" => "PXYS",
    "rule" => array(
      "^pxys" => ""
    )
  ),
  "qango" => array(
    "icon" => "qango",
    "title" => "Qango",
    "rule" => array(
      "^Qango.com" => ""
    ),
    "uri" => "http://www.quango.com/"
  ),
  "qihoo" => array(
    "icon" => "qihoo",
    "title" => "Qihoo",
    "rule" => array(
      "QihooBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.qihoo.com/"
  ),
  "quantcast" => array(
    "icon" => "robot",
    "title" => "Quantcast",
    "rule" => array(
      "Quantcastbot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.quantcast.com/"
  ),
  "quepasa" => array(
    "icon" => "quepasa",
    "title" => "Quepasa",
    "rule" => array(
      "Quepasa[ \-]?Creep" => ""
    )
  ),
  "questfinder" => array(
    "icon" => "robot",
    "title" => "QuestFinder",
    "rule" => array(
      "www\.questfinder\.com" => ""
    )
  ),
  "qweery" => array(
    "icon" => "robot",
    "title" => "Qweery",
    "rule" => array(
      "^QweeryBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://qweerybot.qweery.nl"
  ),
  "racaicrawler" => array(
    "icon" => "robot",
    "title" => "RacaiCrawler",
    "rule" => array(
      "RacaiCrawler[ -]([0-9.]{1,10})" => "\\1"
    )
  ),
  "radian6" => array(
    "icon" => "robot",
    "title" => "Radian6",
    "rule" => array(
      "www\.radian6\.com" => ""
    ),
    "uri" => "http://www.radian6.com"
  ),
  "rambler" => array(
    "icon" => "rambler",
    "title" => "Rambler",
    "rule" => array(
      "StackRambler[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "ramiba" => array(
    "icon" => "robot",
    "title" => "ramiba",
    "rule" => array(
      "^ramiba(-bot)?" => "\\1"
    )
  ),
  "rediff" => array(
    "icon" => "rediff",
    "title" => "rediff",
    "rule" => array(
      "^RedBot/redbot[ /\-]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.rediff.com",
  ),
  "repia" => array(
    "icon" => "robot",
    "title" => "Repia",
    "rule" => array(
      "webmaster@repia\.com" => ""
    )
  ),
  "robotgenius" => array(
    "icon" => "robot",
    "title" => "Robot Genius",
    "rule" => array(
      "^robotgenius" => ""
    ),
    "uri" => "http://robotgenius.net",
  ),
  "robozilla" => array(
    "icon" => "robot",
    "title" => "Robozilla",
    "rule" => array(
      "Robozilla" => ""
    )
  ),
  "rojo" => array(
    "icon" => "rojo",
    "title" => "Rojo",
    "rule" => array(
      "Rojo[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "rss-atom" => array(//ajout prad
    "icon" => "rss",
    "title" => "Apple RSS",
    "rule" => array(
      "^Apple-PubSub" => "",
      "^AppleSyndication" => ""
    )
  ),
  "rssbot" => array(
    "icon" => "rss",
    "title" => "rss-bot",
    "rule" => array(
      "rss-bot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "rssbandit" => array(
    "icon" => "rssbandit",
    "title" => "RssBandit",
    "rule" => array(
      "RssBandit[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "rssimages" => array(
    "icon" => "rss",
    "title" => "rssImages",
    "rule" => array(
      "rssImagesBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "rssmicro" => array(
    "icon" => "rssmicro",
    "title" => "RSSMicro",
    "rule" => array(
      "RSSMicro\.com" => ""
    ),
    "uri" => "http://www.rssmicro.com"
  ),
  "rssowl" => array(
    "icon" => "rssowl",
    "title" => "RSSOwl",
    "rule" => array(
      "RSSOwl[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "rssreader" => array(
    "icon" => "rss",
    "title" => "RssReader",
    "rule" => array(
      "RssReader[ /]([0-9.]{1,10})" => ""
    )
  ),
  "rtgi" => array(
    "icon" => "rtgi",
    "title" => "rtgi",
    "rule" => array(
      "RTGI" => ""
    ),
    "uri" => "http://rtgi.fr/"
  ),
  "rufusbot" => array(
    "icon" => "robot",
    "title" => "RufusBot",
    "rule" => array(
      "RufusBot" => ""
    )
  ),
  "runnk" => array(
    "icon" => "robot",
    "title" => "Runnk",
    "rule" => array(
      "Runnk RSS finder" => ""
    ),
    "uri" => "http://www.runnk.com/il/law"
  ),
  "sagool" => array(
    "icon" => "robot",
    "title" => "Sagool",
    "rule" => array(
      "MaSagool" => ""
    ),
    "uri" => "http://sagool.jp/"
  ),
  "sanszbot" => array(
    "icon" => "robot",
    "title" => "Sansz",
    "rule" => array(
      "SanszBot" => ""
    ),
    "uri" => ""
  ),
  "saucereader" => array(
    "icon" => "saucereader",
    "title" => "Sauce Reader",
    "rule" => array(
      "Sauce[ ]?Reader[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "sbider" => array(
    "icon" => "sbider",
    "title" => "SBIder",
    "rule" => array(
    "SBIder[/ ]([0-9.]{1,10})" => "\\1",
    "SBIder[/ ]SBIder.([0-9.]{1,10})" => "\\1"
    )
  ),
  "scirus" => array(
    "icon" => "robot",
    "title" => "Scirus",
    "rule" => array(
    "FAST-WebCrawler/[0-9a-z.]{1,10}/Scirus" => ""
    )
  ),
  "scoutjet" => array(
    "icon" => "scoutjet",
    "title" => "ScoutJet",
    "rule" => array(
      "ScoutJet" => ""
    ),
    "uri" => "http://www.scoutjet.com/"
  ),
  "scrubby" => array(
    "icon" => "scrubby",
    "title" => "Scrubby",
    "rule" => array(
      "Scrubby[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "sdm" => array(
    "icon" => "sdm",
    "title" => "SUN Download Manager",
    "rule" => array(
      "Sun Download Manager[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "sealinks" => array(
    "icon" => "robot",
    "title" => "Sea Links",
    "rule" => array(
    "SEA-Links( HTML-Scanner Pingoo\!)?[ /]([0-9.]{1,10})" => "\\2"
    )
  ),
  "search2" => array(
    "icon" => "search2",
    "title" => "Search2.net",
    "rule" => array(
      "^S2Bot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://search2.net/"
  ),
  "searchbot" => array(
    "icon" => "robot",
    "title" => "Searchbot",
    "rule" => array(
      "Searchbot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "searchch" => array(
    "icon" => "robot",
    "title" => "Search.ch",
    "rule" => array(
      "search\.ch[ /]?V?([0-9.]{1,10})" => "\\1"
    )
  ),
  "searchengineworld" => array(
    "icon" => "robot",
    "title" => "SearchEngineWorld",
    "rule" => array(
      "searchengineworld" => ""
    ),
    "uri" => "http://www.searchengineworld.com/"
  ),
  "searchhippo" => array(
    "icon" => "searchhippo",
    "title" => "Searchhippo",
    "rule" => array(
      "searchhippo" => ""
    ),
    "uri" => "http://www.searchhippo.com/"
  ),
  "searchthruus" => array(
    "icon" => "robot",
    "title" => "SearchThruUs",
    "rule" => array(
      "www\.unitek-systems\.co\.uk[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "securecomputing" => array(
    "icon" => "robot",
    "title" => "Secure Computing",
    "rule" => array(
      "securecomputing" => ""
    )
  ),
  "seekport" => array(
    "icon" => "seekport",
    "title" => "Seekport",
    "rule" => array(
      "Seekbot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "semanticdiscovery" => array(
    "icon" => "robot",
    "title" => "Semantic Discovery",
    "rule" => array(
      "semanticdiscovery[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "sensis" => array(
    "icon" => "sensis",
    "title" => "Sensis",
    "rule" => array(
      "^Sensis(.com.au)? Web Crawler" => ""
    ),
    "uri" => "http://sensis.com.au"
  ),
  "setooz" => array(
    "icon" => "setooz",
    "title" => "Setooz",
    "rule" => array(
      "OOZBOT[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.setooz.com/oozbot.html"
  ),
  "seznam" => array(
    "icon" => "seznam",
    "title" => "Seznam",
    "rule" => array(
      "SeznamBot[ /]([0-9.]{1,10})" => "\\1",
      "Seznam" => ""
    ),
    "uri" => "http://www.seznam.cz/"
  ),
  "sharpreader" => array(
    "icon" => "sharpreader",
    "title" => "SharpReader",
    "rule" => array(
      "SharpReader[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "shelob" => array(
    "icon" => "shelob",
    "title" => "Sherlock Spider",
    "rule" => array(
      "^Shelob" => ""
    ),
    "uri" => "http://www.gmx.net"
  ),
  "sherlockspider" => array(
    "icon" => "robot",
    "title" => "Sherlock Spider",
    "rule" => array(
      "sherlock_spider" => ""
    )
  ),
  "shim" => array(
    "icon" => "robot",
    "title" => "Shim Crawler",
    "rule" => array(
      "shim[ \-]crawler" => ""
    )
  ),
  "shopwiki" => array(
    "icon" => "shopwiki",
    "title" => "ShopWiki",
    "rule" => array(
      "^ShopWiki[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "shoula" => array(
    "icon" => "robot",
    "title" => "Shoula",
    "rule" => array(
      "^Shoula.com Crawler ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.shoula.com"
  ),
  "siege" => array(
    "icon" => "robot",
    "title" => "Siege",
    "rule" => array(
      "Siege[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "siets" => array(
    "icon" => "robot",
    "title" => "Siets",
    "rule" => array(
      "SietsCrawler[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "simpy" => array(
    "icon" => "simpy",
    "title" => "Simpy",
    "rule" => array(
      "^(argus|simpy)[ /]([0-9.]{1,10})" => "\\2",
    )
  ),
  "singingfish" => array(
    "icon" => "singingfish",
    "title" => "SingingFish",
    "rule" => array(
      "asterias[ /]([0-9.]{1,10})" => "\\1",
      "Asterias Crawler v([0-9.]{1,10})" => "\\1",
      "asterias" => ""
    )
  ),
  "sirketce" => array(
    "icon" => "robot",
    "title" => "Sirketce",
    "rule" => array(
      "Sirketcebot[ /v]+([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sirketce.com/bot.html"
  ),
  "sirobot" => array(
    "icon" => "robot",
    "title" => "SiroBot",
    "rule" => array(
      "sirobot" => ""
    )
  ),
  "sitebar" => array(
    "icon" => "sitebar",
    "title" => "SiteBar",
    "rule" => array(
      "SiteBar[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "sitesell" => array(
    "icon" => "sitesell",
    "title" => "SiteSell",
    "rule" => array(
      "SBIder[/ ]([0-9a-z.\-]{1,10})" => "\\1"
    )
  ),
  "sitespider" => array(
    "icon" => "robot",
    "title" => "SiteSpider",
    "rule" => array(
      "^SiteSpider" => ""
    )
  ),
  "sitesucker" => array(
    "icon" => "sitesucker",
    "title" => "SiteSucker",
    "rule" => array(
      "Sitesucker[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sitesucker.us/"
  ),
  "sitidi" => array(
    "icon" => "robot",
    "title" => "SitiDi",
    "rule" => array(
      "SitiDiBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "skaffe" => array(
    "icon" => "robot",
    "title" => "Skaffe",
    "rule" => array(
      "Skampy[ /]([0-9.\-]{1,10})" => "\\1"
    ),
    "uri" => "http://www.skaffe.com"
  ),
  "skizzle" => array(
    "icon" => "skizzle",
    "title" => "Skizzle",
    "rule" => array(
      "SKIZZLE! Distributed Internet Spider[ /v]+([0-9a-z.\-]{1,10})" => "\\1"
    ),
    "uri" => "http://www.skizzle.com"
  ),
  "slugch" => array(
    "icon" => "robot",
    "title" => "slugch",
    "rule" => array(
      "^slug\.ch crawl ([0-9a-z.\-]{1,10})" => "\\1"
    )
  ),
  "smartware" => array(
    "icon" => "robot",
    "title" => "SmartWareSoft",
    "rule" => array(
      "^SWSBot-Images[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.smartwaresoft.com/swsbot12.html"
  ),
  "snookit" => array(
    "icon" => "snookit",
    "title" => "Snookit",
    "rule" => array(
      "^snookit" => ""
    ),
    "uri" => "http://www.snookit.com/"
  ),
  "snoopy" => array(
    "icon" => "robot",
    "title" => "Snoopy",
    "rule" => array(
      "^Snoopy.+([0-9.]{1,10})" => "\\1",
      "sna-([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://snoopy.sourceforge.net/"
  ),
  "snyke" => array(
    "icon" => "robot",
    "title" => "Snyke",
    "rule" => array(
      "^SnykeBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.snyke.com"
  ),
  "slider" => array(
    "icon" => "robot",
    "title" => "Slider",
    "rule" => array(
      "^Slider[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "socialmention" => array(
    "icon" => "robot",
    "title" => "Social Mention",
    "rule" => array(
      "Social Mention[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://socialmention.com"
  ),
  "soegning" => array(
    "icon" => "soegning",
    "title" => "S&oslash;gning",
    "rule" => array(
      "soegning\.dk[/ ]spider[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "somewhere" => array(
    "icon" => "robot",
    "title" => "somewhere.com",
    "rule" => array(
      "Mozilla\@somewhere\.com" => "\\1"
    ),
    "uri" => "http://www.somewhere.com/"
  ),
  "soso" => array(
    "icon" => "soso",
    "title" => "Soso",
    "rule" => array(
      "^Soso(image)?spider" => ""
    ),
    "uri" => "http://help.soso.com/soso-image-spider.htm"
  ),
  "soft411" => array(
    "icon" => "soft411",
    "title" => "Soft411",
    "rule" => array(
      "SOFT411 Directory" => ""
    )
  ),
  "sogou" => array(
    "icon" => "sogou",
    "title" => "Sogou",
    "rule" => array(
      "Sogou web spider[ /]([0-9.]{1,10})" => "\\1",
      "Sogou-Test-Spider[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sogou.com/docs/help/webmasters.htm#07"
  ),
  "sohu" => array(
    "icon" => "robot",
    "title" => "Sohu",
    "rule" => array(
      "sohu[ \-](agent|search)" => ""
    )
  ),
  "sopheus" => array(
    "icon" => "robot",
    "title" => "Sopheus",
    "rule" => array(
      "Sopheus Project[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.thenetplanet.com"
  ),
  "souppot" => array(
    "icon" => "robot",
    "title" => "SoupPot",
    "rule" => array(
      "SoupPotBot" => ""
    )
  ),
  "specificmedia" => array(
    "icon" => "specificmedia",
    "title" => "Specific Media",
    "rule" => array(
      "^SMBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "surphace" => array(
    "icon" => "spherescout",
    "title" => "Surphace",
    "rule" => array(
      "Sphere Scout.+([0-9.]{1,10})" => "\\1",
      "Surphace.+v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.surphace.com/"
  ),
  "spbot" => array(
    "icon" => "robot",
    "title" => "SEOprofiler.com",
    "rule" => array(
      "spbot[ /]([0-9.]{1,10})" => "\\1"
    ),
  ),
  "spinn3r" => array(
    "icon" => "robot",
    "title" => "Spinn3r",
    "rule" => array(
      "Spinn3r[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://spinn3r.com/robot"
  ),
  "sproose" => array(
    "icon" => "robot",
    "title" => "sproose",
    "rule" => array(
      "^sproose[ /]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sproose.com/bot.html"
  ),
  "spurlbot" => array(
    "icon" => "robot",
    "title" => "SpurlBot",
    "rule" => array(
      "SpurlBot[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "stardownloader" => array(
    "icon" => "stardownloader",
    "title" => "Star Downloader",
    "rule" => array(
      "^Star Downloader( Pro)?" => ""
    )
  ),
  "steeler" => array(
    "icon" => "robot",
    "title" => "Steeler",
    "rule" => array(
      "Steeler[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "strategicboard" => array(
    "icon" => "strategicboard",
    "title" => "Strategic Board",
    "rule" => array(
      "Strategic Board Bot" => ""
    ),
    "uri" => "http://www.strategicboard.com"
  ),
  "suchbaer" => array(
    "icon" => "robot",
    "title" => "suchbaer.de",
    "rule" => array(
      "^suchbaer\.de" => ""
    ),
    "uri" => "http://www.suchbaer.de/"
  ),
  "suchbot" => array(
    "icon" => "robot",
    "title" => "suchbot",
    "rule" => array(
      "^suchbot" => ""
    )
  ),
  "suchende" => array(
    "icon" => "suchende",
    "title" => "suchen.de",
    "rule" => array(
      "^gonzo([0-9]{1,2}).*www.suchen.de" => "\\1"
    ),
    "uri" => "http://www.suchen.de/"
  ),
  "suchknecht" => array(
    "icon" => "robot",
    "title" => "Suchknecht",
    "rule" => array(
      "^Suchknecht.at-Robot" => ""
    ),
    "uri" => "http://www.suchknecht.at/"
  ),
  "suchpad" => array(
    "icon" => "robot",
    "title" => "suchpad",
    "rule" => array(
      "^suchpadbot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.suchpad.de"
  ),
  "sunrise" => array(
    "icon" => "sunrise",
    "title" => "Sunrise",
    "rule" => array(
      "^Sunrise[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "superbot" => array(
    "icon" => "superbot",
    "title" => "SuperBot",
    "rule" => array(
      "SuperBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "superfeedr" => array(
    "icon" => "robot",
    "title" => "Superfeedr",
    "rule" => array(
      "^Superfeedr" => ""
    )
  ),
  "surfcontrol" => array(
    "icon" => "robot",
    "title" => "SurfControl",
    "rule" => array(
      "SurfControl" => "",
      "ScSpider[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "surfnet" => array(
    "icon" => "robot",
    "title" => "SURFnet",
    "rule" => array(
      "AVSearch[ \-]([0-9.]{1,10})" => "\\1"
    )
  ),
  "surfsafely" => array(
    "icon" => "robot",
    "title" => "Surfsafely",
    "rule" => array(
      "Submission Spider at surfsafely.com" => ""
    ),
    "uri" => "http://www.surfsafely.com"
  ),
  "surveybot" => array(
    "icon" => "surveybot",
    "title" => "Whois Survey",
    "rule" => array(
      "SurveyBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "swoogle" => array(
    "icon" => "robot",
    "title" => "Swoogle",
    "rule" => array(
      "^Swooglebot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://swoogle.umbc.edu/swooglebot.htm"
  ),
  "swse" => array(
    "icon" => "robot",
    "title" => "SWSE",
    "rule" => array(
      "sw\.deri\.org" => ""
    ),
    "uri" => "http://sw.deri.org/2006/04/multicrawler/robots.html"
  ),
  "swish-e" => array(
    "icon" => "swish-e",
    "title" => "Swish-e",
    "rule" => array(
      "^swish-e" => ""
    ),
    "uri" => "http://swish-e.org/"
  ),
  "sygol" => array(
    "icon" => "sygol",
    "title" => "Sygol",
    "rule" => array(
      "www.sygol.(com|net)" => ""
    ),
    "uri" => "http://www.sygol.com"
  ),
  "synapse" => array(
    "icon" => "robot",
    "title" => "Synapse",
    "rule" => array(
      " Synapse\)" => ""
    ),
    "uri" => "http://ws.apache.org/synapse/"
  ),
  "sync2it" => array(
    "icon" => "robot",
    "title" => "sync2it",
    "rule" => array(
      "^\!Susie" => ""
    ),
    "uri" => "http://www.sync2it.com/bms/susie.php"
  ),
  "syncit" => array(
    "icon" => "robot",
    "title" => "syncit",
    "rule" => array(
      "^SyncIT[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.syncit.com/"
  ),
  "syndic8" => array(
    "icon" => "syndic8",
    "title" => "Syndic8",
    "rule" => array(
      "Syndic8[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.syndic8.com/"
  ),
  "syndicatie" => array(
    "icon" => "robot",
    "title" => "Syndicatie.nl",
    "rule" => array(
      "Syndicatie\.nl robot v ([0-9.]{1,10})" => "\\1",
      "Syndicatie\.nl robot;" => ""
    )
  ),
  "synomia" => array(
    "icon" => "robot",
    "title" => "Synomia",
    "rule" => array(
      "^SynoBot" => ""
    )
  ),
  "synoo" => array(
    "icon" => "robot",
    "title" => "SynooBot",
    "rule" => array(
      "SynooBot[ /]([0-9.]{1,10})" => "\\1",
    )
  ),
  "szukacz" => array(
    "icon" => "szukacz",
    "title" => "Szukacz",
    "rule" => array(
      "Szukacz[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "tabbloid" => array(
    "icon" => "robot",
    "title" => "Tabbloid",
    "rule" => array(
      "Tabbloid[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://tabbloid.com/"
  ),
  "tagoo" => array(
    "icon" => "tagoobot",
    "title" => "Tagoo",
    "rule" => array(
      "Tagoobot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.tagoo.ru"
  ),
  "tagword" => array(
    "icon" => "tagword",
    "title" => "Tagword",
    "rule" => array(
      "^Tagword" => ""
    ),
    "uri" => "http://tagword.com/dmoz_survey.php"
  ),
  "trailfire" => array(
    "icon" => "trailfire",
    "title" => "Trailfire",
    "rule" => array(
      "^Trailfire-bot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://trailfire.com"
  ),
  "tamu" => array(
    "icon" => "robot",
    "title" => "Tamu Crawler",
    "rule" => array(
      "IRLbot[ /]([0-9.]{1,10})" => "\\1",
      "TAMU_CS_IRL_CRAWLER[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "taptubot" => array(
    "icon" => "taptubot",
    "title" => "Taptu",
    "rule" => array(
      "taptubot" => ""
    ),
    "uri" => "http://www.taptu.com/corp/taptubot"
  ),
  "targetseek" => array(
    "icon" => "robot",
    "title" => "TargetSeek",
    "rule" => array(
      "TargetSeek[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.targetgroups.net/TargetSeek.html"
  ),
  "taw" => array(
    "icon" => "taw",
    "title" => "TAW",
    "rule" => array(
      "TAW[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.tawdis.net"
  ),
  "tcd" => array(
    "icon" => "tcd",
    "title" => "Trinity College Dublin",
    "rule" => array(
      "^TCDBOT/Nutch-([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.tcd.ie"
  ),
  "technorati" => array(
    "icon" => "technorati",
    "title" => "Technorati",
    "rule" => array(
      "Technoratibot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "telehouse" => array(
    "icon" => "telehouse",
    "title" => "Telehouse",
    "rule" => array(
      "Dolphin[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://telehouse.ru/crawler.html"
  ),
  "teleport" => array(
    "icon" => "teleport",
    "title" => "Teleport",
    "rule" => array(
      "Teleport[ \-]?Pro" => ""
    )
  ),
  "terrar" => array(
    "icon" => "robot",
    "title" => "Terrar",
    "rule" => array(
      "^Fresh Search :: Terrar" => ""
    )
  ),
  "theophrastus" => array(
    "icon" => "robot",
    "title" => "Theophrastus",
    "rule" => array(
      "Theophrastus[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://users.cs.cf.ac.uk/N.A.Smith/theophrastus.php"
  ),
  "thumbnailscz" => array(
    "icon" => "robot",
    "title" => "thumbnails.cz",
    "rule" => array(
      "^thumbnail\.cz robot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "thumbshot" => array(
    "icon" => "robot",
    "title" => "thumbshots",
    "rule" => array(
      "^thumbshots.*(Version: |v)([0-9.]{2,10})e" => "\\1",
      "^thumbshots-de" => ""
    ),
    "uri" => "http://www.thumbshots.de"
  ),
  "thunderbird" => array(
    "icon" => "thunderbird",
    "title" => "Thunderbird",
    "rule" => array(
      "Thunderbird[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "thunderstone" => array(
    "icon" => "thunderstone",
    "title" => "Thunderstone",
    "rule" => array(
      "T-H-U-N-D-E-R-S-T-O-N-E" => "",
      "search.thunderstone.com" => ""
    ),
    "uri" => "http://search.thunderstone.com/"
  ),
  "timbobot" => array(
    "icon" => "robot",
    "title" => "timboBot",
    "rule" => array(
      "timboBot" => ""
    )
  ),
  "topicmaster" => array(
    "icon" => "robot",
    "title" => "Topicmaster",
    "rule" => array(
      "^WMCAI-robot" => ""
    ),
    "uri" => "http://www.topicmaster.jp/wmcai/crawler.html"
  ),
  "topsy" => array(
    "icon" => "topsy",
    "title" => "Topsy",
    "rule" => array(
      "Butterfly[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://labs.topsy.com/butterfly.html"
  ),
  "trayce" => array(
    "icon" => "robot",
    "title" => "trayce",
    "rule" => array(
      "traycebot[ /]([0-9a-z.\-]{1,10})" => "\\1"
    )
  ),
  "tricus" => array(
    "icon" => "robot",
    "title" => "Tricus",
    "rule" => array(
      "B_l_i_t_z_B_O_T_@_t_r_i_c_u_s_\._c_o_m" => ""
    )
  ),
  "topicblogs" => array(
    "icon" => "robot",
    "title" => "Topicblogs",
    "rule" => array(
      "topicblogs[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "touche" => array(
    "icon" => "touche",
    "title" => "Touch&eacute;",
    "rule" => array(
      "^Touche" => ""
    ),
    "uri" => "http://touche.com.ve"
  ),
  "tuezilla" => array(
    "icon" => "robot",
    "title" => "T&Uuml;zilla",
    "rule" => array(
      "tuezilla.de" => ""
    ),
    "uri" => "http://tuezilla.de/t_st-odp-entries-agent.html"
  ),
  "tumblr" => array(
    "icon" => "robot",
    "title" => "Tumblr",
    "rule" => array(
      "Tumblr[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "turnitin" => array(
    "icon" => "turnitin",
    "title" => "Turnitin",
    "rule" => array(
      "TurnitinBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "tutorgig" => array(
    "icon" => "robot",
    "title" => "TutorGig",
    "rule" => array(
      "TutorGig(Bot)?[ /]([0-9.]{1,10})" => "\\2"
    )
  ),
  "twiceler" => array(
    "icon" => "cuill",
    "title" => "cuill",
    "rule" => array(
      "Twiceler[ /-]([0-9.]{1,10})" => "\\1",
      "Twiceler" => ""
    ),
    "uri" => "http://www.cuill.com/twiceler/robot.html"
  ),
  "twingly" => array(
    "icon" => "twingly",
    "title" => "Twingly",
    "rule" => array(
      "Twingly Recon" => ""
    ),
    "uri" => "http://www.twingly.com/"
  ),
  "twitterfeed" => array(
    "icon" => "robot",
    "title" => "TwitterFeed",
    "rule" => array(
      "^TwitterFeed" => ""
    )
  ),
  "typepad" => array(
    "icon" => "typepad",
    "title" => "TypePad",
    "rule" => array(
      "TypePad/([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "udmsearch" => array(
    "icon" => "robot",
    "title" => "UdmSearch",
    "rule" => array(
      "UdmSearch[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "ukwizz" => array(
    "icon" => "ukwizz",
    "title" => "UKWizz",
    "rule" => array(
      "^Mackster.*ukwizz" => ""
    ),
    "uri" => "http://www.ukwizz.com"
  ),
  "ultraseek" => array(
    "icon" => "robot",
    "title" => "Ultraseek",
    "rule" => array(
      "Ultraseek" => ""
    )
  ),
  "ultraspider" => array(
    "icon" => "robot",
    "title" => "UltraSpider",
    "rule" => array(
      "UltraSpider3000[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.search.ch"
  ),
  "umai" => array(
    "icon" => "robot",
    "title" => "umai",
    "rule" => array(
      "umai[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "unchaos" => array(
    "icon" => "robot",
    "title" => "Unchaos",
    "rule" => array(
      "unchaos_crawler[_ /]([0-9.]{1,10})" => "\\1",
      "unchaos" => ""
    )
  ),
  "unido" => array(
    "icon" => "robot",
    "title" => "unido",
    "rule" => array(
      "^unido-bot" => "\\1"
    ),
    "uri" => "http://mobicom.cs.uni-dortmund.de/bot.html"
  ),
  "updated" => array(
    "icon" => "robot",
    "title" => "Updated",
    "rule" => array(
      "updated[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "uptimebot" => array(
    "icon" => "robot",
    "title" => "UptimeBot",
    "rule" => array(
      "^UptimeBot" => ""
    ),
    "uri" => "http://www.uptimebot.com/"
  ),
  "urifetch" => array(
    "icon" => "robot",
    "title" => "URI::Fetch",
    "rule" => array(
      "^URI::Fetch[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "urlbase" => array(
    "icon" => "robot",
    "title" => "URLBase",
    "rule" => array(
      "URLBase[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "urlblaze" => array(
    "icon" => "robot",
    "title" => "URLBlaze",
    "rule" => array(
      "^URLBlaze" => ""
    )
  ),
  "urlcontr" => array(
    "icon" => "robot",
    "title" => "MS URL Control",
    "rule" => array(
      "Microsoft URL[ \-]?Control" => ""
    )
  ),
  "urlgetfile" => array(
    "icon" => "robot",
    "title" => "URLGetFile",
    "rule" => array(
      "^URLGetFile" => ""
    )
  ),
  "urlscope" => array(
    "icon" => "robot",
    "title" => "UrlScope",
    "rule" => array(
      "UrlScope" => ""
    )
  ),
  "urltrends" => array(
    "icon" => "urltrends",
    "title" => "urltrends",
    "rule" => array(
      "Snappy/([0-9.]{1,10})" => "\\1",
    )
  ),
  "usww" => array(
    "icon" => "usww",
    "title" => "usww",
    "rule" => array(
      "usww\.com" => "",
      "Mozilla/5\.0 URL-Spider" => ""
    ),
    "uri" => "http://www.usww.com/"
  ),
  "usyd" => array(
    "icon" => "robot",
    "title" => "USyd-NLP-Spider",
    "rule" => array(
      "^USyd-NLP-Spider" => ""
    ),
    "uri" => "http://www.it.usyd.edu.au/~vinci/bot.html"
  ),
  "vagabondo" => array(
    "icon" => "wiseguys",
    "title" => "WiseGuys",
    "rule" => array(
      "Vagabondo[ /]([0-9.]{1,10})" => "\\1",
      "Vagabondo-WAP[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "validator" => array(
    "icon" => "w3c",
    "title" => "W3C Validator",
    "rule" => array(
      "W3C_Validator[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://validator.w3.org/"
  ),
  "validator.nu" => array(
    "icon" => "validatornu",
    "title" => "Validator.nu",
    "rule" => array(
      "^Validator.nu[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://validator.nu/"
  ),
  "verity" => array(
    "icon" => "robot",
    "title" => "Verity",
    "rule" => array(
      "^vspider[ /]([0-9.]{1,10})" => "\\1",
      "^vspider" => ""
    ),
    "uri" => "http://www.verity.com/"
  ),
  "versionsproject" => array(
    "icon" => "robot",
    "title" => "Versions-project",
    "rule" => array(
      "InfoFly[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.versions-project.org/"
  ),
  "verticalmatch" => array(
    "icon" => "robot",
    "title" => "VerticalMatch",
    "rule" => array(
      "^VMBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.VerticalMatch.com/"
  ),
  "verzamelgids" => array(
    "icon" => "validator",
    "title" => "Verzamelgids",
    "rule" => array(
      "Verzamelgids[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.verzamelgids.nl/"
  ),
  "vestris" => array(
    "icon" => "vestris",
    "title" => "Vestris",
    "rule" => array(
      "AlkalineBOT[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://alkaline.vestris.com/"
  ),
  "vindex" => array(
    "icon" => "vindex",
    "title" => "Vindex",
    "rule" => array(
      "Vindex[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "visvo" => array(
    "icon" => "robot",
    "title" => "Visvo",
    "rule" => array(
      "VisBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.visvo.com"
  ),
  "voila" => array(
    "icon" => "voila",
    "title" => "Voila",
    "rule" => array(
      "VoilaBot[ /]?[a-z ]*([0-9.]{1,10})" => "\\1",
      "VoilaBot;[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "vonna" => array(
    "icon" => "robot",
    "title" => "Vonna",
    "rule" => array(
      "Vonna.com b o t" => ""
    )
  ),
  "vortex" => array(
    "icon" => "robot",
    "title" => "Vortex",
    "rule" => array(
      "Vortex[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://marty.anstey.ca/robots/vortex/"
  ),
  "w3sitesearch" => array(
    "icon" => "w3sitesearch",
    "title" => "W3SiteSearch",
    "rule" => array(
      "^W3SiteSearch Crawler[\_v]*([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.w3sitesearch.de"
  ),
  "wagger" => array(
    "icon" => "robot",
    "title" => "Wagger",
    "rule" => array(
      "^Waggr" => ""
    ),
    "uri" => "http://www.waggr.com/"
  ),
  "wanadoo" => array(
    "icon" => "robot",
    "title" => "Wanadoo",
    "rule" => array(
      "^SurferF3[ /]([0-9./]{1,10})" => "\\1"
    ),
    "uri" => "http://www.wanadoo.fr/"
  ),
  "wapalizer" => array(
    "icon" => "robot",
    "title" => "Wapalizer",
    "rule" => array(
      "wapalizer[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.wapdrive.com/"
  ),
  "watson" => array(
    "icon" => "addy",
    "title" => "Dr.Watson",
    "rule" => array(
      "Watson[ /]([0-9.]{1,10})" => "\\1",
      "watson\.addy\.com" => ""
    )
  ),
  "wavefire" => array(
    "icon" => "robot",
    "title" => "Wavefire",
    "rule" => array(
      "^Wavefire[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "waypath" => array(
    "icon" => "waypath",
    "title" => "Waypath",
    "rule" => array(
      "Waypath[ \-]?Scout" => "",
      "Waypath (development )?crawler" => ""
    )
  ),
  "wauuu" => array(
    "icon" => "wauuu",
    "title" => "Wauuu",
    "rule" => array(
      "Wauuu[/ ]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.wauuu.com"
  ),
  "wdg" => array(
    "icon" => "wdg",
    "title" => "WDG Validator",
    "rule" => array(
      "^WDG_(Site)?Validator[/ ]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.htmlhelp.com/tools/validator/"
  ),
  "webagogo" => array(
    "icon" => "webagogo",
    "title" => "Webagogo",
    "rule" => array(
      "^Webagogo" => ""
    ),
    "uri" => "http://www.webagogo.be/"
  ),
  "webelixir" => array(
    "icon" => "webelixir",
    "title" => "Webelixir",
    "rule" => array(
      "^webelixir" => ""
    ),
    "uri" => "http://www.webelixir.net/"
  ),
  "webalta" => array(
    "icon" => "webalta",
    "title" => "WebAlta",
    "rule" => array(
      "^WebAlta( Crawler)?[/ ]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.webalta.net/ru/about_webmaster.html"
  ),
  "webbotru" => array(
    "icon" => "robot",
    "title" => "Webbot.ru",
    "rule" => array(
      " Webbot[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.webbot.ru/bot.html"
  ),
  "webcapture" => array(
    "icon" => "robot",
    "title" => "WebCapture",
    "rule" => array(
      "WebCapture[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webcollage" => array(
    "icon" => "robot",
    "title" => "Webcollage",
    "rule" => array(
      "webcollage" => ""
    )
  ),
  "webcopier" => array(
    "icon" => "webcopier",
    "title" => "WebCopier",
    "rule" => array(
      "WebCopier[/ ]v?([0-9.]{1,10})" => "\\1"
    )
  ),
  "webcorp" => array(
    "icon" => "webcorp",
    "title" => "WebCorp",
    "rule" => array(
      "WebCorp[/ ]+([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.webcorp.org.uk/"
  ),
  "webcrawl" => array(
    "icon" => "robot",
    "title" => "WebCrawl",
    "rule" => array(
      "webcrawl\.net" => ""
    )
  ),
  "webdownloader" => array(
    "icon" => "robot",
    "title" => "Web Downloader",
    "rule" => array(
      "Web Downloader[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webfetch" => array(
    "icon" => "robot",
    "title" => "webfetch",
    "rule" => array(
      "^webfetch[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webfind" => array(
    "icon" => "robot",
    "title" => "Webfind",
    "rule" => array(
      "^WebFindBot" => ""
    ),
    "uri" => "http://www.web-find.com"
  ),
  "webglimpse" => array(
    "icon" => "robot",
    "title" => "Webglimpse",
    "rule" => array(
      "^Webglimpse[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://webglimpse.net"
  ),
  "webgobbler" => array(
    "icon" => "robot",
    "title" => "webGobbler",
    "rule" => array(
      "^webGobbler[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "webimages" => array(
    "icon" => "webimages",
    "title" => "WebImages",
    "rule" => array(
      "^WebImages[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://herbert.groot.jebbink.nl/"
  ),
  "weblight" => array(
    "icon" => "robot",
    "title" => "WebLight",
    "rule" => array(
      "^WebLight[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.illumit.com/Products/weblight/"
  ),
  "weblinks" => array(
    "icon" => "robot",
    "title" => "WebLink's",
    "rule" => array(
      "^Weblink.s checker" => ""
    ),
    "uri" => ""
  ),
  "webmeasurement" => array(
    "icon" => "robot",
    "title" => "Webmeasurement",
    "rule" => array(
      "^webmeasurement-bot" => ""
    ),
    "uri" => "http://rvs.informatik.uni-leipzig.de"
  ),
  "webminer" => array(
    "icon" => "robot",
    "title" => "WebMiner",
    "rule" => array(
      "^WebMiner[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webmin" => array(
    "icon" => "webmin",
    "title" => "Webmin",
    "rule" => array(
      "^webmin" => ""
    )
  ),
  "webmon" => array(
    "icon" => "webmon",
    "title" => "Webmon",
    "rule" => array(
      "WebMon[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.markwell.btinternet.co.uk/webmon/"
  ),
  "webpatrol" => array(
    "icon" => "webpatrol",
    "title" => "WebPatrol",
    "rule" => array(
      "^WebPatrol[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://soft.macfeeling.com/WebPatrol.html"
  ),
  "webpix" => array(
    "icon" => "webpix",
    "title" => "WebPix",
    "rule" => array(
      "WebPix[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webrace" => array(
    "icon" => "robot",
    "title" => "WebRACE",
    "rule" => array(
      "^WebRACE[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webreaper" => array(
    "icon" => "webreaper",
    "title" => "WebReaper",
    "rule" => array(
      "^WebReaper " => ""
    ),
    "uri" => "http://www.webreaper.net/"
  ),
  "webresult" => array(
    "icon" => "robot",
    "title" => "Webresult",
    "rule" => array(
      "Der webresult\.de Robot" => ""
    )
  ),
  "webring" => array(
    "icon" => "robot",
    "title" => "Webring Checker",
    "rule" => array(
      "WebRingChecker[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webox" => array(
    "icon" => "robot",
    "title" => " WeBoX",
    "rule" => array(
      "WeBoX[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "websearchau" => array(
    "icon" => "websearchau",
    "title" => "WebSearch.COM.AU",
    "rule" => array(
      "WebSearch.COM.AU[/ ]+([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://WebSearch.com.au/"
  ),
  "websearchbench" => array(
    "icon" => "robot",
    "title" => "WebSearchBench",
    "rule" => array(
      "WebSearchBench WebCrawler[v/ ]+([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://websearchbench.cs.uni-dortmund.de/"
  ),
  /*
  "websense" => array(
    "icon" => "websense",
    "title" => "Websense",
    "rule" => array(
      "(Sqworm|websense|Konqueror/3\.(0|1)(-rc[1-6])?; i686 Linux; 2002[0-9]{4})" => ""
    ),
    "uri" => ""
  ),
  */
  "websiteworth" => array(
    "icon" => "robot",
    "title" => "WebsiteWorth",
    "rule" => array(
      "WebsiteWorth[v/ ]+([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://directory.sootle.com/website-worth/tata.php"
  ),
  "websquash" => array(
    "icon" => "websquash",
    "title" => "Websquash",
    "rule" => array(
      "webs(quash\.com|ite[ \-]?Monitor)" => ""
    )
  ),
  "webstripper" => array(
    "icon" => "robot",
    "title" => "WebStripper",
    "rule" => array(
      "WebStripper[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "webzip" => array(
    "icon" => "webzip",
    "title" => "WebZIP",
    "rule" => array(
      "Web[ \-]?ZIP[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wep" => array(
    "icon" => "robot",
    "title" => "WEP Search",
    "rule" => array(
      "WEP Search[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "westwind" => array(
    "icon" => "robot",
    "title" => "West Wind Internet Protocols",
    "rule" => array(
      "^West Wind Internet Protocols[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.west-wind.com/wwipstuff.asp"
  ),
  "wget" => array(
    "icon" => "wget",
    "title" => "Wget",
    "rule" => array(
      "Wget[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "whizbang" => array(
    "icon" => "whizbang",
    "title" => "WhizBang",
    "rule" => array(
      "WhizBang" => ""
    ),
    "uri" => "http://www.whizbang.com/crawler/"
  ),
  "wingflyer" => array(
    "icon" => "robot",
    "title" => "WingFlyer",
    "rule" => array(
      "^WebFetch" => ""
    ),
    "uri" => "http://www.wingflyer.com/"
  ),
  "wink" => array(
    "icon" => "robot",
    "title" => "Wink",
    "rule" => array(
      "WinkBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://wink.com/"
  ),
  "wininet" => array(
    "icon" => "robot",
    "title" => "WinInet",
    "rule" => array(
      "TeamSoft WinInet Component" => ""
    ),
    "uri" => "http://www.winsoft.sk/wininet.htm"
  ),
  "winhttp" => array(
    "icon" => "robot",
    "title" => "WinHTTP",
    "rule" => array(
      "WinHttp\.WinHttpRequest\.([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "wire" => array(
    "icon" => "robot",
    "title" => "WIRE",
    "rule" => array(
      "^WIRE[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wmp" => array(
    "icon" => "robot",
    "title" => "WMP",
    "rule" => array(
      "^WMP" => ""
    )
  ),
  "wordchamp" => array(
    "icon" => "robot",
    "title" => "WordChamp",
    "rule" => array(
      "^WordChampBot" => "\\1"
    ),
    "uri" => "http://www.wordchamp.com/"
  ),
  "wordpress" => array(
    "icon" => "wordpress",
    "title" => "WordPress",
    "rule" => array(
      "WordPress[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "worio" => array(
    "icon" => "worio",
    "title" => "Worio",
    "rule" => array(
      "woriobot" => ""
    ),
    "uri" => "http://worio.com/"
  ),
  "worldlight" => array(
    "icon" => "worldlight",
    "title" => "WorldLight",
    "rule" => array(
      "^WorldLight" => ""
    )
  ),
  "worqmada" => array(
    "icon" => "robot",
    "title" => "WorQmada",
    "rule" => array(
        "WorQmada[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wotbox" => array(
    "icon" => "wotbox",
    "title" => "Wotbox",
    "rule" => array(
      "Wotbox[ /]?[a-z]*([0-9.]{1,10})" => "\\1"
    )
  ),
  "wp" => array(
    "icon" => "wp",
    "title" => "Wirtualna Polska",
    "rule" => array(
      "NetSprint[ /\-]{1,4}([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://wp.pl"
  ),
  "wsb" => array(
    "icon" => "robot",
    "title" => "WebSearchBench",
    "rule" => array(
      "WSB WebCrawler V([0-9.]{1,10})" => "\\1",
      "WSB " => ""
    ),
    "uri" => "http://websearchbench.cs.uni-dortmund.de/"
  ),
  "wume" => array(
    "icon" => "robot",
    "title" => "WUME Lab's",
    "rule" => array(
      "^wume_crawler[ /]([0-9.]{1,10})" => "\\1",
    ),
    "uri" => "http://wume.cse.lehigh.edu/~xiq204/crawler/"
  ),
  "wusage" => array(
    "icon" => "wusage",
    "title" => "Wusage",
    "rule" => array(
      "Wusage[ /]([0-9.]{1,10})" => "\\1",
    ),
    "uri" => "http://www.boutell.com/wusage/"
  ),
  "wwgrapevine" => array(
    "icon" => "wwgrapevine",
    "title" => "WWgrapevine",
    "rule" => array(
      "wwgrapevine[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wws" => array(
    "icon" => "robot",
    "title" => "WWSBOT",
    "rule" => array(
      "WWSBOT[ /]([0-9.]{1,10})" => "\\1",
    ),
    "uri" => "http://www.analyzer.nu"
  ),
  "www4mail" => array(
    "icon" => "robot",
    "title" => "www4mail",
    "rule" => array(
      "^www4mail[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.www4mail.org/"
  ),
  "wwwc" => array(
    "icon" => "wwwc",
    "title" => "WWWC",
    "rule" => array(
      "^WWWC[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wwwd" => array(
    "icon" => "robot",
    "title" => "WWWD",
    "rule" => array(
      "^WWWD[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wwweasel" => array(
    "icon" => "wwweasel",
    "title" => "WWWeasel",
    "rule" => array(
      "WWWeasel( Robot)?[/ ]v?([0-9.]{1,10})" => "\\2"
    )
  ),
  "wwwfi" => array(
    "icon" => "wwwfi",
    "title" => "www.fi",
    "rule" => array(
      "www\.fi crawler" => ""
    ),
    "uri" => "http://www.fi/"
  ),
  "wwwmechanize" => array(
    "icon" => "robot",
    "title" => "WWW-Mechanize",
    "rule" => array(
      "^WWW-Mechanize[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wwwoffle" => array(
    "icon" => "robot",
    "title" => "WWWoffle",
    "rule" => array(
      "^wwwoffle[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wwwster" => array(
    "icon" => "robot",
    "title" => "WWWster",
    "rule" => array(
      "^wwwster[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "wysigot" => array(
    "icon" => "wysigot",
    "title" => "Wysigot",
    "rule" => array(
      "Wysigot[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "xaldon" => array(
    "icon" => "xaldon",
    "title" => "Xaldon",
    "rule" => array(
      "Xaldon WebSpider" => ""
    ),
    "uri" => "http://www.xaldon.de/"
  ),
  "xenu" => array(
    "icon" => "xenu",
    "title" => "Xenu Link Sleuth",
    "rule" => array(
      "Xenu Link Sleuth[/ ]([0-9a-z.]{1,10})" => "\\1",
      "Xenu(&#039;s)? Link Sleuth[/ ]([0-9a-z.]{1,10})" => "\\1",
      "Xenu_Link_Sleuth_([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://home.snafu.de/tilman/xenulink.html"
  ),
  "xerka" => array(
    "icon" => "xerka",
    "title" => "Xerka",
    "rule" => array(
      "^Xerka WebBot v([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.diana-teknologia.com/www1/english/xerka.htm"
  ),
  "xirq" => array(
    "icon" => "robot",
    "title" => "XIRQ",
    "rule" => array(
      "^xirq[ /]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.xirq.com"
  ),
  "xmlslurp" => array(
    "icon" => "robot",
    "title" => "XMLSlurp",
    "rule" => array(
      "^XMLSlurp[ /]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "xmlrpc" => array(
    "icon" => "robot",
    "title" => "Trackback",
    "rule" => array(
      "XMLRPC" => ""
    )
  ),
  "yacy" => array(
    "icon" => "yacy",
    "title" => "Yacy",
    "rule" => array(
      "yacy\.net" => ""
    )
  ),
  "yahoo" => array(
    "icon" => "yahoo",
    "title" => "Yahoo",
    "rule" => array(
      "Yahoo(! ([a-z]{1,3} )?Slurp|-)" => "",
      "Yahoo-MMCrawler[/ ]([0-9a-z.]{1,10})" => "\\1",
      "Yahoo-VerticalCrawler-FormerWebCrawler[/ ]([0-9a-z.]{1,10})" => "\\1",
      "^AnzwersCrawl[/ ]([0-9a-z.]{1,10})" => "\\1",
      "Y!J(-BSC|-SRD)*[/ ]([0-9a-z.]{1,10})" => "\\2",
      "Y!OASIS/TEST" => "",
      "Harvest-NG[/ ]([0-9a-z.]{1,10})" => "\\1",
      "Y!J; for robot study" => "",
      "Yahoo Japan; for robot study" => ""
    ),
    "uri" => "http://www.yahoo.com"
  ),
  "yahoo-feed" => array(
    "icon" => "yahoo",
    "title" => "Yahoo Feedseeker",
    "rule" => array(
      "^YahooFeedSeeker[/ ]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.yahoo.com"
  ),
  "yahoo-feed-jp" => array(
    "icon" => "yahoo",
    "title" => "Yahoo Feedseeker Japan",
    "rule" => array(
      "YahooFeedSeekerBetaJp[/ ]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "yahoo-pipes" => array(
    "icon" => "yahoo",
    "title" => "Yahoo Pipes",
    "rule" => array(
      "Yahoo Pipes[/ ]([0-9a-z.]{1,10})" => "\\1"
    )
  ),
  "yandex" => array(
    "icon" => "yandex",
    "title" => "Yandex",
    "rule" => array(
      "Yandex[/ ]([0-9.]{1,10})" => "\\1",
      "YandexBot[/ ]([0-9.]{1,10})" => "\\1",
      "YandexImages[/ ]([0-9.]{1,10})" => "\\1",
      "YandexMedia[/ ]([0-9.]{1,10})" => "\\1",
      "YandexBlogs[/ ]([0-9.]{1,10})" => "\\1",
      "YandexSomething[/ ]([0-9.]{1,10})" => "\\1"
    )
  ),
  "yanga" => array(
    "icon" => "yanga",
    "title" => "Yanga",
    "rule" => array (
      "^Yanga.*v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.yanga.co.uk/"
  ),
  "yap" => array(
    "icon" => "yap",
    "title" => "Yap",
    "rule" => array(
      "^YapBot[_/ ]v([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.yapinc.com/"
  ),
  "yarienavoir" => array(
    "icon" => "robot",
    "title" => "Yarienavoir",
    "rule" => array(
      "^yarienavoir.net[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.yarienavoir.net/"
  ),
  "yell" => array(
    "icon" => "yell",
    "title" => "Yell",
    "rule" => array(
      "YellCrawl[ /]V?([0-9.]{1,10})" => "\\1",
      "Yellbot[ /]Nutch-([0-9.]{1,10})" => "\\1",
    )
  ),
  "youdao" => array(
    "icon" => "youdao",
    "title" => "Youdao",
    "rule" => array(
      "YodaoBot-(Image|Mobile)?[ /]([0-9.]{1,10})" => "\\2",
      "YodaoBot[ /]([0-9.]{1,10})" => "\\1",
      "YoudaoBot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.youdao.com/help/webmaster/spider/"
  ),
  "yoogli" => array(
    "icon" => "yoogli",
    "title" => "Yoogli",
    "rule" => array(
      "yoogliFetchAgent[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.yoogli.com"
  ),
  "yotta" => array(
    "icon" => "robot",
    "title" => "Yotta",
    "rule" => array(
      "Yotta(Shopping|Cars)_Bot[ /]([0-9.]{1,10})" => "\\2",
      "OmniExplorer_Bot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.yottacars.com"
  ),
  "yoono" => array(
    "icon" => "yoono",
    "title" => "Yoono",
    "rule" => array(
      "Yoono" => ""
    ),
    "uri" => "http://www.yoono.com/"
  ),
  "yowedo" => array(
    "icon" => "robot",
    "title" => "Yowedo",
    "rule" => array(
      "Yowedo[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://yowedo.com/en/partners.html"
  ),
  "yuntis" => array(
    "icon" => "robot",
    "title" => "yuntis",
    "rule" => array(
      "Gulper Web Bot[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://yuntis.ecsl.cs.sunysb.edu/help/robot/"
  ),
  "zao" => array(
    "icon" => "robot",
    "title" => "Zao",
    "rule" => array(
      "Zao[ /]([0-9.]{1,10})" => "\\1",
      "Zao-crawler" => ""
    )
  ),
  "zealbot" => array(
    "icon" => "zeal",
    "title" => "ZealBot",
    "rule" => array(
      "Zealbot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "zearchit" => array(
    "icon" => "zearchit",
    "title" => "Zearchit",
    "rule" => array(
      "Zearchit" => ""
    ),
    "uri" => "http://www.zearchit.de/"
  ),
  "zebz" => array(
    "icon" => "robot",
    "title" => "ze.bz",
    "rule" => array(
      "^ZeBot_(lseek\.net|www\.ze\.bz)" => ""
    ),
    "uri" => "http://www.ze.bz/"
  ),
  "zedzo" => array(
    "icon" => "robot",
    "title" => "Zedzo",
    "rule" => array(
      "zedzo.digest[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.zedzo.com/"
  ),
  "zerx" => array(
    "icon" => "zerx",
    "title" => "Zerx",
    "rule" => array(
      "^zerxbot[ /](Version|v)*[ /]*([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.zerx.com/"
  ),
  "zeus" => array(
    "icon" => "zeus",
    "title" => "Zeus",
    "rule" => array(
      "Zeus" => ""
    ),
    "uri" => "http://www.zeus.com"
  ),
  "zippp" => array(
    "icon" => "robot",
    "title" => "Zippp",
    "rule" => array(
      "ZipppBot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "zippy" => array(
    "icon" => "robot",
    "title" => "Zippy",
    "rule" => array(
      "^Zippy[ v/]*([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.zippyfinder.com"
  ),
  "zoeky" => array(
    "icon" => "robot",
    "title" => "Zoeky",
    "rule" => array(
      "Zoekybot[ /]([0-9.]{1,10})" => "\\1"
    )
  ),
  "zoom" => array(
    "icon" => "zoom",
    "title" => "zspider",
    "rule" => array(
      "^ZoomSpider" => ""
    ),
    "uri" => "http://www.wrensoft.com/"
  ),
  "zspider" => array(
    "icon" => "robot",
    "title" => "zspider",
    "rule" => array(
      "zspider[ /]([0-9.a-z]{1,10})" => "\\1"
    ),
    "uri" => "http://feedback.redkolibri.com/"
  ),
  "zyborg" => array(
    "icon" => "zyborg",
    "title" => "WiseNutBot",
    "rule" => array(
      "(WISE|Zy)bo(rg|t)[ /]([0-9.]{1,10})" => "\\3"
    )
  ),
// generic stuff
  "blogbot" => array(
    "icon" => "blogbot",
    "title" => "BlogBot",
    "rule" => array(
      "Blog[ \-]?Bot" => ""
    ),
    "uri" => "http://www.blogbot.com/"
  ),
  "centrum" => array(
    "icon" => "centrum",
    "title" => "Centrum",
    "rule" => array(
      "holmes[/ ]([0-9.]{1,10})" => "\\1",
      "^Centrum-checker" => ""
    )
  ),
  "httpclient" => array(
    "icon" => "robot",
    "title" => "HTTPClient",
    "rule" => array(
      "HTTP[ \-]?Client[ /]([0-9.]{1,10})" => "\\1",
      "HTTP[ \-]?Client" => ""
    ),
    "uri" => "http://www.innovation.ch/java/HTTPClient/"
  ),
  "incywincy" => array(
    "icon" => "robot",
    "title" => "IncyWincy",
    "rule" => array(
      "^IncyWincy[ /]([0-9.]{1,10})" => "\\1",
      "^IncyWincy" => ""
    )
  ),
  "java" => array(
    "icon" => "java",
    "title" => "Java",
    "rule" => array(
      "^java[ /]*([0-9.a-z]{1,10})" => "\\1"
    )
  ),
  "libfetch" => array(
    "icon" => "robot",
    "title" => "Libfetch",
    "rule" => array(
      "^(fetch )?libfetch[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://www.freebsd.org/"
  ),
  "libwww" => array(
    "icon" => "libwww",
    "title" => "libWWW",
    "rule" => array(
      "^libww(w|w-perl|w-FM)[ /]([0-9.]{1,10})" => "\\2",
      "^libww(w|w-perl|w-FM)" => "",
      "MyApp.*libww(w|w-perl|w-FM)" => ""
    )
  ),
  "litefinder" => array(
    "icon" => "litefinder",
    "title" => "LiteFinder",
    "rule" => array(
      "LiteFinder[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.litefinder.net/about.html"
  ),
  "nutchorg" => array(
    "icon" => "nutchorg",
    "title" => "Nutch",
    "rule" => array(
      "Nutc(hOrg|hCVS|h)?[ /]([0-9.]{1,10})" => "\\2",
      "Nutch" => ""
    ),
    "uri" => "http://lucene.apache.org/nutch/"
  ),
  "pythonurl" => array(
    "icon" => "robot",
    "title" => "Python-url",
    "rule" => array(
      "Python[ \-]?urllib" => ""
    )
  ),
// Proxy
/* This is wrong. Many mobiles use this
  "googlewap" => array(
    "icon" => "google",
    "title" => "Google-Proxy",
    "rule" => array (
      "Google CHTML Proxy[ /]([0-9.]{1,10})" => "\\1",
      "Google WAP Proxy[ /]([0-9.]{1,10})" => "\\1"
    )
  ),*/
// Spam Harvesters
/* This is not BBClone job to detect that
  "SPAM" => array(
    "icon" => "robot",
    "title" => "SPAM",
    "rule" => array(
      "NASA Search[/ ]([0-9.]{1,10})" => "\\1",
      "^PHOTO CHECK" => "",
      "^FOTOCHECKER" => "",
      "^IPTC CHECK" => "",
      "^DataCha0s" => "",
      "^Mac Finder" => "",
      "^Missigua Locator[ /]([0-9.]{1,10})" => "\\1",
      "^Missouri College Browse" => "",
      "Email[ \-]?Siphon" => "",
      "atSpider" => "",
      "autoemailspider" => "",
      "^Demo Bot" => "",
      "^Program Shareware" => "",
      "^Snapbot" => "",
      "^snap.com" => "",
      "^Guestbook Auto Submitter" => "",
      "panscient.com" => "",
    )
  ),*/
// Catch up for things we don't know by now
  "robot" => array(
    "icon" => "robot",
    "title" => "Robot",
    "rule" => array(
      "(robot|spider|harvest|bot|(?<!msie)crawler)" => ""
    )
  )
);
