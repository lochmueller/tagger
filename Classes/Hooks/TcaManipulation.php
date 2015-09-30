<?php
/**
 * @todo    General file information
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger\Hooks;

use HDNET\Tagger\Service\IntegrationService;

/**
 * @todo General class information
 * @hook TYPO3_CONF_VARS|SC_OPTIONS|GLOBAL|extTablesInclusion-PostProcessing
 */
class TcaManipulation implements \TYPO3\CMS\Core\Database\TableConfigurationPostProcessingHookInterface
{

    function processData()
    {
        $register = \HDNET\Tagger\Utility\TaggerRegister::getRegister();
        foreach ($register as $configuration) {
            $table = $configuration['tableName'];
            //DebuggerUtility::var_dump($GLOBALS['TCA'][$table]);
            $GLOBALS['TCA'][$table]['columns']['tagger'] = [
                'exclude' => 1,
                'label'   => 'tagger',
                'config'  => IntegrationService::getTagFieldConfiguration($table)
            ];
            $GLOBALS['TCA'][$table]['types']['1']['showitem'] .= ',tagger';
        }
    }
}
