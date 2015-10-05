<?php
/**
 * Content Link preparation
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger;

use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * Prepare the content Link
 */
class ContentLink implements LinkBuilderCallbackInterface
{

    /**
     * Prepare the link building array
     *
     * @param string $table
     * @param int    $uid
     * @param array  $configuration
     * @param array  $markers
     */
    public function prepareLinkBuilding($table, $uid, &$configuration, &$markers)
    {
        $row = BackendUtility::getRecord($table, $uid);
        $markers['###PAGE_UID###'] = $row['pid'] . '#' . $uid;
    }

}