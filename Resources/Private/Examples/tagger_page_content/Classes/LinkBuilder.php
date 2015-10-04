<?php
/**
 * @todo    General file information
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\TaggerPageContent;

use HDNET\Tagger\LinkBuilderCallbackInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * @todo General class information
 *
 */
class LinkBuilder implements LinkBuilderCallbackInterface
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