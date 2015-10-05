<?php
/**
 * Content Link preparation
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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

        // @todo define the target link for content elements in the right way
        #DebuggerUtility::var_dump($configuration, 'CONTENT');
        #DebuggerUtility::var_dump($markers);
        #die();
        // Addapt here
    }

}