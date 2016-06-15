<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\HDNET\Autoloader\Loader::extTables('HDNET', 'tagger');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('HDNET.tagger', 'Tagger', 'Tagger');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_tagger_domain_model_tag',
    'EXT:blogger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tagger_domain_model_tag');

$GLOBALS['TYPO3_CONF_VARS']['BE']['AJAX']['Tag::createTag'] = \HDNET\Tagger\Hooks\SuggestReceiver::class . '->createTag';
