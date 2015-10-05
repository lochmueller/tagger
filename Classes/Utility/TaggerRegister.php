<?php
namespace HDNET\Tagger\Utility;

/**
 * Class TaggerRegister
 */
class TaggerRegister
{

    static protected $register = [];

    /**
     * Register a tagging function
     *
     * @param string      $table
     * @param array       $typoLinkConfiguration
     * @param string|bool $callbackClass
     */
    static public function registerTagsFor($table, array $typoLinkConfiguration = [], $callbackClass = false)
    {
        if (is_string($table)) {
            self::registerTags([
                'tableName'             => $table,
                'typoLinkConfiguration' => $typoLinkConfiguration,
                'callbackClass'         => $callbackClass
            ]);
        }
    }

    /**
     * @param array $configuration
     */
    static public function registerTags(array $configuration)
    {
        self::$register[] = $configuration;
    }

    /**
     * @return array
     */
    static public function getRegister()
    {
        return self::$register;
    }

    /**
     * @return array|NULL
     */
    static public function getRegisterForTableName($tableName)
    {
        foreach (self::getRegister() as $configuration) {
            if ($configuration['tableName'] === $tableName) {
                return $configuration;
            }
        }
        return null;
    }
}