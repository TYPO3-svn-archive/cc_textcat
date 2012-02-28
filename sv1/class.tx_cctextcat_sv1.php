<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2003-2006 Rene Fritz (r.fritz@colorcube.de)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * servivc 'textcat' for the 'cc_textcat' extension.
 *
 * @author	Rene Fritz <r.fritz@colorcube.de>
 */


require_once(PATH_t3lib.'class.t3lib_svbase.php');
require_once(PATH_t3lib.'class.t3lib_exec.php');

class tx_cctextcat_sv1 extends t3lib_svbase {
	var $prefixId = 'tx_cctextcat_sv1';		// Same as class name
	var $scriptRelPath = 'sv1/class.tx_cctextcat_sv1.php';	// Path to this script relative to the extension dir.
	var $extKey = 'cc_textcat';	// The extension key.



	/**
	 * performs the language detection
	 *
	 * @param	string 	Content which should be processed.
	 * @param	string 	unused
	 * @param	array 	Configuration array
	 * @return	boolean
	 */
	function process($content='', $type='', $conf=array())	{

		$this->out='';
		if (!$content) {
			$content = $this->getInput();
		}
		if ($content) {
				// remove words in uppercase which seems to confuse TextCat
			$content = preg_replace('#\b[A-Z]{2,}\b#', ' ', $content);

			$this->setInput ($content, $type);
		}

		if($inputFile = $this->getInputFile()) {

			$cmd = t3lib_exec::getCommand('perl');
			$cmd.=' '.t3lib_extMgm::extPath('cc_textcat').'textcat/text_cat.pl';
			$cmd.=' -d '.t3lib_extMgm::extPath('cc_textcat').'textcat/LM/';
			$cmd.=' 2>&1';
			$cmd.=' <'.$inputFile;
			if ($fpw = @popen ($cmd, 'r')) {

				$read=@fread($fpw, 200);
				@pclose($fpw);

				$lang = explode(' or ',$read);
				$lang = explode('-',$lang[0]);
				$lang = $lang[0];
			}

			if(strlen($lang)==2) {
				$this->out=$lang;
			} else {
				$this->out=FALSE; // no iso code - better set to false
			}

		} else {
			$this->errorPush(T3_ERR_SV_NO_INPUT, 'No or empty input.');
		}

		return $this->getLastError();
	}


/* 	used to rename original LM files with ISO prefix

	function changeTextcatLMfilesToIso () {
		$path = t3lib_extMgm::extPath('cc_textcat').'textcat/LM/';

		$handle=opendir($path);
		while ($file = readdir ($handle)) {
			if ($file != '.' && $file != '..') {

				list($lang) = explode('.',$file);
				list($lang) = explode('-',$lang);

				if(strlen($lang)>2) {
					echo "$file\n";
					echo "$lang\n";

					$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'static_languages', 'lg_name="'.ucfirst($lang).'"');
					if ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))	{
						$newfile=$row['lg_iso_2'].'-'.$file;
						rename ($path.$file, $path.$newfile);
					}

				}
			}
		}
		closedir($handle);
	}
*/
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cc_textcat/sv1/class.tx_cctextcat_sv1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cc_textcat/sv1/class.tx_cctextcat_sv1.php']);
}

?>
