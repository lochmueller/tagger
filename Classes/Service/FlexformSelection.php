<?php

/**
 * Flexform selection
 */

namespace HDNET\Tagger\Service;

use TYPO3\CMS\Backend\Utility\IconUtility;
use TYPO3\CMS\Core\Database\DatabaseConnection;

/**
 * Flexform selection
 */
class FlexformSelection
{

    /**
     * Add the possible relation to the flexform selection of the tagger plugin
     *
     * @param array $config
     * @param object $obj
     */
    public function addReleations(&$config, &$obj)
    {
        /** @var DatabaseConnection $databaseConnection */
        $databaseConnection = $GLOBALS['TYPO3_DB'];
        $rows = $databaseConnection->exec_SELECTgetRows(
            'tablenames',
            'tx_tagger_tag_mm',
            '1=1',
            'tablenames',
            'tablenames DESC'
        );
        foreach ($rows as $row) {
            $table = $row['tablenames'];
            $icon = IconUtility::getSpriteIconForRecord($table, []);
            if (substr($icon, 0, 4) == 'gfx/') {
                $icon = str_replace('gfx/', '', $icon);
            }
            $config['items'][] = [$table, $table, $icon];
        }
    }
}
