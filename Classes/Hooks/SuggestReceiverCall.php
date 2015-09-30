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
namespace HDNET\Tagger\Hooks;

use HDNET\Tagger\Service;
use TYPO3\CMS\Core\Http\AjaxRequestHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SuggestReceiverCall
 */
class SuggestReceiverCall {

	const TAG = 'tx_tagger_domain_model_tag';
	const LLPATH = 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tag_suggest_';

	/**
	 * Create a tag
	 *
	 * @param array $params
	 * @param AjaxRequestHandler $ajaxObj
	 * @return void
	 */
	public function createTag(array $params, AjaxRequestHandler $ajaxObj) {
		$request = GeneralUtility::_POST();

		try {
			// check if a tag is submitted
			if (!isset($request['item']) || empty($request['item'])) {
				throw new \Exception('error_no-tag');
			}

			$newsUid = $request['newsid'];
			if ((int) $newsUid === 0 && (strlen($newsUid) == 16 && !GeneralUtility::isFirstPartOfStr($newsUid, 'NEW'))) {
				throw new \Exception('error_no-newsid');
			}

			// get tag uid
			$newTagId = $this->getTagUid($request);

			$ajaxObj->setContentFormat('javascript');
			$ajaxObj->setContent('');
			$response = [
				$newTagId,
				$request['item'],
				'tx_tagger_domain_model_tag',
				self::TAG,
				'tags',
				'data[tx_tagger_domain_model_tag][' . $newsUid . '][tags]',
				$newsUid
			];
			$ajaxObj->setJavascriptCallbackWrap(implode('-', $response));
		} catch (\Exception $e) {
			//$errorMsg = $GLOBALS['LANG']->sL(self::LLPATH . );
			$ajaxObj->setError($e->getMessage());
		}
	}

	/**
	 * Get the uid of the tag, either bei inserting as new or get existing
	 *
	 * @param array $request ajax request
	 * @return integer
	 */
	protected function getTagUid(array $request) {
		$tagUid = 0;

		$record = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
				'*', 'tx_tagger_domain_model_tag', 'deleted=0 AND title=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($request['item'], 'tx_tagger_domain_model_tag')
		);
		if (isset($record['uid'])) {
			$tagUid = $record['uid'];
		} else {
			$tagUid = \HDNET\Tagger\Service\IntegrationService::createTagRecord($request['item']);
		}

		if ($tagUid == 0) {
			throw new \Exception('error_no-tag-created');
		}

		return $tagUid;
	}

}
