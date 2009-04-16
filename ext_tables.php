<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}
$TCA['tx_t3updatecheck_updates'] = array (
    'ctrl' => array (
        'title'     => 'LLL:EXT:t3updatecheck/locallang_db.xml:tx_t3updatecheck_updates',        
        'label'     => 'uid',    
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY crdate',    
        'delete' => 'deleted',    
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_t3updatecheck_updates.gif',
    ),
);
?>