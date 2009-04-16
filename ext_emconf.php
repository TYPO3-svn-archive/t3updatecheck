<?php

########################################################################
# Extension Manager/Repository config file for ext: "t3updatecheck"
#
# Auto generated 16-04-2009 19:19
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'TYPO3 Update Check',
	'description' => 'This TYPO3 Extension checks for available TYPO3 Updates and will inform you by email.',
	'category' => 'be',
	'author' => 'Ole Fritz',
	'author_email' => 'ole.fritz@visia.de',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => 'Visia GmbH',
	'version' => '0.0.3',
	'constraints' => array(
		'depends' => array(
			'php' => '5-0.0.0',
			'typo3' => '4.2-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:14:{s:9:"ChangeLog";s:4:"5296";s:21:"ext_conf_template.txt";s:4:"f49b";s:12:"ext_icon.gif";s:4:"d615";s:17:"ext_localconf.php";s:4:"52e7";s:14:"ext_tables.php";s:4:"55c2";s:14:"ext_tables.sql";s:4:"3073";s:33:"icon_tx_t3updatecheck_updates.gif";s:4:"d615";s:16:"locallang_db.xml";s:4:"9538";s:7:"tca.php";s:4:"95ee";s:34:"cli/class.tx_t3updatecheck_cli.php";s:4:"d8b1";s:17:"cli/locallang.xml";s:4:"94b3";s:14:"doc/manual.sxw";s:4:"8f2b";s:19:"doc/wizard_form.dat";s:4:"57c0";s:20:"doc/wizard_form.html";s:4:"0db8";}',
	'suggests' => array(
	),
);

?>