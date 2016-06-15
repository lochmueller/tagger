<?php
/**
 * Interface for custom link builder
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger;

/**
 * Interface for custom link builder
 */
interface LinkBuilderCallbackInterface
{

    /**
     * Prepare the link building array
     *
     * @param string $table
     * @param int $uid
     * @param array $configuration
     * @param array $markers
     */
    public function prepareLinkBuilding($table, $uid, &$configuration, &$markers);
}
