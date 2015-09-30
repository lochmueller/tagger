<?php
namespace HDNET\Tagger\Utility;

/**
 * Class TaggerRegister
 */
class TaggerRegister
{

    static protected $register = [];

    /**
     * @param string $table
     * @param array  $typoLinkConfiguration
     */
    static public function registerTagsFor($table, array $typoLinkConfiguration = [])
    {
        if (is_string($table)) {
            self::registerTags(['tableName' => $table, 'typoLinkConfiguration' => $typoLinkConfiguration]);
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
}

?>