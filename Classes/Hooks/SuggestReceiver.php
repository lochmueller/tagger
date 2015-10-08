<?php

/**
 * Suggest receiver
 */

namespace HDNET\Tagger\Hooks;

use TYPO3\CMS\Backend\Form\Wizard\SuggestWizardDefaultReceiver;
use TYPO3\CMS\Backend\Utility\IconUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Suggest receiver
 */
class SuggestReceiver extends SuggestWizardDefaultReceiver
{

    /**
     * Query table
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
