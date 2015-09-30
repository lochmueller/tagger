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
namespace HDNET\Tagger\UserFunction;

/**
 * Class ProcessDatamap
 */
class ProcessDatamap {

	/**
	 *
	 * @param array $incomingFieldArray
	 * @param string $table
	 * @param integer $id
	 * @param object $obj 
	 */
	public function processDatamap_preProcessFieldArray(&$incomingFieldArray, $table, $id, $obj) {
		if ($table != 'tx_tagger_domain_model_tag')
			return;

		if ($incomingFieldArray['slug'] == '')
			$incomingFieldArray['slug'] = $this->createSlug($incomingFieldArray['title']);
	}

	/**
	 * Create slug for the given title
	 * 
	 * @param string $title
	 * @return string
	 * @author Martin Poelstra (from RealURL extension)
	 */
	protected function createSlug($title) {

		// Convert to lowercase:
		$processedTitle = mb_strtolower($title);

		// Strip tags
		$processedTitle = strip_tags($processedTitle);

		// Convert some special tokens to the space character:
		$space = '-';
		$processedTitle = preg_replace('/[ \-+_]+/', $space, $processedTitle); // convert spaces
		// Convert extended letters to ascii equivalents:
		//$cs = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_cs');
		//$processedTitle = $cs->utf8_char_mapping($processedTitle, 'ascii');

		// Strip the rest...:
		$processedTitle = preg_replace('/[^a-zA-Z0-9\\' . $space . ']/', '', $processedTitle); // strip the rest
		$processedTitle = preg_replace('/\\' . $space . '+/', $space, $processedTitle); // Convert multiple 'spaces' to a single one
		$processedTitle = trim($processedTitle, $space);

		return $processedTitle;
	}

}