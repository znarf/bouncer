<?php
/* This file is part of BBClone (A PHP based Web Counter on Steroids)
 * 
 * SVN FILE $Id: browser.php 312 2014-11-22 10:26:50Z joku $
 *  
 * Copyright (C) 2001-2015, the BBClone Team (see doc/authors.txt for details)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * See doc/copying.txt for details
 */

///////////////////////
// Browser Detection //
///////////////////////

$browser = array(
  "1X" => array(
    "icon" => "question",
    "title" => "1X",
    "rule" => array(
      "^Science Traveller International 1X[ /]([0-9.]{1,10})" => "\\1",
    ),
    "uri" => "http://jansfreeware.com/jfinternet.htm"
  ),
  "abolimba" => array(
    "icon" => "question",
    "title" => "Abolimba",
    "rule" => array(
      "www.abolimba.de" => ""
    ),
    "uri" => "http://www.abolimba.de"
  ),
  "abrowse" => array(
    "icon" => "abrowse",
    "title" => "ABrowse",
    "rule" => array(
      "abrowse[ /\-]([0-9.]{1,10})" => "\\1",
      "^abrowse" => ""
    ),
    "uri" => "http://abrowse.sourceforge.net/"
  ),
  "ace" => array(
    "icon" => "ace",
    "title" => "Ace Explorer",
    "rule" => array(
      "^Ace Explorer" => ""
    ),
    "uri" => "http://www.aceexplorer.com/"
  ),
  "acorn" => array(
    "icon" => "question",
    "title" => "Acorn Browser",
    "rule" => array(
      "Acorn (Browse|Phoenix)[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.vigay.com/inet/acorn/browse-html.html"
  ),
  "acoo" => array(
    "icon" => "acoo",
    "title" => "Acoo",
    "rule" => array(
      "ACOO BROWSER" => ""
    ),
    "uri" => "http://www.acoobrowser.com/"
  ),
  "activeworlds" => array(
    "icon" => "question",
    "title" => "ActiveWorlds",
    "rule" => array(
      "Activeworlds[ /]([0-9.]{1,10})" => "\\1",
      "Activeworlds" => ""
    ),
    "uri" => ""
  ),
  "akregator" => array(
    "icon" => "akregator",
    "title" => "Akregator",
    "rule" => array(
      "akregator/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://akregator.kde.org/"
  ),
  "amaya" => array(
    "icon" => "amaya",
    "title" => "Amaya",
    "rule" => array(
      "amaya/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.w3c.org/amaya/"
  ),
  "annotate_google" => array(
    "icon" => "question",
    "title" => "annotate_google",
    "rule" => array(
      "^annotate_google" => "\\1"
    ),
    "uri" => "http://ponderer.org/download/annotate_google.user.js"
  ),
  "ant" => array(
    "icon" => "ant",
    "title" => "ANTFresco",
    "rule" => array(
      "ANTFresco[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "aol" => array(
    "icon" => "aol",
    "title" => "AOL",
    "rule" => array(
      "aol[ /\-]([0-9.]{1,10})" => "\\1",
      "America Online Browser[ /]([0-9.]{1,10}).*rev([0-9.]{1,10})" => "\\1",
      "aol[ /\-]?browser" => "",
      "AOL-IWENG ([0-9.]{1,10})" => "\\1",
      "ADM[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.aol.com"
  ),
  "aplix" => array(
    "icon" => "question",
    "title" => "Aplix",
    "rule" => array(
      "^Aplix HTTP[ /]([0-9.]{1,10})" => "\\1",
      "^Aplix_(SANYO|SEGASATURN)_browser[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => ""
  ),
  "arora" => array(
    "icon" => "arora",
    "title" => "Arora",
    "rule" => array(
      "Arora[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.arora-browser.org/"
  ),
  "avantbrowser" => array(
    "icon" => "avantbrowser",
    "title" => "Avant Browser",
    "rule" => array(
      "Avant[ ]?Browser" => ""
    ),
    "uri" => "http://www.avantbrowser.com/"
  ),
  "avantgo" => array(
    "icon" => "avantgo",
    "title" => "AvantGo",
    "rule" => array(
      "AvantGo[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.avantgo.com/frontdoor/"
  ),
  "aweb" => array(
    "icon" => "aweb",
    "title" => "Aweb",
    "rule" => array(
      "Amiga-Aweb[/ ]([0-9.]{1,10})" => "\\1",
      "Aweb[/ ]([0-9.]{1,10})" => "\\1",
      "^AWeb" => ""
    ),
    "uri" => "http://aweb.sunsite.dk/"
  ),
  "babya" => array(
    "icon" => "question",
    "title" => "Babya Discoverer",
    "rule" => array(
      "Babya Discoverer ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "barca" => array(
    "icon" => "question",
    "title" => "Barca",
    "rule" => array(
      "Barca(Pro)?[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => ""
  ),
  "beonex" => array(
    "icon" => "beonex",
    "title" => "Beonex",
    "rule" => array(
      "beonex/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""    
  ),
  "bezillabrowser" => array(
    "icon" => "bezillabrowser",
    "title" => "BeZillaBrowser",
    "rule" => array(
      "BeZillaBrowser/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://www.bezilla.org/"
  ),
  "biyubi" => array(
    "icon" => "question",
    "title" => "Biyubi",
    "rule" => array(
      "^Biyubi/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "blackberry" => array(
    "icon" => "blackberry",
    "title" => "BlackBerry",
    "rule" => array(
      "^BlackBerry.*?/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.blackberry.com/"
  ),
  "blazer" => array(
    "icon" => "blazer",
    "title" => "Blazer",
    "rule" => array(
      "Blazer[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "bluefish" => array(
    "icon" => "bluefish",
    "title" => "BlueFish",
    "rule" => array(
      "bluefish[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://bluefish.openoffice.nl/"
  ),
  "browsex" => array(
    "icon" => "browsex",
    "title" => "BrowseX",
    "rule" => array(
      "BrowseX.*\(([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.browsex.com/"
  ),
  "camino" => array(
    "icon" => "camino",
    "title" => "Camino",
    "rule" => array(
      "camino/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://www.mozilla.org/projects/camino/"
  ),
  "checkandget" => array(
    "icon" => "checkandget",
    "title" => "Check&Get",
    "rule" => array(
      "Check\&Get[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://activeurls.com/"
  ),
  "chimera" => array(
    "icon" => "chimera",
    "title" => "Chimera",
    "rule" => array(
      "chimera/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://www.chimera.org/"
  ),
  "cometbird" => array(
    "icon" => "cometbird",
    "title" => "CometBird",
    "rule" => array(
      "CometBird[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.cometbird.com/"
  ),
  "compuserve" => array(
    "icon" => "question",
    "title" => "CompuServe",
    "rule" => array(
      "CS 2000 ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.compuserve.com/"
  ),
  "contiki" => array(
    "icon" => "question",
    "title" => "Contiki",
    "rule" => array(
      "^Contiki[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sics.se/~adam/contiki/apps/webbrowser.html"
  ),
  "columbus" => array(
    "icon" => "columbus",
    "title" => "Columbus",
    "rule" => array(
      "columbus[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "crazybrowser" => array(
    "icon" => "crazybrowser",
    "title" => "Crazy Browser",
    "rule" => array(
      "Crazy Browser[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.crazybrowser.com/"
  ),
  "cruz" => array(
    "icon" => "cruz",
    "title" => "Cruz",
    "rule" => array(
      "Cruz[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.cruzapp.com"
  ),
  "curl" => array(
    "icon" => "curl",
    "title" => "Curl",
    "rule" => array(
      "curl[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://curl.haxx.se/"
  ),
  "cuteftp" => array(
    "icon" => "question",
    "title" => "Cute FTP",
    "rule" => array(
      "Cute FTP .*[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "cyberdog" => array(
    "icon" => "question",
    "title" => "Cyberdog",
    "rule" => array(
      "^Cyberdog[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.cyberdog.org/"
  ),
  "deepnet" => array(
    "icon" => "deepnet",
    "title" => "Deepnet Explorer",
    "rule" => array(
      "Deepnet Explorer[/ ]([0-9.]{1,10})" => "\\1",
      " Deepnet Explorer[\);]" => ""
    ),
    "uri" => "http://www.deepnetexplorer.com/"
  ),
  "demeter" => array(
    "icon" => "demeter",
    "title" => "Demeter",
    "rule" => array(
      "Demeter[ /]([0-9.]{1,10})" => "\\1",
      "Demeter" => ""
    ),
    "uri" => "http://www.hurrikenux.com/demeter/"
  ),
  "democracy" => array(
    "icon" => "question",
    "title" => "Democracy",
    "rule" => array(
      "Democracy[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.getdemocracy.com/"
  ),
  "dillo" => array(
    "icon" => "dillo",
    "title" => "Dillo",
    "rule" => array(
      "dillo/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.dillo.org/"
  ),
  "divx" => array(
    "icon" => "dillo",
    "title" => "DivX Player",
    "rule" => array(
      "DivX Player[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "dolfin" => array(
    "icon" => "dolfin",
    "title" => "Dolfin",
    "rule" => array(
      "Dolfin[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.bada.com/"
  ),
  "doczilla" => array(
    "icon" => "doczilla",
    "title" => "DocZilla",
    "rule" => array(
      "DocZilla/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.doczilla.com/"
  ),
  "donut" => array(
    "icon" => "donut",
    "title" => "Donut RAPT",
    "rule" => array(
      "Donut RAPT[/ ]#?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "donutp" => array(
    "icon" => "question",
    "title" => "Donut P",
    "rule" => array(
      "^DonutP" => "\\1"
    ),
    "uri" => ""
  ),
  "dooble" => array(
    "icon" => "dooble",
    "title" => "Dooble",
    "rule" => array(
      "Dooble/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://dooble.sourceforge.net/"
  ),
  "doris" => array(
    "icon" => "doris",
    "title" => "Doris",
    "rule" => array(
      "Doris/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "dreampassport" => array(
    "icon" => "dreamcast",
    "title" => "DreamPassport",
    "rule" => array(
      "\(SonicPassport\)" => "",
      "\(Dream(Passport|Key)[ /]([0-9.]{1,10})\)" => "\\1",
      "\(Dream(Passport|Key)[ /]([0-9.]{1,10}); ([A-Z.a-z/]{1,50})\)" => "\\1",
      "\(Planetweb[ /]([0-9.a-z]{1,10})" => "\\1"
    ),
    "uri" => "http://css.vis.ne.jp/dp-agent.shtml"
  ),
  "dxbrowser" => array(
    "icon" => "question",
    "title" => "DX-Browser",
    "rule" => array(
      "DX-Browser ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.wankoo.org/index.php?page=Software.DXBrowser"
  ),
  "edbrowse" => array(
    "icon" => "question",
    "title" => "edbrowse",
    "rule" => array(
      "edbrowse/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.eklhad.net/linux/app/"
  ),
  "elinks" => array(
    "icon" => "links",
    "title" => "ELinks",
    "rule" => array(
      "ELinks[ /][\(]*([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://elinks.or.cz/"
  ),
  "emacs" => array(
    "icon" => "question",
    "title" => "Emacs/w3s",
    "rule" => array(
      "Emacs-W3/([0-9.]{1,10}(pre)?)" => "\\1"
    ),
    "uri" => "http://www.gnu.org/software/w3/"
  ),
  "endo" => array(
    "icon"  => "endo",
    "title" => "endo",
    "rule"  => array(
      "^endo/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://kula.jp/endo"
  ),
  "epiphany"  => array(
    "icon"  => "epiphany",
    "title" => "Epiphany",
    "rule"  => array(
      "Epiphany/([0-9.]{1,10})" => "\\1",
      "epiphany-webkit" => ""
    ),
    "uri" => "http://www.gnome.org/projects/epiphany/"
  ),
  "eudoraweb" => array(
    "icon" => "mobile",
    "title" => "EudoraWeb",
    "rule" => array(
      "EudoraWeb[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.eudora.com/internetsuite/eudoraweb.html"
  ),
  "fennec" => array(
    "icon" => "fennec",
    "title" => "Fennec",
    "rule" => array(
      "Fennec[ /]([0-9.a-z]{1,10})" => "\\1"
    ),
    "uri" => "http://www.mozilla.org/projects/fennec/1.0a2/releasenotes/"
  ),
  "firebird"  => array(
    "icon"  => "firebird",
    "title" => "Firebird",
    "rule"  => array(
      "Firebird( Browser)?/([0-9.+]{1,10})" => "\\2"
    ),
    "uri" => "http://www.mozilla.org/"
  ),
  "firescape"  => array(
    "icon"  => "firescape",
    "title" => "Firescape",
    "rule"  => array(
      "Firescape/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "flock" => array(
    "icon" => "flock",
    "title" => "Flock",
    "rule" => array(
      "Flock/([0-9a-z.]{1,10})" => "\\1",
      "Sulfur/([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.flock.com/"
  ),
  "fluid" => array(
    "icon" => "fluid",
    "title" => "Fluid",
    "rule" => array(
      "Fluid[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.fluidapp.com"
  ),
  "freshdownload" => array(
    "icon" => "freshdownload",
    "title" => "FreshDownload",
    "rule" => array(
      "FreshDownload/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.freshdevices.com/"
  ),
  "frontpage"  => array(
    "icon"  => "frontpage",
    "title" => "Frontpage",
    "rule"  => array(
      "FrontPage[ /]([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://www.microsoft.com/"
  ),
  "galeon" => array(
    "icon" => "galeon",
    "title" => "Galeon",
    "rule" => array(
      "galeon/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://galeon.sourceforge.net/"
  ),
  "hgrepurl" => array(
    "icon" => "oreilly",
    "title" => "O'Reilly tutorial",
    "rule" => array(
      "hgrepurl/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.oreilly.com/openbook/webclient/"
  ),
  "hotjava" => array(
    "icon" => "hotjava",
    "title" => "HotJava",
    "rule" => array(
      "^HotJava[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://java.sun.com/products/archive/hotjava/index.html"
  ),
   "hv3" => array(
     "icon" => "question",
     "title" => "Hv3",
     "rule" => array(
       " Hv3[ /]([0-9.a-z]{1,10})" => "\\1"
     ),
     "uri" => "http://tkhtml.tcl.tk/hv3.html"
   ),
  "ibis" => array(
    "icon" => "question",
    "title" => "ibisBrowser",
    "rule" => array(
      "ibisBrowser" => ""
    ),
    "uri" => ""
  ),
  "ibrowse" => array(
    "icon" => "ibrowse",
    "title" => "IBrowse",
    "rule" => array(
      "ibrowse[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.ibrowse-dev.net/"
  ),
  "icab" => array(
    "icon" => "icab",
    "title" => "iCab",
    "rule" => array(
      "icab[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.icab.de/"
  ),
  "ice" => array(
    "icon" => "ice",
    "title" => "ICEbrowser",
    "rule" => array(
      "ICE[ ]?Browser/v?([0-9._]{1,10})" => "\\1"
    ),
    "uri" => "http://www.borland.com/jbuilder/"
  ),
  "iceape" => array(
    "icon" => "iceape",
    "title" => "Iceape",
    "rule" => array(
      "Iceape/([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://packages.debian.org/source/iceape"
  ),
  "icecat" => array(
    "icon" => "icecat",
    "title" => "IceCat",
    "rule" => array(
      "IceCat/([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.gnu.org/software/gnuzilla/"
  ),
  "iceweasel"  => array(
    "icon"  => "iceweasel",
    "title" => "Iceweasel",
    "rule"  => array(
      "Iceweasel/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://www.geticeweasel.org/"
  ),
  "iemobile"  => array(
    "icon"  => "iemobile",
    "title" => "IE Mobile",
    "rule"  => array(
      "IEMobile/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "iexplorepocket" => array(
    "icon" => "mobile",
    "title" => "Internet Explorer Pocket",
    "rule" => array(
      "Microsoft Pocket Internet Explorer[ /]([0-9.]{1,10})" => "\\1",
      "MSPIE[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "ipeng" => array(
    "icon" => "ipeng",
    "title" => "iPeng",
    "rule" => array(
      "^iPeng.*(iPhone|iPad)[ /]([0-9.]{1,10})" => "\\2"
    ),
    "uri" => "http://penguinlovesmusic.de/"
  ),
  "ipoto" => array(
    "icon" => "iphoto",
    "title" => "iPhoto",
    "rule" => array(
      "iPhoto/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://penguinlovesmusic.de/"
  ),
  "irider" => array(
    "icon" => "irider",
    "title" => "iRider",
    "rule" => array(
      "iRider[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "iron" => array(
    "icon" => "iron",
    "title" => "Iron",
    "rule" => array(
      "Iron/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.srware.net/"
  ),
  "isilox" => array(
    "icon" => "isilox",
    "title" => "iSiloX",
    "rule" => array(
      "iSilox/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "kazehakase" => array(
    "icon" => "kazehakase",
    "title" => "Kazehakase",
    "rule" => array(
      "Kazehakase[ /]([0-9a-z.]{1,10})" => "\\1",
      "kazehakase" => ""
    ),
    "uri" => "http://kazehakase.sourceforge.jp/20031201.html"
  ),
  "kkman" => array(
    "icon" => "kkman",
    "title" => "KKman",
    "rule" => array(
      "KKman[ /]?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.kkman.com.tw/"
  ),
  "klondike" => array(
    "icon" => "question",
    "title" => "Klondike",
    "rule" => array(
      "Klondike[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "k-meleon" => array(
    "icon" => "k-meleon",
    "title" => "K-Meleon",
    "rule" => array(
      "K-Meleon[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://kmeleon.sourceforge.net/"
  ),
  "k-ninja" => array(
    "icon" => "k-ninja",
    "title" => "K-Ninja",
    "rule" => array(
      "K-Ninja[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.geocities.com/grenleef/"
  ),
  "konqueror" => array(
    "icon" => "konqueror",
    "title" => "Konqueror",
    "rule" => array(
      "konqueror/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.konqueror.org/"
  ),
  "kylo" => array(
    "icon" => "kylo",
    "title" => "Kylo",
    "rule" => array(
      "Kylo/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://kylo.tv/"
  ),
  "liferea" => array(
    "icon" => "liferea",
    "title" => "Liferea",
    "rule" => array(
      "Liferea[ /]([0-9a-z.\-]{1,10})" => "\\1"
    ),
    "uri" => "http://liferea.sf.net/"
  ),
  "links" => array(
    "icon" => "links",
    "title" => "Links",
    "rule" => array(
      "Links[ /]\(([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://artax.karlin.mff.cuni.cz/~mikulas/links"
  ),
  "lobo" => array(
    "icon" => "lobo",
    "title" => "Lobo",
    "rule" => array(
      "Lobo/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://lobobrowser.org/"
  ),
  "lotus" => array(
    "icon" => "lotus",
    "title" => "Lotus Notes",
    "rule" => array(
      "Lotus[ \-]?Notes[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "lunascape" => array(
    "icon" => "lunascape",
    "title" => "Lunascape",
    "rule" => array(
      "Lunascape[ /]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "lynx" => array(
    "icon" => "lynx",
    "title" => "Lynx",
    "rule" => array(
      "lynx[ /]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://lynx.browser.org/"
  ),
   "maxthon" => array(
    "icon" => "maxthon",
    "title" => "Maxthon",
    "rule" => array(
      "Maxthon[ /]([0-9.]{1,10})" => "\\1",
      "Maxthon[\);]" => ""
    ),
    "uri" => ""
  ),
  "mbrowser" => array(
    "icon" => "mbrowser",
    "title" => "mBrowser",
    "rule" => array(
      "mBrowser[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "mediaplayer" => array(
    "icon" => "wmp10",
    "title" => "Media Player",
    "rule" => array(
      "NSPlayer[ /]([0-9.]{1,10})" => "\\1",
      "WMFSDK[ /]([0-9.]{1,10})" => "\\1",
      "Windows-Media-Player[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "mib" => array(
    "icon" => "mobile",
    "title" => "Mobile Internet Browser",
    "rule" => array(
      " MIB[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.motorola.com/content.jsp?globalObjectId=1827-4343"
  ),
  "midori" => array(
    "icon" => "midori",
    "title" => "Midori",
    "rule" => array(
      "midori[ /]([0-9.]{1,10})" => "\\1",
      "midori" => ""
    ),
    "uri" => "http://software.twotoasts.de/"
  ),
  "minimo" => array(
    "icon" => "mozilla",
    "title" => "Minimo",
    "rule" => array(
      "Minimo[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.mozilla.org/projects/minimo/"
  ),
  "miro" => array(
    "icon" => "miro",
    "title" => "Miro",
    "rule" => array(
      "Miro[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.getmiro.com/"
  ),
  "mnenhy" => array(
    "icon" => "mnenhy",
    "title" => "Mnenhy",
    "rule" => array(
      "Mnenhy[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://mnenhy.mozdev.org/"
  ),
  "mosaic" => array(
    "icon" => "mosaic",
    "title" => "Mosaic",
    "rule" => array(
      "mosaic[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "mpc" => array(
    "icon" => "mpc",
    "title" => "Media Player Classic",
    "rule" => array(
      "Media Player Classic" => ""
    ),
    "uri" => "http://sourceforge.net/projects/guliverkli/"
  ),
  "mplayer" => array(
    "icon" => "mplayer",
    "title" => "MPlayer",
    "rule" => array(
      "^MPlayer[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.mplayerhq.hu"
  ),
  "msn" => array(
    "icon" => "msn",
    "title" => "MSN Explorer",
    "rule" => array(
      "MSN[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.mplayerhq.hu"
  ),
  "multibrowser" => array(
    "icon" => "multibrowser",
    "title" => "Multi-Browser",
    "rule" => array(
      "Multi-Browser[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://archive.ncsa.uiuc.edu/SDG/Software/XMosaic/"
  ),
  "myie2" => array(
    "icon" => "myie2",
    "title" => "MyIE2",
    "rule" => array(
      " MyIE2[\);]" => ""
    ),
    "uri" => ""
  ),
  "nautilus" => array(
    "icon" => "nautilus",
    "title" => "Nautilus",
    "rule" => array(
      "(gnome[ \-]?vfs|nautilus)/([0-9.]{1,10})" => "\\2"
    ),
    "uri" => ""
  ),
  "netnewswire" => array(
    "icon" => "netnewswire",
    "title" => "NetNewsWire",
    "rule" => array(
      "NetNewsWire[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://ranchero.com/netnewswire/"
  ),
  "netsurf" => array(
    "icon" => "netsurf",
    "title" => "NetSurf",
    "rule" => array(
      "Netsurf[ /]?([0-9.]{1,10})?" => "\\1"
    ),
    "uri" => ""
  ),
  "netcaptor" => array(
    "icon" => "netcaptor",
    "title" => "Netcaptor",
    "rule" => array(
      "netcaptor[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "netfront" => array(
    "icon" => "netfront",
    "title" => "Netfront",
    "rule" => array(
      "NetFront[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.access-company.com/"
  ),
  "netpositive" => array(
    "icon" => "netpositive",
    "title" => "NetPositive",
    "rule" => array(
      "netpositive[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://browsers.evolt.org/?netpositive/"
  ),
  "nexus" => array(
    "icon" => "question",
    "title" => "Nexus",
    "rule" => array(
      "^Nexus" => ""
    ),
    "uri" => "http://browsers.evolt.org/"
  ),
  "offbyone" => array(
    "icon" => "offbyone",
    "title" => "OffByOne",
    "rule" => array(
      "OffByOne" => ""
    ),
    "uri" => "http://www.offbyone.com/"
  ),
  "office" => array(
    "icon" => "office",
    "title" => "Office",
    "rule" => array(
      "^Microsoft Data Access Internet Publishing Provider (Protocol Discovery|Cache Manager|DAV)" => ""
    ),
    "uri" => "http://www.office.microsoft.com/"
  ),
  "omniweb" => array(
    "icon" => "omniweb",
    "title" => "OmniWeb",
    "rule" => array(
      "omniweb/[ a-z]?([0-9.]{1,10})$" => "\\1",
      "OmniWeb/[ a-z]?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "openwave" => array(
    "icon" => "mobile",
    "title" => "OpenWave",
    "rule" => array(
      "OPWV-SDK UP\.Browser[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.openwave.com/us/products/mobile/device_products/mobile_browser/index.htm"
  ),
  "operamini" => array(
    "icon" => "opera",
    "title" => "Opera Mini",
    "rule" => array(
      "opera mini[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.opera.com/"
  ),
  "opera" => array(
    "icon" => "opera",
    "title" => "Opera",
    "rule" => array(
      "opera.+Version[ /]([x0-9.]{1,10})" => "\\1",
      "opera[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.opera.com/"
  ),
  "orca" => array(
    "icon" => "question",
    "title" => "Orca",
    "rule" => array(
      "Orca Browser \(http://www.orcabrowser.com\)" => "\\1"
    ),
    "uri" => "http://www.orcabrowser.com"
  ),
  "oregano" => array(
    "icon" => "oregano",
    "title" => "Oregano",
    "rule" => array(
      "Oregano[0-9]?[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.castle.org.uk/oregano/"
  ),
  "palmsource" => array(
    "icon" => "palmsource",
    "title" => "PalmSource Web Browser",
    "rule" => array(
      "PalmSource" => "",
      "Palm-Arz1" => ""
    ),
    "uri" => "http://www.palmos.com/dev/tech/palmos5/webbrowser.html"
  ),
  "paparazzi" => array(
    "icon" => "question",
    "title" => "Paparazzi",
    "rule" => array(
      "Paparazzi!/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "phaseout" => array(
    "icon" => "phaseout",
    "title" => "PhaseOut",
    "rule" => array(
      "www\.phaseout\.net" => ""
    ),
    "uri" => "http://www.phaseout.net/"
  ),
  "plainview" => array(
    "icon" => "plainview",
    "title" => "Plainview",
    "rule" => array(
      "Plainview[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.barbariangroup.com/software/plainview"
  ),
  "plink" => array(
    "icon" => "plink",
    "title" => "PLink",
    "rule" => array(
      "PLink[ /]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "plucker" => array(
    "icon" => "mobile",
    "title" => "Plucker",
    "rule" => array(
      "Plucker[ /](Py-)?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.openwave.com/us/products/mobile/device_products/mobile_browser/index.htm"
  ),
  "phoenix" => array(
    "icon" => "phoenix",
    "title" => "Phoenix",
    "rule" => array(
      "Phoenix/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "phped" => array(
    "icon" => "question",
    "title" => "PHPEd",
    "rule" => array(
      "PHPEd Version[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "printsmart" => array(
    "icon" => "question",
    "title" => "HP Web PrintSmart",
    "rule" => array(
      "HP Web PrintSmart ([0-9.a-z]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "prism" => array(
    "icon" => "prism",
    "title" => "Mozilla Prism",
    "rule" => array(
      "prism/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://prism.mozillalabs.com/"
  ),
  "proxomitron" => array(
    "icon" => "proxomitron",
    "title" => "Proxomitron",
    "rule" => array(
      "(Space( )?)?bison/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.proxomitron.info/"
  ),
  "psp" => array(
    "icon" => "question",
    "title" => "PlayStation Portable",
    "rule" => array(
      "PSP \(PlayStation Portable\); ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "puf" => array(
    "icon" => "question",
    "title" => "Parallel URL Fetcher",
    "rule" => array(
      "^puf[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://puf.sourceforge.net/"
  ),
  "quicktime" => array(
    "icon" => "quicktime",
    "title" => "QuickTime",
    "rule" => array(
      "QuickTime..qtver.([0-9.]{1,10})" => "\\1",
      "qtver.([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.apple.com/quicktime/"
  ),
  "realplayer" => array(
    "icon" => "realplayer",
    "title" => "Real Player",
    "rule" => array(
      "RealPlayer/([0-9.+]{1,10})" => "\\1",
      "^Mozilla/([0-9.+]{1,10}).*\(R1 1.5\)\)" => "",
      "RMA/([0-9.+]{1,10})" => ""
    ),
    "uri" => "http://www.realplayer.com"
  ),
  "reeder" => array(
    "icon" => "reeder",
    "title" => "Reeder",
    "rule" => array(
      "Reeder/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "http://www.reederapp.com/"
  ),
  "retawq" => array(
    "icon" => "question",
    "title" => "retawq",
    "rule" => array(
      "retawq/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://retawq.sourceforge.net/"
  ),
  "safexplorer" => array(
    "icon" => "question",
    "title" => "Safexplorer",
    "rule" => array(
      "SAFEXPLORER TL" => ""
    ),
    "uri" => "http://www.safexplorer.com/"
  ),
  "sage" => array(
    "icon" => "sage",
    "title" => "Sage",
    "rule" => array(
      "\(Sage\)" => ""
    ),
    "uri" => "http://sage.mozdev.org/"
  ),
  "seamonkey" => array(
    "icon" => "seamonkey",
    "title" => "Seamonkey",
    "rule" => array(
      "Seamonkey[ \-/]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.seamonkey-project.org/"
  ),
  "securewebbrowser" => array(
    "icon" => "question",
    "title" => "HP Secure Web Browser",
    "rule" => array(
      "SWB[ /]V?([0-9.]{1,10}) \(HP\)" => "\\1"
    ),
    "uri" => "http://h71000.www7.hp.com/openvms/products/ips/cswb/cswb.html"
  ),
  "shareaza" => array(
    "icon" => "shareaza",
    "title" => "Shareaza",
    "rule" => array(
      "Shareaza[ /]v?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.shareaza.com/"
  ),
  "shiira" => array(
    "icon" => "shiira",
    "title" => "Shiira",
    "rule" => array(
      "Shiira/([0-9.]{1,10})" => "\\1",
      " Shiira " => ""
    ),
    "uri" => "http://shiira.jp/en.php"
  ),
  "sitekiosk" => array(
    "icon" => "sitekiosk",
    "title" => "SiteKiosk",
    "rule" => array(
      "SiteKiosk[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sitekiosk.com/"
  ),
  "sleipnir" => array(
    "icon" => "sleipnir",
    "title" => "Sleipnir",
    "rule" => array(
      "Sleipnir( Version)?[ /]([0-9a-z.]{1,10})" => "\\2"
    ),
    "uri" => ""
  ),
  "slimbrowser" => array(
    "icon" => "slimbrowser",
    "title" => "SlimBrowser",
    "rule" => array(
      "Slimbrowser" => ""
    ),
    "uri" => ""
  ),
  "smartbro" => array(
    "icon" => "smartbro",
    "title" => "Smart Bro",
    "rule" => array(
      "Smart Bro[ /]?([0-9.]{1,10})?" => "\\1"
    ),
    "uri" => "http://www.smartbro.com/"
  ),  
  "songbird" => array(
    "icon" => "songbird",
    "title" => "Songbird",
    "rule" => array(
      "Songbird[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.songbirdnest.com/"
  ),
  "spectruminternetsuite" => array(
    "icon" => "question",
    "title" => "Spectrum Internet Suite",
    "rule" => array(
      " SIS ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://sis.gwlink.net/"
  ),
  "sputnik" => array(
    "icon" => "sputnik",
    "title" => "Sputnik",
    "rule" => array(
      "Sputnik[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "squid" => array(
    "icon" => "squid",
    "title" => "Squid Proxy",
    "rule" => array(
      "^Cafi[ /]([0-9.]{1,10})" => "\\1",
      "SquidClamAV_Redirector[ /]([0-9.]{1,10})" => ""
    ),
    "uri" => ""
  ),
  "staroffice" => array(
    "icon" => "staroffice",
    "title" => "StarOffice",
    "rule" => array(
      "staroffice[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "stainless" => array(
    "icon" => "stainless",
    "title" => "Stainless",
    "rule" => array(
      "Stainless[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.stainlessapp.com"
  ),
  "strata" => array(
    "icon" => "strata",
    "title" => "Strata",
    "rule" => array(
      "Strata[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "https://www.kirix.com/"
  ),
  "sunrise" => array(
    "icon" => "sunrise",
    "title" => "Sunrise",
    "rule" => array(
      "SunriseBrowser[ /]([0-9.]{1,10})" => "\\1",
      "Sunrise[ /]([0-9.]{1,10})" => "\\1",
      "Sunrise2[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.sunrisebrowser.com/"
  ),
  "sunrisefeeds" => array(
    "icon" => "question",
    "title" => "Sunrise Feeds",
    "rule" => array(
      "^Sunrise[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "swift" => array(
    "icon" => "swift",
    "title" => "Swift",
    "rule" => array(
      "Swift[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.getswift.org/"
  ),
  "swiftfox" => array(
    "icon" => "swiftfox",
    "title" => "Swiftfox",
    "rule" => array(
      "Swiftfox[ /]?([0-9.]{1,10})?" => "\\1"
    ),
    "uri" => "http://getswiftfox.com/"
  ),
  "sylera" => array(
    "icon" => "question",
    "title" => "Sylera",
    "rule" => array(
      "Sylera[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.zawameki.net/izmi/prog/sylera_en.html"
  ),
  "syndirella" => array(
    "icon" => "question",
    "title" => "Syndirella",
    "rule" => array(
      "Syndirella[/ ]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://sourceforge.net/projects/syndirella/"
  ),
  "thunderbird" => array(
    "icon" => "thunderbird",
    "title" => "Thunderbird",
    "rule" => array(
      "Thunderbird[ /]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "tonline" => array(
    "icon" => "tonline",
    "title" => "T-Online",
    "rule" => array(
      "^T-Online Browser" => "\\1"
    ),
    "uri" => ""
  ),
  "upbrowser" => array(
    "icon" => "upbrowser",
    "title" => "UP.Browser",
    "rule" => array(
      "UP\.Browser[ /]([0-9.]{1,10})" => "\\1",
      "UP\.Link[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "uzbl" => array(
    "icon" => "uzbl",
    "title" => "Uzbl",
    "rule" => array(
      "Uzbl" => ""
    ),
    "uri" => "http://www.uzbl.org/"
  ),
  "vienna" => array(
    "icon" => "vienna",
    "title" => "Vienna",
    "rule" => array(
      "Vienna[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://vienna-rss.sourceforge.net/"
  ),
  "vlc" => array(
    "icon" => "vlc",
    "title" => "VLC",
    "rule" => array(
      "^VLC media player - version ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.videolan.org/vlc/"
  ),
  "voyager" => array(
    "icon" => "voyager",
    "title" => "Voyager",
    "rule" => array(
      "voyager[ /]([0-9.]{1,10})" => "\\1",
      "AmigaVoyager" => "",
      " Voyager" => ""
    ),
    "uri" => "http://v3.vapor.com/"
  ),
  "w3clinemode" => array(
    "icon" => "question",
    "title" => "W3C Line Mode",
    "rule" => array(
      "W3CLineMode/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.w3.org/LineMode"
  ),
  "w3m" => array(
    "icon" => "w3m",
    "title" => "w3m",
    "rule" => array(
      "w3m/([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "wannabe" => array(
    "icon" => "question",
    "title" => "WannaBe",
    "rule" => array(
      "^WannaBe" => ""
    ),
    "uri" => "http://mindstory.com/wb2/"
  ),
  "warrior" => array(
    "icon" => "warrior",
    "title" => "Warrior",
    "rule" => array(
      "^Warrior" => ""
    ),
    "uri" => ""
  ),
  "webcapture" => array(
    "icon" => "question",
    "title" => "WebCapture (Adobe)",
    "rule" => array(
      "WebCapture[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "webtv" => array(
    "icon" => "webtv",
    "title" => "Webtv",
    "rule" => array(
      "webtv[ /]([0-9.]{1,10})" => "\\1",
      "webtv" => ""
    ),
    "uri" => ""
  ),
  "winamp" => array(
    "icon" => "winamp",
    "title" => "Winamp",
    "rule" => array(
      "^WinampMPEG[ /]([0-9.]{1,10})" => "\\1",
      "^Nullsoft Winamp3 version[ /]([0-9.a-z]{1,10})" => "\\1",
      "NSV Player"  => ""
    ),
    "uri" => "http://www.winamp.com/"
  ),
  "wyzo" => array(
    "icon" => "wyzo",
    "title" => "Wyzo",
    "rule" => array(
      "Wyzo[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.wyzo.com/"
  ),
  "xiino" => array(
    "icon" => "xiino",
    "title" => "Xiino",
    "rule" => array(
      "^Xiino[ /]([0-9a-z.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.access-us-inc.com/"
  ),
  "xine" => array(
    "icon" => "xine",
    "title" => "xine",
    "rule" => array(
      "^xine[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://xine.sourceforge.net/"
  ),
  "yahoomessenger" => array(
    "icon" => "yahoo",
    "title" => "Yahoo Messenger",
    "rule" => array(
      "^Y(!)*TunnelPro" => ""
    ),
    "uri" => "http://messenger.yahoo.com/"
  ),
  "zipcommander" => array(
    "icon" => "question",
    "title" => "ZipCommander",
    "rule" => array(
      "ZipCommander" => ""
    ),
    "uri" => "http://www.zipcommander.com/"
  ),
  "zootycoon2" => array(
    "icon" => "question",
    "title" => "Zoo Tycoon 2",
    "rule" => array(
      "Zoo Tycoon 2 Client" => ""
    ),
    "uri" => "http://www.zootycoon.com/"
  ),
  // Catch up for the originals, they got to stay in that order.
  "explorer" => array(
    "icon" => "explorer",
    "title" => "Explorer",
    "rule" => array(
      ".*MSIE 7.0.*Trident.*" => "text:8.0 (MSIE 7.0)", //special feature, to detect IE8 Compatibility mode
      "Trident/7.0.*rv:([0-9.+]{1,10})" => "\\1",
      "\(compatible; MSIE[ /]([0-9a-z.]{1,10})" => "\\1",
      "MSIE[ /]([0-9a-z.]{1,3})" => "\\1",
      "Internet Explorer[ /]([0-9.]{1,10})" => "\\1",
      "^Auto-Proxy Downloader" => ""
    ),
    "uri" => "http://www.microsoft.com/windows/ie/"
  ),
  "chrome" => array(
	"icon" => "chrome",
	"title" => "Chrome",
	"rule" => array(
	  "Chrome/([0-9.]{1,15})" => "\\1"
	),
	"uri" => "http://www.google.com/chrome/"
  ),
  "safari" => array(
    "icon" => "safari",
    "title" => "Safari",
    "rule" => array(
      "version/([0-9.]{1,10})(.*)safari" => "\\1",
      "Safari[ /]?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "netscape" => array(
    "icon" => "netscape",
    "title" => "Netscape",
    "rule" => array(
      "netscape[0-9]?/([0-9.]{1,10})" => "\\1",
      "navigator[0-9]?/([0-9.]{1,10})" => "\\1",
      "^mozilla/([0-4]\.[0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.netscape.com/"
  ),
  "firefox"  => array(
    "icon"  => "firefox",
    "title" => "Firefox",
    "rule"  => array(
      "Firefox/([0-9.+]{1,10})" => "\\1",
      "BonEcho/([0-9.+]{1,10})" => "\\1",		// Firefox 2.0 beta
      "GranParadiso/([0-9.+]{1,10})" => "\\1",	// Firefox 3.0 alpha
      "Minefield/([0-9.+]{1,10})" => "\\1",		// Firefox 3.0 beta
      "Shiretoko/([0-9a-z.+]{1,10})" => "\\1",	// Firefox 3.1 alpha
      "Namoroka/([0-9a-z.+]{1,10})" => "\\1",	// Firefox 3.6 beta
      "Firefox" => ""
    ),
    "uri" => "http://www.mozilla.org/projects/firefox/",
    "known" => array(
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.1) Gecko/20061019 Firefox" => "Firefox nightly on Windows XP",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; nl-NL; rv:1.7.5) Gecko/20041202 Firefox/1.0" => "Firefox 1.0 on Windows XP (dutch)",
      "Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.7.6) Gecko/20050512 Firefox" => "Firefox 1.0.4 on Ubuntu Linux (AMD64)",
      "Mozilla/5.0 (X11; U; FreeBSD i386; en-US; rv:1.7.8) Gecko/20050609 Firefox/1.0.4" => "Firefox 1.0.4 on FreeBSD (i386)",
      "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.7.9) Gecko/20050711 Firefox/1.0.5" => "Firefox 1.0.5 on Slackware",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.10) Gecko/20050716 Firefox/1.0.6" => "Firefox 1.0.6 on Windows XP",
      "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-GB; rv:1.7.10) Gecko/20050717 Firefox/1.0.6" => "Firefox 1.0.6 on Mac OS X 10.4 PPC",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7" => "Firefox 1.0.7 on Windows XP",
      "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7" => "Firefox 1.0.7 on Mac OS X 10.3 PPC",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8b4) Gecko/20050908 Firefox/1.4" => "Firefox 1.5 beta 1 on Windows XP",
      "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.8b4) Gecko/20050908 Firefox/1.4" => "Firefox 1.5 beta 1 on Mac OS X 10.3 PPC",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; nl; rv:1.8) Gecko/20051107 Firefox/1.5" => "Firefox 1.5 on Windows XP",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.0.1) Gecko/20060111 Firefox/1.5.0.1" => "Firefox 1.5.0.1 on Windows XP",
      "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.0.1) Gecko/20060111 Firefox/1.5.0.1" => "Firefox 1.5.0.1 on Windows Vista",
      "Mozilla/5.0 (BeOS; U; BeOS BePC; en-US; rv:1.9a1) Gecko/20051002 Firefox/1.6a1" => "1.6 alpha 1 on BeOS R5",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8) Gecko/20060321 Firefox/2.0a1" => "2.0 alpha 1 on Windows XP",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; it; rv:1.8.1b1) Gecko/20060710 Firefox/2.0b1" => "2.0 beta 1 on Windows XP",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; it; rv:1.8.1b2) Gecko/20060710 Firefox/2.0b2" => "2.0 beta 2 on Windows XP",
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; it; rv:1.8.1) Gecko/20060918 Firefox/2.0" => "2.0 on Windows XP"
    )
  ),
  "webkit" => array(
    "icon" => "webkit",
    "title" => "Webkit",
    "rule" => array(
      "AppleWebKit/([0-9.]{1,10}).*Gecko" => "\\1"
    ),
    "uri" => "http://webkit.org"
  ),
  "mozilla" => array(
    "icon" => "mozilla",
    "title" => "Mozilla",
    "rule" => array(
      "^mozilla/[5-9]\.[0-9.]{1,10}.+rv:([0-9a-z.+]{1,10})" => "\\1",
      "^mozilla/([5-9]\.[0-9a-z.]{1,10})" => "\\1",
      "GNUzilla/([0-9.+]{1,10})" => "\\1"
    ),
    "uri" => "",
    "known" => array(
      "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.7.8) Gecko/20050511" => "Mozilla 1.7.9 on Linux (american english)",
      "Mozilla/5.0 (X11; U; Linux i686; cs-CZ; rv:1.7.12) Gecko/20050929" => "Mozilla 1.7.12 on Gentoo Linux"
    )
  ),
  "wap" => array(
    "icon" => "question",
    "title" => "WAP",
    "rule" => array(
      "Profile[ /]MIDP-([0-9.+]{1,10})" => "",
      "Configuration[ /]CLDC-([0-9.+]{1,10})" => "",
      "WAP" => "\\1",
      "SonyEricsson([0-9A-Z]{1,10})" => ""
    ),
    "uri" => ""    
  ),
  // Things we don't know by now
  "other" => array(
    "icon" => "question",
    "title" => "other",
    "rule" => array(
      ".*" => ""
    )
  )
);
?>
