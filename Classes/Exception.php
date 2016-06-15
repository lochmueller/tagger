<?php

/**
 * Exception
 */

namespace HDNET\Tagger;

/**
 * Class Exception
 */
class Exception extends \Exception
{

    /**
     * Add the wiki Link in Front of the Error Message
     *
     * @param string $message
     * @param integer $code
     * @param mixed $previous
     */
    public function __construct($message, $code = null, $previous = null)
    {
        $message = 'Tagger Extension Errror: ' . $message . ' --- More Information in the Tager Wiki Code (<a href="http://forge.typo3.org/projects/extension-tagger/wiki/Errors#' . $code . '">More information</a>) or TYPO3 Wiki ';
        parent::__construct($message, $code, $previous);
    }
}
