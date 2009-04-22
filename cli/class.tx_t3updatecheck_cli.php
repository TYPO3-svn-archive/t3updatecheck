<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Your name <email@example.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
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
if (!defined ('TYPO3_cliMode')) 	die ('Access denied: CLI only.');

require_once(PATH_t3lib.'class.t3lib_cli.php');

class tx_t3updatecheck_cli extends t3lib_cli {
	var $prefixId      = 'tx_userimport_cli';		// Same as class name
	var $scriptRelPath = 'cli/class.tx_t3updatecheck_cli.php';	// Path to this script relative to the extension dir.
	var $extKey        = 't3updatecheck';	// The extension key.
	
	var $importDirPath = "";

	function tx_t3updatecheck_cli() {
		parent::t3lib_cli();

		$this->cli_options = array_merge($this->cli_options, array(
		));

		$this->cli_help = array_merge($this->cli_help, array(
			'name' => 't3updatecheck CLI',
			'synopsis' => 'synopsis',
			'description' => 'Looks for available TYPO3 updates.',
			'examples' => 'typo3/cli_dispatch.phpsh ' . $this->extKey . ' check',
			'author' => '(c) 2009 Ole Fritz <ole.fritz@visia.de>',
		));

		// read backend conf
		$this->conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]);
	}

	function cli_main($argv) {
		// disable output buffer
		ob_end_clean();

		// validate input
		$this->cli_validateArgs();

		// select called function
		switch ((string)$this->cli_args['_DEFAULT'][1]) {
			case 'check':
				$res = $this->compareVersions($res);
				$res = $this->logResult($res);
				break;
			
			default:
				$this->cli_help();
				break;
		}
	}
	
	function getRemoteVersion() {
		
		$xml = simplexml_load_file('http://sourceforge.net/export/rss2_projfiles.php?group_id=20391');

		$remote = array();
		foreach($xml->channel->item as $item) {
			if(stristr($item->description,'typo3_src')) {
				$temp['title'] = explode(' ',$item->title);
				$update['tstamp'] = time();
				$update['version'] = $temp['title'][5];
				//$update['date'] = (string) $item->pubDate;
				//$update['author'] = (string) $item->author;
				$update['details'] = (string) $item->link;
				$update['status'] = '1';
				$remote[] = $update;
			}
		}

		return $remote;
		
	}
	
	function compareVersions() {

		$remote = $this->getRemoteVersion();

		$log = '';
		foreach($remote as $update) {
			if(version_compare(TYPO3_version,$update['version'],'<') && (!((stristr($update['version'],'alpha') || stristr($update['version'],'beta')) && $this->conf['checkFor'] == 'Stable') || ((stristr($update['version'],'alpha') || stristr($update['version'],'beta')) && $this->conf['checkFor'] == 'Development'))) {
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('version', 'tx_t3updatecheck_updates', 'version = "'.$update['version'].'"');
				if(!mysql_num_rows($res)) {
					$res = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_t3updatecheck_updates', $update);
					$log['updates'] .= $update['version'].' ';
				}
			}
		}
		if($log != '') $log['updates'] = str_replace(' ',', ',rtrim($log['updates']));
				
		return $log;
		
	}
	
	function logResult($res, $outputToConsole=true) {
	
		switch($res) {
			case false:
				$logMessage = "There are no new updates available!";
				break;
			default:
				$logMessage = "There are new updates available: ".$res['updates'];
				$logMessageEmail = "The check for updates performed successfully:\n\n".
							  "Site: ".$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename']."\n".
							  "Current version: ".TYPO3_version."\n".
							  "Remote versions: ".$res['updates']."\n";
		}
		
		if (empty($this->conf['logPath'])) $this->conf['logPath'] = 'uploads/tx_t3updatecheck/';
		error_log(date('Y-m-d H:i:s')." $logMessage\n", 3, PATH_site.$this->conf['logPath'].'tx_t3updatecheck.log');
		
		// send  message if defined
		if($logMessageEmail && $this->conf['updateEmail']) {
			$addresses = array();
			$addresses = explode(',',$this->conf['updateEmail']);
			foreach($addresses as $address) {
				mail($address, 'TYPO3 Update Check', $logMessageEmail, '');
			}
		}
		
		if($outputToConsole) {
			$this->cli_echo($logMessage."\n");
		}
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3updatecheck/cli/class.tx_t3updatecheck_cli.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3updatecheck/cli/class.tx_t3updatecheck_cli.php']);
}

$t3updatecheck = t3lib_div::makeInstance('tx_t3updatecheck_cli');
$t3updatecheck->cli_main($_SERVER['argv']);
?>