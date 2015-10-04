<?php
/**
 * @todo    General file information
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger;

/**
 * @todo General class information
 *
 */
interface LinkBuilderCallbackInterface
{

    /**
     * Prepare the link building array
     *
     * @param string $table
     * @param int    $uid
     * @param array  $configuration
     * @param array  $markers
     */
    public function prepareLinkBuilding($table, $uid, &$configuration, &$markers);
}