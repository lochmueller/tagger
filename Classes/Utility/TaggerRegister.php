<?php

/**
 *
 */

namespace HDNET\Tagger\Utility;

/**
 * Class TaggerRegister
 */
class TaggerRegister
{

    /**
     * Register
     *
     * @var array
     */
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
     * Register Tags configuration
     *
     * @param array $configuration
     */
    static public function registerTags(array $configuration)
    {
        self::$register[] = $configuration;
    }

    /**
     * Get the register
     *
     * @return array
     */
    static public function getRegister()
    {
        return self::$register;
    }

    /**
     * Get the register for the given table name
     *
     * @param string $tableName
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