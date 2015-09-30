<?php
namespace HDNET\Tagger\Utility;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class TaggerRegister
 */

class TaggerRegister {

    static protected $register = [];

    /**
     * @param \String $table
     */
    static public function registerTagsFor($table) {
        if(is_string($table)) {
            array_push(self::$register, $table);
        }
    }

    /**
     * @return array
     */
    static public function getRegister() {
        return self::$register;
    }
}

?>