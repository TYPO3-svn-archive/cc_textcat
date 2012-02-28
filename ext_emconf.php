<?php

########################################################################
# Extension Manager/Repository config file for ext "cc_textcat".
#
# Auto generated 28-02-2012 23:19
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'textLang: TextCat',
	'description' => 'Language guessing service using the external Perl script TextCat.',
	'category' => 'services',
	'shy' => 0,
	'version' => '2.0.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Rene Fritz',
	'author_email' => 'r.fritz@colorcube.de',
	'author_company' => 'Colorcube - digital media lab, www.colorcube.de',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '3.0.0-0.0.0',
			'typo3' => '3.5.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:84:{s:12:"ext_icon.gif";s:4:"62e5";s:14:"ext_tables.php";s:4:"2afa";s:14:"doc/manual.sxw";s:4:"8e15";s:30:"sv1/class.tx_cctextcat_sv1.php";s:4:"6b94";s:15:"textcat/CHANGES";s:4:"e5e3";s:17:"textcat/Copyright";s:4:"5c93";s:14:"textcat/README";s:4:"2b09";s:19:"textcat/text_cat.pl";s:4:"6ebe";s:15:"textcat/version";s:4:"91ce";s:26:"textcat/LM/AF-afrikaans.lm";s:4:"137d";s:28:"textcat/LM/AM-amharic-utf.lm";s:4:"cad5";s:33:"textcat/LM/AR-arabic-iso8859_6.lm";s:4:"4a0c";s:35:"textcat/LM/AR-arabic-windows1256.lm";s:4:"7c70";s:36:"textcat/LM/BG-bulgarian-iso8859_5.lm";s:4:"4438";s:23:"textcat/LM/BR-breton.lm";s:4:"1321";s:24:"textcat/LM/BS-bosnian.lm";s:4:"c79a";s:24:"textcat/LM/CA-catalan.lm";s:4:"d924";s:32:"textcat/LM/CS-czech-iso8859_2.lm";s:4:"062c";s:22:"textcat/LM/CY-welsh.lm";s:4:"7328";s:23:"textcat/LM/DA-danish.lm";s:4:"6cee";s:23:"textcat/LM/DE-german.lm";s:4:"7fa7";s:32:"textcat/LM/EL-greek-iso8859-7.lm";s:4:"5f50";s:24:"textcat/LM/EN-english.lm";s:4:"2eda";s:26:"textcat/LM/EO-esperanto.lm";s:4:"7e42";s:24:"textcat/LM/ES-spanish.lm";s:4:"1f62";s:25:"textcat/LM/ET-estonian.lm";s:4:"f0de";s:23:"textcat/LM/EU-basque.lm";s:4:"9506";s:24:"textcat/LM/FA-persian.lm";s:4:"b6e6";s:24:"textcat/LM/FI-finnish.lm";s:4:"0e52";s:23:"textcat/LM/FR-french.lm";s:4:"4d65";s:24:"textcat/LM/FY-frisian.lm";s:4:"3327";s:22:"textcat/LM/GA-irish.lm";s:4:"1356";s:29:"textcat/LM/GD-scots_gaelic.lm";s:4:"c797";s:21:"textcat/LM/GV-manx.lm";s:4:"56cf";s:33:"textcat/LM/HE-hebrew-iso8859_8.lm";s:4:"5ab9";s:22:"textcat/LM/HI-hindi.lm";s:4:"8466";s:31:"textcat/LM/HR-croatian-ascii.lm";s:4:"c45a";s:26:"textcat/LM/HU-hungarian.lm";s:4:"6dc9";s:25:"textcat/LM/HY-armenian.lm";s:4:"f89d";s:27:"textcat/LM/ID-indonesian.lm";s:4:"3dc2";s:26:"textcat/LM/IS-icelandic.lm";s:4:"92a1";s:24:"textcat/LM/IT-italian.lm";s:4:"445c";s:32:"textcat/LM/JA-japanese-euc_jp.lm";s:4:"7ee9";s:35:"textcat/LM/JA-japanese-shift_jis.lm";s:4:"ffe6";s:25:"textcat/LM/KA-georgian.lm";s:4:"5c60";s:23:"textcat/LM/KO-korean.lm";s:4:"acec";s:22:"textcat/LM/LA-latin.lm";s:4:"43f5";s:27:"textcat/LM/LT-lithuanian.lm";s:4:"715e";s:24:"textcat/LM/LV-latvian.lm";s:4:"3e15";s:24:"textcat/LM/MR-marathi.lm";s:4:"5f48";s:22:"textcat/LM/MS-malay.lm";s:4:"2b53";s:23:"textcat/LM/NE-nepali.lm";s:4:"43e2";s:22:"textcat/LM/NL-dutch.lm";s:4:"640f";s:26:"textcat/LM/NO-norwegian.lm";s:4:"a1de";s:23:"textcat/LM/PL-polish.lm";s:4:"ec60";s:27:"textcat/LM/PT-portuguese.lm";s:4:"2602";s:24:"textcat/LM/QU-quechua.lm";s:4:"0192";s:25:"textcat/LM/RO-romanian.lm";s:4:"3b87";s:34:"textcat/LM/RU-russian-iso8859_5.lm";s:4:"8d39";s:31:"textcat/LM/RU-russian-koi8_r.lm";s:4:"ab1d";s:36:"textcat/LM/RU-russian-windows1251.lm";s:4:"be80";s:25:"textcat/LM/SA-sanskrit.lm";s:4:"256f";s:29:"textcat/LM/SK-slovak-ascii.lm";s:4:"0113";s:35:"textcat/LM/SK-slovak-windows1250.lm";s:4:"5ecb";s:32:"textcat/LM/SL-slovenian-ascii.lm";s:4:"979a";s:36:"textcat/LM/SL-slovenian-iso8859_2.lm";s:4:"20c7";s:25:"textcat/LM/SQ-albanian.lm";s:4:"1e96";s:30:"textcat/LM/SR-serbian-ascii.lm";s:4:"21fd";s:24:"textcat/LM/SV-swedish.lm";s:4:"e0c1";s:24:"textcat/LM/SW-swahili.lm";s:4:"2b69";s:22:"textcat/LM/TA-tamil.lm";s:4:"5509";s:21:"textcat/LM/TH-thai.lm";s:4:"cbc2";s:24:"textcat/LM/TL-tagalog.lm";s:4:"517d";s:24:"textcat/LM/TR-turkish.lm";s:4:"f68a";s:33:"textcat/LM/UK-ukrainian-koi8_r.lm";s:4:"4105";s:27:"textcat/LM/VI-vietnamese.lm";s:4:"41ab";s:28:"textcat/LM/YI-yiddish-utf.lm";s:4:"7e61";s:29:"textcat/LM/ZH-chinese-big5.lm";s:4:"b72b";s:31:"textcat/LM/ZH-chinese-gb2312.lm";s:4:"785a";s:33:"textcat/LM/belarus-windows1251.lm";s:4:"57e6";s:28:"textcat/LM/middle_frisian.lm";s:4:"fb36";s:19:"textcat/LM/mingo.lm";s:4:"9113";s:23:"textcat/LM/rumantsch.lm";s:4:"7e1a";s:19:"textcat/LM/scots.lm";s:4:"ea46";}',
);

?>