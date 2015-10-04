<?php
/**
 * @todo    General file information
 *
 * @author  Tim Lochmüller
 */

/**
 * @todo General class information
 *
 */

namespace HDNET\Tagger;


use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
        DebuggerUtility::var_dump($configuration);
        DebuggerUtility::var_dump($markers);
        // Addapt here
    }

}