<?php
/**
 * Database
 */

namespace HDNET\Tagger\Slots;

use HDNET\Tagger\Utility\TaggerRegister;

/**
 * Database
 */
class Database
{

    /**
     * Add the smart object SQL string the the signal below
     *
     * @signalClass \TYPO3\CMS\Install\Service\SqlExpectedSchemaService
     * @signalName tablesDefinitionIsBeingBuilt
     *
     * @param array $sqlString
     *
     * @return array
     */
    public function loadTables(array $sqlString)
    {
        $sqlString[] = $this->getDatabaseString();
        return ['sqlString' => $sqlString];
    }

    /**
     * Add the smart object SQL string the the signal below
     *
     * @signalClass \TYPO3\CMS\Extensionmanager\Utility\InstallUtility
     * @signalName tablesDefinitionIsBeingBuilt
     *
     * @param array $sqlString
     * @param string $extensionKey
     *
     * @return array
     */
    public function updateTables(array $sqlString, $extensionKey)
    {
        $sqlString[] = $this->getDatabaseString();
        return [
            'sqlString' => $sqlString,
            'extensionKey' => $extensionKey
        ];
    }

    /**
     * Get the tagger string for the registered tables
     *
     * @return string
     */
    protected function getDatabaseString()
    {
        $sql = [];
        foreach (TaggerRegister::getRegister() as $configuration) {
            $table = $configuration['tableName'];
            $sql[] = 'CREATE TABLE ' . $table . ' (
			tagger tinytext
			);';
        }
        return implode(LF, $sql);
    }
}
