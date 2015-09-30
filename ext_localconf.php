<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\HDNET\Autoloader\Loader::extLocalconf('HDNET', 'tagger');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('HDNET.tagger', 'Tagger', [
    'Tag' => 'list,textcloud'
]);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \HDNET\Tagger\UserFunction\ProcessDatamap::class;
