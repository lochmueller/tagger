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
    public static function registerTagsFor($table, array $typoLinkConfiguration = [], $callbackClass = false)
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
    public static function registerTags(array $configuration)
    {
        self::$register[] = $configuration;
    }

    /**
     * Get the register
     *
     * @return array
     */
    public static function getRegister()
    {
        return self::$register;
    }

    /**
     * Get the register for the given table name
     *
     * @param string $tableName
     * @return array|NULL
     */
    public static function getRegisterForTableName($tableName)
    {
        foreach (self::getRegister() as $configuration) {
            if ($configuration['tableName'] === $tableName) {
                return $configuration;
            }
        }
        return null;
    }
}
