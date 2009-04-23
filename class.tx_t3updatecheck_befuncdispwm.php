<?php
class tx_t3updatecheck_befuncdispwm {
	
	function displayWarningMessages_postProcess (&$warnings) {
		
		// check for higher versions in tx_t3updatecheck_updates table
		// will not inform you about alpha and beta versions as they are no important updates
		$where_clause = 'version > "'.TYPO3_version.'" AND version NOT LIKE "%alpha%" AND version NOT LIKE "%beta%"';
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('version', 'tx_t3updatecheck_updates', $where_clause);
		
		if(mysql_num_rows($res)) {
			$warnings["typo3_update"] = sprintf(
				$GLOBALS['LANG']->sL('LLL:EXT:t3updatecheck/locallang.xml:warning.typo3_update'),
				'<a href="http://www.typo3.org/downloads/" target="_blank">',
				'</a>');
		}
		
	}
	
}
?>