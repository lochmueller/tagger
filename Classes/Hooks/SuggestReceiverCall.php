<?php

/**
 * Suggest call
 */

namespace HDNET\Tagger\Hooks;

use HDNET\Tagger\Service;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Http\AjaxRequestHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SuggestReceiverCall
 */
class SuggestReceiverCall
{

    const TAG = 'tx_tagger_domain_model_tag';
    const LLPATH = 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tag_suggest_';

    /**
     * Create a tag
     *
     * @param array $params
     * @param AjaxRequestHandler $ajaxObj
     * @return void
     */
    public function createTag(array $params, AjaxRequestHandler $ajaxObj)
    {
        $request = GeneralUtility::_POST();

        try {
            // check if a tag is submitted
            if (!isset($request['item']) || empty($request['item'])) {
                throw new \Exception('error_no-tag');
            }

            $newsUid = $request['newsid'];
            if ((int)$newsUid === 0 && (strlen($newsUid) == 16 && !GeneralUtility::isFirstPartOfStr($newsUid, 'NEW'))) {
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
     * @return int
     * @throws \Exception
     */
    protected function getTagUid(array $request)
    {
        /** @var DatabaseConnection $databaseConnection */
        $databaseConnection = $GLOBALS['TYPO3_DB'];
        $record = $databaseConnection->exec_SELECTgetSingleRow(
            '*',
            'tx_tagger_domain_model_tag',
            'deleted=0 AND title=' . $databaseConnection->fullQuoteStr($request['item'], 'tx_tagger_domain_model_tag')
        );
        if (isset($record['uid'])) {
            $tagUid = (int)$record['uid'];
        } else {
            $tagUid = Service\IntegrationService::createTagRecord($request['item']);
        }

        if ($tagUid == 0) {
            throw new \Exception('error_no-tag-created');
        }

        return $tagUid;
    }
}
