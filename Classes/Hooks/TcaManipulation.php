<?php
/**
 * Add TCA settings
 *
 * @author  Tim Lochmüller
 */

namespace HDNET\Tagger\Hooks;

use HDNET\Autoloader\Utility\TranslateUtility;
use HDNET\Tagger\Service\IntegrationService;
use HDNET\Tagger\Utility\TaggerRegister;
use TYPO3\CMS\Core\Database\TableConfigurationPostProcessingHookInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Add TCA settings
 *
 * @hook TYPO3_CONF_VARS|SC_OPTIONS|GLOBAL|extTablesInclusion-PostProcessing
 */
class TcaManipulation implements TableConfigurationPostProcessingHookInterface
{

    /**
     * Add the needed TCA configuration
     */
    public function processData()
    {
        $register = TaggerRegister::getRegister();
        foreach ($register as $configuration) {
            $table = $configuration['tableName'];
            $GLOBALS['TCA'][$table]['columns']['tagger'] = [
                'exclude' => 1,
                'label'   => TranslateUtility::getLllOrHelpMessage('tags', 'tagger'),
                'config'  => IntegrationService::getTagFieldConfiguration($table)
            ];
            ExtensionManagementUtility::addToAllTCAtypes($table, 'tagger');
        }
    }
}
