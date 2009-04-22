<?php
  ## Setting up script to display warning messages in About Modules
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['displayWarningMessages'][] = 'EXT:'.$_EXTKEY.'/class.tx_t3updatecheck_befuncdispwm.php/:tx_t3updatecheck_befuncdispwm';

  ## Setting up script that can be run through cli_dispatch.phpsh
if (TYPO3_MODE == 'BE') {
	$TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys'][$_EXTKEY] = array('EXT:'.$_EXTKEY.'/cli/class.tx_t3updatecheck_cli.php','_CLI_cronjob');
}
?>