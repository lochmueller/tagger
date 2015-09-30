<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\HDNET\Autoloader\Loader::extLocalconf('HDNET', 'tagger');


/**
 * Use in your extension:
 *
 *
 TCA Configuration:

'tags' => array(
	'exclude' => 0,
	'label' => 'LLL:EXT:blogger/Resources/Private/Language/locallang_db.xml:tx_blogger_domain_model_post.content',
	'config' => Tx_Tagger_Service_IntegrationService::getTagFieldConfiguration('tx_blogger_domain_model_post'),
),
 */


// Register Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'HDNET.' . $_EXTKEY,
	'Tagger',
	[
		'Tag' => 'list,textcloud'
	]);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \HDNET\Tagger\UserFunction\ProcessDatamap::class;
?>