<?php
/* This file is part of BBClone (A PHP based Web Counter on Steroids)
 * 
 * SVN FILE $Id: os.php 312 2014-11-22 10:26:50Z joku $
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

/////////////////////////////////////
// OS (Operation System) Detection //
/////////////////////////////////////

$os = array(
  "aix"=> array(
    "icon"=> "aix",
    "title" => "AIX",
    "rule" => array(
      "-aix([0-9.]{1,10})" => "\\1",
      "[ ;\(]aix" => ""
    ),
    "uri" => ""
  ),
  "amiga" => array(
    "icon" => "amiga",
    "title" => "AmigaOS",
    "rule" => array(
      "Amiga[ ]?OS[ /]([0-9.V]{1,10})" => "\\1",
      "amiga" => ""
    ),
    "uri" => ""
  ),
  "android" => array(
    "icon" => "android",
    "title" => "Android",
    "rule" => array(
      "Android ([0-9.]{1,10})" => "\\1",
      "Android" => ""
    ),
    "uri" => "http://www.android.com/"
  ),
  "aptosid" => array(
	"icon" => "aptosid",
	"title" => "aptosid Linux",
	"rule" => array(
	  "aptosid" => ""
	),
	"uri" => "http://aptosid.com/"
  ),
  "arch" => array(
    "icon" => "arch",
    "title" => "Arch Linux",
    "rule" => array(
      "Arch Linux" => ""
    ),
    "uri" => "http://www.archlinux.org/"
  ),
  "atari" => array(
    "icon" => "question",
    "title" => "Atari",
    "rule" => array(
      "atari[ /]([0-9.b]{1,10})" => "\\1"
    ),
    "uri" => "http://www.atari.com/"
  ),
  "atheos" => array(
    "icon" => "atheos",
    "title" => "AtheOS",
    "rule" => array(
      "atheos" => ""
    ),
    "uri" => ""
  ),
  "bada" => array(
    "icon" => "bada",
    "title" => "Bada",
    "rule" => array(
      "Bada[ /]([0-9]{1,10})" => "\\1"
    ),
    "uri" => "http://www.bada.com/"
  ),
  "blackberry" => array(
    "icon" => "blackberry",
    "title" => "BlackBerry OS",
    "rule" => array(
      "BlackBerry" => ""
    ),
    "uri" => "http://www.blackberry.com/"
  ),
  "bluecoat" => array(
    "icon" => "bluecoat",
    "title" => "Bluecoat DRTR",
    "rule" => array(
      "bluecoat drtr" => "\\1"
    ),
    "uri" => ""
  ),
  "brew" => array(
    "icon" => "brewmp",
    "title" => "Brew MP",
    "rule" => array(
      "BREW[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.brewmp.com/"
  ),
  "centos" => array(
    "icon" => "centos",
    "title" => "CentOS",
    "rule" => array(
      "centos([0-9]{1})" => "\\1",
      "el([0-9.]{1}).*centos" => "\\1",
      "CentOS" => ""
    ),
    "uri" => "http://www.centos.org/"
  ),
  "cerberian" => array(
    "icon" => "bluecoat",
    "title" => "Cerberian DRTR",
    "rule" => array(
      "Cerberian Drtrs Version[ /\-]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "c64" => array(
    "icon" => "c64",
    "title" => "Commodore 64",
    "rule" => array(
      "Commodore[ ]?64" => ""
    ),
    "uri" => ""
  ),
  "darwin" => array(
    "icon" => "darwin",
    "title" => "Darwin",
    "rule" => array(
      "Darwin[ ]?([0-9.]{1,10})" => "\\1",
      "Darwin" => ""
    ),
    "uri" => ""
  ),
  "digital" => array(
    "icon" => "digital",
    "title" => "Digital",
    "rule" => array(
      "OSF[0-9][ ]?V(4[0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "dreamcast" => array(
    "icon" => "dreamcast",
    "title" => "SEGA Dreamcast",
    "rule" => array(
      "\(SonicPassport\)" => "",
      "\(Dream(Passport|Key)[ /]([0-9.]{1,10})\)" => "",
      "\(Dream(Passport|Key)[ /]([0-9.]{1,10}); ([A-Z.a-z/]{1,50})\)" => "",
      "\(Planetweb[ /]([0-9.a-z]{1,10})" => ""
    ),
    "uri" => "http://css.vis.ne.jp/dp-agent.shtml"
  ),
  "embedix" => array(
    "icon" => "question",
    "title" => "Embedix",
    "rule" => array(
     "Embedix" => ""
    ),
    "uri" => ""
  ),
  "Fedora Linux" => array(
    "icon" => "fedora",
    "title" => "Fedora Linux",
    "rule" => array(
     "Fedora/[0-9.-]+fc([0-9]+)" => "\\1",
     "fedora" => ""
    ),
    "uri" => "http://fedoraproject.org/"
  ),
  "fenix" => array(
    "icon" => "question",
    "title" => "Fenix",
    "rule" => array(
     "Fenix" => ""
    ),
    "uri" => ""
  ),
  "freebsd" => array(
    "icon" => "freebsd",
    "title" => "FreeBSD",
    "rule" => array(
     "free[ \-]?bsd[ /]([a-z0-9._]{1,10})" => "\\1",
     "free[ \-]?bsd" => ""
    ),
    "uri" => "http://www.freebsd.org/"
  ),
  "gentoo" => array(
    "icon" => "gentoo",
    "title" => "Gentoo Linux",
    "rule" => array(
      "gentoo" => ""
    ),
    "uri" => "http://www.gentoo.org/"
  ),
  "haiku" => array(
    "icon" => "haiku",
    "title" => "Haiku",
    "rule" => array(
      "Haiku BePC" => ""
    ),
    "uri" => "http://www.haiku-os.org/"
  ),
  "hiptop" => array(
    "icon" => "question",
    "title" => "hiptop",
    "rule" => array(
      "Danger hiptop ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "hpux" => array(
    "icon" => "hp",
    "title" => "HPUX",
    "rule" => array(
      "hp[ \-]?ux[ /]([a-z0-9._]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "ios" => array(
    "icon" => "ios",
    "title" => "iOS",
    "rule" => array(
      "i(Phone|Pod|Pad).*OS[ /]([0-9]{1,10})_([0-9]{1,10})" => "\\2.\\3",
      "i(Phone|Pod|Pad)" => ""
    ),
    "uri" => "http://www.apple.com/ios/"
  ),
  "irix" => array(
    "icon" => "irix",
    "title" => "IRIX",
    "rule" => array(
      "irix[0-9]*[ /]([0-9.]{1,10})" => "\\1",
      "irix" => ""
    ),
    "uri" => ""
  ),
  "macosx" => array(
    "icon" => "macosx",
    "title" => "MacOS X",
    "rule" => array(
      "Mac[ _]OS[ _]X[ /_]([0-9]{1,10})[._]([0-9]{1,10})[._]([0-9]{1,10})" => "\\1.\\2.\\3",
      "Mac[ _]OS[ _]X[ /_]([0-9]{1,10})[._]([0-9]{1,10})" => "\\1.\\2",
      "Mac[ _]OS[ _]X" => "",
      "Mac 10.([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.apple.com/macosx/"
  ),
  "macppc" => array(
    "icon" => "macppc",
    "title" => "MacOS PPC",
    "rule" => array(
      "Mac(_Power|intosh.+P)PC" => ""
    ),
    "uri" => ""
  ),
  "mandriva" => array(
    "icon" => "mandriva",
    "title" => "Mandriva",
    "rule" => array(
      "Mandriva[ /]([0-9.]{1,10})" => "\\1",
      "Linux[ /\-]([0-9.-]{1,10}).mdk" => "",
      "Linux[ /\-]([0-9.-]{1,10}).mdv" => "\\1"
    ),
    "uri" => "http://www.mandriva.com/"
  ),

  "minix" => array(
	"icon" => "minix",
	"title" => "Minix",
	"rule" => array(
	  "Minix[/ ]?([0-9.]{1,10})?" => "\\1"
	),
	"uri" => "http://www.minix3.org/"
  ),
  "mint" => array(
    "icon" => "mint",
    "title" => "Linux Mint",
    "rule" => array(
      "Linux Mint[/ ]?([0-9.]{1,10})?" => "\\1"
    ),
    "uri" => ""
  ),
  "morphos" => array(
    "icon" => "morphos",
    "title" => "MorphOS",
    "rule" => array(
      "MorphOS[ /]([0-9.]{1,10})" => "\\1",
      "MorphOS" => ""
    ),
    "uri" => ""
  ),
  "netbsd" => array(
    "icon" => "netbsd",
    "title" => "NetBSD",
    "rule" => array(
      "net[ \-]?bsd[ /]([a-z0-9._]{1,10})" => "\\1",
      "net[ \-]?bsd" => ""
    ),
    "uri" => ""
  ),
  "nintendods" => array(
    "icon" => "ds",
    "title" => "Nintento DS",
    "rule" => array(
      "Nintendo DS v([0-9.]{1,10})" => ""
    ),
    "uri" => ""
  ),
  "openbsd" => array(
    "icon" => "openbsd",
    "title" => "OpenBSD",
    "rule" => array(
      "open[ \-]?bsd[ /]([a-z0-9._]{1,10})" => "\\1",
      "open[ \-]?bsd" => ""
    ),
    "uri" => ""
  ),
  "openvms" => array(
    "icon" => "openvms",
    "title" => "OpenVMS",
    "rule" => array(
      "Open[ \-]?VMS[ /]([a-z0-9._]{1,10})" => "\\1",
      "Open[ \-]?VMS" => ""
    ),
    "uri" => ""
  ),
  "palm" => array(
    "icon" => "palm",
    "title" => "PalmOS",
    "rule" => array(
      "Palm[ \-]?(Source|OS)[ /]?([0-9.]{1,10})" => "\\2",
      "Palm[ \-]?(Source|OS)" => ""
    ),
    "uri" => ""
  ),
  "pclinux" => array(
    "icon" => "pclinux",
    "title" => "PCLinuxOS",
    "rule" => array(
      "PCLinuxOS[ /]?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.pclinuxos.com/"
  ),
  "photon" => array(
    "icon" => "qnx",
    "title" => "QNX Photon",
    "rule" => array(
      "photon" => "",
      "QNX" => ""
    ),
    "uri" => "http://www.qnx.com/"
  ),
  "psp" => array(
    "icon" => "playstation",
    "title" => "PlayStation Portable",
    "rule" => array(
      "PlayStation Portable.* ([0-9._]{1,10})" => "\\1",
      "PlayStation Portable" => ""
    ),
    "uri" => ""
  ),
  "playstation" => array(
    "icon" => "playstation",
    "title" => "PlayStation",
    "rule" => array(
      "PlayStation" => "",
      "PS2" => ""
    ),
    "uri" => ""
  ),
  "pld" => array(
    "icon" => "pld",
    "title" => "PLD Linux",
    "rule" => array(
      "PLD[ /]?([0-9.]{1,10})" => "\\1",
      "PLD" => ""
    ),
    "uri" => "http://www.pld-linux.org/"
  ),
  "reactos" => array(
    "icon" => "reactos",
    "title" => "ReactOS",
    "rule" => array(
      "ReactOS[ /]?([0-9.]{1,10})" => "\\1",
      "ReactOS" => ""
    ),
    "uri" => "http://www.reactos.org/"
  ),
  "redhat" => array(
    "icon" => "redhat",
    "title" => "RedHat",
    "rule" => array(
      "Red Hat[ /]?([0-9.]{1,10})" => "\\1",
      "RedHat" => ""
    ),
    "uri" => "http://www.redhat.com/"
  ),
  "risc" => array(
    "icon" => "risc",
    "title" => "RiscOS",
    "rule" => array(
      "risc[ \-]?os[ /]?([0-9.]{1,10})" => "\\1",
      "risc[ \-]?os" => ""
    ),
    "uri" => ""
  ),
  "slitaz" => array(
    "icon" => "slitaz",
    "title" => "SliTaz Linux",
    "rule" => array(
      "SliTaz" => ""
    ),
    "uri" => "http://www.slitaz.org/"
  ),
  "suse" => array(
    "icon" => "suse",
    "title" => "SuSE Linux",
    "rule" => array(
      "suse" => ""
    ),
    "uri" => "http://www.novell.com/linux/"
  ),
  "sun" => array(
    "icon" => "sun",
    "title" => "SunOS",
    "rule" => array(
      "sun[ \-]?os[ /]?([0-9.]{1,10})" => "\\1",
      "sun[ \-]?os" => "",
      "^SUNPlex[ /]?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "symbian" => array(
    "icon"  => "symbian",
    "title" => "Symbian OS",
    "rule"  => array(
      "symbian[ \-]?os[ /]?([0-9.]{1,10})" => "\\1",
      "symbOS" => "",
      "symbian" => ""
    ),
    "uri" => ""
  ),
 "trisquel" => array(
    "icon" => "trisquel",
    "title" => "Trisquel GNU Linux",
    "rule" => array(
      "Trisquel[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://trisquel.info/"
  ),
  "tru64" => array(
    "icon" => "tru64",
    "title" => "Tru64",
    "rule" => array(
      "OSF[0-9][ ]?V(5[0-9.]{1,10})" => "\\1"
    ),
    "uri" => ""
  ),
  "ubuntu" => array(
    "icon" => "ubuntu",
    "title" => "Ubuntu Linux",
    "rule" => array(
      "ubuntu/([0-9.]+)" => "\\1",
      "ubuntu" => ""
    ),
    "uri" => "http://www.ubuntu.com/"
  ),
  "unixware" => array(
    "icon" => "sco",
    "title" => "UnixWare",
    "rule" => array(
      "unixware[ /]?([0-9.]{1,10})" => "\\1",
      "unixware" => ""
    ),
    "uri" => ""
  ),
  "wii" => array(
    "icon" => "wii",
    "title" => "Wii",
    "rule" => array(
      "^Nintendo Wii" => "",
      " wii" => ""
    ),
    "uri" => "http://www.wii.com/"
  ),
  "webos" => array(
    "icon" => "palm",
    "title" => "web OS",
    "rule" => array(
      "webOS[ /]?([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.palm.com/"
  ),
  "windowsphone" => array(
    "icon" => "windowsphone",
    "title" => "Windows Phone",
    "rule" => array(
      "Windows Phone ([0-9.]{1,10})" => "\\1",
      "Windows Phone OS ([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.windowsphone.com"
  ),	
  "windowsxp64" => array(
    "icon" => "windowsxp",
    "title" => "Windows XP (64-bit)",
    "rule" => array(
      "wi(n|ndows)[ \-]?(2003|nt[ /]?5\.2).*(WOW64|Win64)" => ""
    ),
    "uri" => "http://www.microsoft.com/windowsxp/64bit/"
  ),
  "windows2003" => array(
    "icon" => "windowsxp",
    "title" => "Windows 2003",
    "rule" => array(
      "wi(n|ndows)[ \-]?(2003|nt[ /]?5\.2)" => ""
    ),
    "uri" => "http://www.microsoft.com/windowsserver2003/"
  ),
  "windows2k" => array(
    "icon" => "windows",
    "title" => "Windows 2000",
    "rule" => array(
      "wi(n|ndows)[ \-]?(2000|nt[ /]?5\.0)" => ""
    ),
    "uri" => "http://www.microsoft.com/windows2000/"
  ),
  "windows31" => array(
    "icon" => "windows31",
    "title" => "Windows 3.1",
    "rule" => array(
      "wi(n|ndows)[ \-]?3\.[1]+" => "",
      "Win16" => ""
    ),
    "uri" => ""
  ),
  "windows95" => array(
    "icon" => "windows",
    "title" => "Windows 95",
    "rule" => array(
      "wi(n|ndows)[ \-]?95" => ""
    ),
    "uri" => "http://www.microsoft.com/windows95/"
  ),
  "windowsce" => array(
    "icon" => "windowsce",
    "title" => "Windows CE",
    "rule" => array(
      "wi(n|ndows)[ \-]?ce" => "",
      "wi(n|ndows)[ /.;]*mobile" => "",
      "(Microsoft|Windows) Pocket" => ""
    ),
    "uri" => "http://www.microsoft.com/windows/embedded/"
  ),
  "windowsme" => array(
    "icon" => "windowsme",
    "title" => "Windows ME",
    "rule" => array(
      "win 9x 4\.90" => "",
      "wi(n|ndows)[ \-]?me" => ""
    ),
    "uri" => "http://www.microsoft.com/windowsme/"
  ),
  "windowsvista" => array(
    "icon" => "windowsvista",
    "title" => "Windows Vista",
    "rule" => array(
      "Windows Vista" => "",
      "wi(n|ndows)[ \-]?nt[ /]?6\.0" => "",
      "wi(n|ndows)[ \-]?6\.0" => ""
    ),
    "uri" => "http://www.microsoft.com/windowsvista/"
  ),
  "windows7" => array(
    "icon" => "windows7",
    "title" => "Windows 7",
    "rule" => array(
      "wi(n|ndows)[ \-]?nt[ /]?6\.1" => ""
    ),
    "uri" => "http://www.microsoft.com/windows/windows-7/"
  ),
  "windowsrt" => array(
	"icon" => "windows8",
	"title" => "Windows RT",
	"rule" => array(
	  "wi(n|ndows)[ \-]?nt[ /]?6\.2; ARM" => "",
	  "wi(n|ndows)[ \-]?nt[ /]?6\.3; ARM" => ""
	),
	"uri" => "http://www.microsoft.com/windows/"
  ),
  "windows8" => array(
	"icon" => "windows8",
	"title" => "Windows 8",
	"rule" => array(
	  "wi(n|ndows)[ \-]?nt[ /]?6\.2" => "",
	  "wi(n|ndows)[ \-]?nt[ /]?6\.3" => ""
	),
	"uri" => "http://www.microsoft.com/windows/"
  ),
  "windows10" => array(
    "icon" => "windows8",
    "title" => "Windows 10",
    "rule" => array(
     "wi(n|ndows)[ \-]?nt[ /]?6\.4" => ""
    ),
	"uri" => "http://www.microsoft.com/windows/"
  ),
  "windowsmc" => array(
    "icon" => "windowsxp",
    "title" => "Windows Media Center",
    "rule" => array(
      "Media Center PC[ /]([0-9.]{1,10})" => "\\1"
    ),
    "uri" => "http://www.microsoft.com/windowsxp/mediacenter/"
  ),
  "windowsxp" => array(
    "icon" => "windowsxp",
    "title" => "Windows XP",
    "rule" => array(
      "Windows XP" => "",
      "wi(n|ndows)[ \-]?nt[ /]?5\.1" => ""
    ),
    "uri" => "http://www.microsoft.com/windowsxp/"
  ),
  "zenwalk" => array(
    "icon" => "zenwalk",
    "title" => "Zenwalk",
    "rule" => array(
      "Zenwalk GNU Linux" => ""
    ),
    "uri" => "http://www.zenwalk.org/"
  ),
  // Catch up for the originals, they got to stay in that order.
  "debian" => array(
    "icon" => "debian",
    "title" => "Debian Linux",
    "rule" => array(
      "debian" => ""
    ),
    "uri" => "http://www.debian.org/"
  ),
  "beos" => array(
    "icon" => "be",
    "title" => "BeOS",
    "rule" => array(
      "beos[ a-z]*([0-9.]{1,10})" => "\\1",
      "beos" => ""
    ),
    "uri" => ""
  ),
  "bsd" => array(
    "icon" => "bsd",
    "title" => "BSD",
    "rule" => array(
      "bsd" => ""
    ),
    "uri" => ""
  ),
  "linux" => array(
    "icon" => "linux",
    "title" => "Linux",
    "rule" => array(
      "linux[ /\-]([a-z0-9._]{1,10})" => "\\1",
      "linux" => ""
    ),
    "uri" => "http://www.kernel.org/"
  ),
  "os2" => array(
    "icon" => "os2",
    "title" => "OS/2 Warp",
    "rule" => array(
      "warp[ /]?([0-9.]{1,10})" => "\\1",
      "os[ /]?2" => ""
    ),
    "uri" => ""
  ),
  "mac" => array(
    "icon" => "mac",
    "title" => "MacOS",
    "rule" => array(
      "mac[^hk]" => ""
    ),
    "uri" => ""
  ),
  "windowsnt" => array(
    "icon" => "windows",
    "title" => "Windows NT",
    "rule" => array(
      "wi(n|ndows)[ \-]?nt[ /]?([0-4][0-9.]{1,10})" => "\\2",
      "wi(n|ndows)[ \-][ /]?([0-4][0-9.]{1,10})" => "\\2",
      "wi(n|ndows)[ \-]?nt" => ""
    ),
    "uri" => "http://www.microsoft.com/windowsnt/"
  ),
  "windows98" => array(
    "icon" => "windows",
    "title" => "Windows 98",
    "rule" => array(
      "wi(n|ndows)[ \-]?98" => ""
    ),
    "uri" => "http://www.microsoft.com/windows98/"
  ),
  "windows" => array(
    "icon" => "windows",
    "title" => "Windows",
    "rule" => array(
      "wi(n|n32|n64|ndows)" => ""
    ),
    "uri" => ""
  ),
  "java" => array(
    "icon" => "java",
    "title" => "Java Platform Micro Edition",
    "rule" => array(
      "J2ME/MIDP" => ""
    ),
    "uri" => "http://java.sun.com/"
  ),
  "mobile" => array(
    "icon" => "mobile",
    "title" => "Mobile",
    "rule" => array(
      "LG[ /]([0-9A-Z]{1,10})" => "",
      "MOT[ /\-]([0-9A-Z]{1,10})" => "",
      "SonyEricsson([0-9A-Z]{1,10})" => "",
      "SIE([0-9A-Z]{1,10})" => "",
      "Nokia([0-9A-Z]{1,10})" => "",
      "KDDI-([0-9A-Z]{1,10})" => "",
      "^[A-Z]([0-9]{1,3}) " => "",
      "Configuration[ /]CLDC([0-9.]{1,10})" => "\\1",
      "MIDP" => "",
      "UP\.(Browser|Link)" => "",
      "ibisBrowser" => "",
      "Mobile" => ""
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
