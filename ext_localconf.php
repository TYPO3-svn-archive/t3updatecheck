<?php
  ## Setting up script that can be run through cli_dispatch.phpsh
if (TYPO3_MODE == 'BE') {
	$TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys'][$_EXTKEY] = array('EXT:'.$_EXTKEY.'/cli/class.tx_t3updatecheck_cli.php','_CLI_cronjob');
}
?>