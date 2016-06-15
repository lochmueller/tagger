<?php

/**
 * Integration service
 */

namespace HDNET\Tagger\Service;

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class IntegrationService
 */
class IntegrationService
{

    /**
     * Get the field configuration for a Tag field
     *
     * @param string $tableName
     * @return array
     */
    public static function getTagFieldConfiguration($tableName)
    {
        $config = [
            'type' => 'select',
            'foreign_table' => 'tx_tagger_domain_model_tag',
            'foreign_table_where' => 'ORDER BY tx_tagger_domain_model_tag.title',
            'MM' => 'tx_tagger_tag_mm',
            'MM_hasUidField' => true,
            'multiple' => false,
            'MM_opposite_field' => 'content',
            'MM_match_fields' => [
                'tablenames' => $tableName
            ],
            'size' => 5,
            'autoSizeMax' => 20,
            'minitems' => 0,
            'maxitems' => 30,
            'wizards' => [
                '_PADDING' => 2,
                '_VERTICAL' => 1,
                'suggest' => [
                    'type' => 'suggest',
                    'default' => [
                        'receiverClass' => \HDNET\Tagger\Hooks\SuggestReceiver::class
                    ],
                ],
            ],
        ];

        return $config;
    }

    /**
     * Create a new Tag Record
     *
     * @param string $title
     * @return integer The ID of the New Tag
     */
    public static function createTagRecord($title)
    {
        $tcemainData = [
            'tx_tagger_domain_model_tag' => [
                'NEW' => [
                    'pid' => 0,
                    'title' => $title
                ]
            ]
        ];

        /**
         * @var DataHandler
         */
        $tce = GeneralUtility::makeInstance(DataHandler::class);
        $tce->start($tcemainData, []);
        $tce->process_datamap();

        return $tce->substNEWwithIDs['NEW'];
    }

    /**
     * Get related contents
     *
     * @param string $table
     * @param integer $uid
     * @return array
     * @TODO: implement
     */
    public static function gerRelatedContent($table, $uid)
    {
        $records = [];
        /*
          $GLOBALS['TSFE']->exec_SELECTgetRows('uid_foreign as uid, tablenames', 'tx_tagger_tag_mm',
          ,
          $ groupBy = '',
          $ orderBy = '',
          $ limit = '',
          $ uidIndexField = ''
          )
         * Ü */

        return $records;
    }

    /**
     * Get related by same tag
     *
     * @param integer $uid
     * @return array
     */
    public static function gerRelatedByTag($uid)
    {
        /** @var DatabaseConnection $databaseConnection */
        $databaseConnection = $GLOBALS['TYPO3_DB'];
        return $databaseConnection->exec_SELECTgetRows(
            'uid_foreign as uid, tablenames',
            'tx_tagger_tag_mm',
            'uid_local=' . $uid
        );
    }
}
