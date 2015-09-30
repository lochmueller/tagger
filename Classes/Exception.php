<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Tim Lochmüller
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */
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