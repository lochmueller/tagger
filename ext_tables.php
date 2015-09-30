<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\HDNET\Autoloader\Loader::extTables('HDNET', 'tagger');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('HDNET.tagger', 'Tagger', 'Tagger');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tagger_domain_model_tag',
    'EXT:blogger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tagger_domain_model_tag');

// Register BE AJAX Action
$GLOBALS['TYPO3_CONF_VARS']['BE']['AJAX']['Tag::createTag'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('tagger',
        'Classes/Hooks/SuggestReceiverCall.php') . ':Tx_Tagger_Hooks_SuggestReceiverCall->createTag';
