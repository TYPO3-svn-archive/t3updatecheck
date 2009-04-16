<?php
if (!defined ('TYPO3_MODE'))     die ('Access denied.');

$uploadfolder = "uploads/tx_t3updatecheck";

$TCA['tx_t3updatecheck_updates'] = array (
    'ctrl' => $TCA['tx_t3updatecheck_updates']['ctrl'],
    'interface' => array (
        'showRecordFieldList' => 'version,details,status'
    ),
    'feInterface' => $TCA['tx_t3updatecheck_updates']['feInterface'],
    'columns' => array (
        'version' => array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:t3updatecheck/locallang_db.xml:tx_t3updatecheck_updates.version',        
            'config' => array (
                'type' => 'input',    
                'size' => '30',
            )
        ),
        'details' => array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:t3updatecheck/locallang_db.xml:tx_t3updatecheck_updates.details',        
            'config' => array (
                'type'     => 'input',
                'size'     => '15',
                'max'      => '255',
                'checkbox' => '',
                'eval'     => 'trim',
                'wizards'  => array(
                    '_PADDING' => 2,
                    'link'     => array(
                        'type'         => 'popup',
                        'title'        => 'Link',
                        'icon'         => 'link_popup.gif',
                        'script'       => 'browse_links.php?mode=wizard',
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                    )
                )
            )
        ),
        'status' => array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:t3updatecheck/locallang_db.xml:tx_t3updatecheck_updates.status',        
            'config' => array (
                'type' => 'select',
                'items' => array (
                    array('LLL:EXT:t3updatecheck/locallang_db.xml:tx_t3updatecheck_updates.status.I.0', '0'),
                    array('LLL:EXT:t3updatecheck/locallang_db.xml:tx_t3updatecheck_updates.status.I.1', '1'),
                    array('LLL:EXT:t3updatecheck/locallang_db.xml:tx_t3updatecheck_updates.status.I.2', '2'),
                ),
                'size' => 1,    
                'maxitems' => 1,
            )
        ),
    ),
    'types' => array (
        '0' => array('showitem' => 'version;;;;1-1-1, details, status')
    ),
    'palettes' => array (
        '1' => array('showitem' => '')
    )
);
?>