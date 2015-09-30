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

use TYPO3\CMS\Backend\Form\Wizard\SuggestWizardDefaultReceiver;
use TYPO3\CMS\Backend\Utility\IconUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class SuggestReceiver
 */
class SuggestReceiver extends SuggestWizardDefaultReceiver
{

    /**
     *
     * @param array $params
     * @param integer $recursionCounter
     * @return mixed
     */
    public function queryTable(&$params, $recursionCounter = 0)
    {
        $uid = GeneralUtility::_GP('uid');

        $records = parent::queryTable($params, $recursionCounter);

        if (count($records) === 0) {
            $text = htmlspecialchars($params['value']);
            $javaScriptCode = '
var value=\'' . $text . '\';

Ext.Ajax.request({
    url : \'ajax.php\' ,
    params : { ajaxID : \'Tag::createTag\', item:value, newsid:\'' . $uid . '\' },
    success: function ( result, request ) {
        var arr = result.responseText.split(\'-\');
        setFormValueFromBrowseWin(arr[5], arr[2] +  \'_\' + arr[0], arr[1]);
        TBE_EDITOR.fieldChanged(arr[3], arr[6], arr[4], arr[5]);
    },
    failure: function ( result, request) {
        Ext.MessageBox.alert(\'Failed\', result.responseText);
    }
});
';

            $javaScriptCode = trim(str_replace('"', '\'', $javaScriptCode));
            $link = implode(' ', explode(chr(10), $javaScriptCode));

            $records['tx_tagger_domain_model_tag_' . strlen($text)] = [
                'text' => '<div onclick="' . $link . '">
                            <span class="suggest-path">
                                <a>Kein Tage gefunden. Klicken zum erzeugen</a>
                            </span></div>',
                'table' => 'tx_tagger_domain_model_tag',
                'class' => 'suggest-noresults',
                'style' => 'background-color:#E9F1FE !important;background-image:url(' . $this->getDummyIconPath() . ');',
            ];
            /// sprintf($GLOBALS['LANG']->sL('LLL:EXT:news/Resources/Private/Language/locallang_be.xml:tag_suggest'), $text)
        }

        return $records;
    }

    /**
     * Get the icon of this database
     *
     * @return string
     */
    private function getDummyIconPath()
    {
        $icon = IconUtility::getSpriteIconForRecord('tx_tagger_domain_model_tag', []);
        return IconUtility::skinImg('', $icon, '', 1);
    }

}
