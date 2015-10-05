<?php

namespace HDNET\Tagger\ViewHelpers;

use HDNET\Tagger\LinkBuilderCallbackInterface;
use HDNET\Tagger\Utility\TaggerRegister;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class LinkViewHelper extends AbstractViewHelper
{

    /**
     * @param string $tableName
     * @param int    $foreignUid
     *
     * @return string
     */
    public function render($tableName, $foreignUid)
    {
        $typoLinkConfiguration = $this->getTypoLinkConfiguration($tableName, $foreignUid);
        $cObject = $this->objectManager->get('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
        return $cObject->typoLink($this->renderChildren(), $typoLinkConfiguration);
    }

    /**
     * @param string $tableName
     *
     * @return array
     * @throws \Exception
     */
    protected function getTypoLinkConfiguration($tableName, $uid)
    {
        $register = TaggerRegister::getRegisterForTableName($tableName);
        if ($register === null) {
            throw new \Exception('Invalid table name in tagger registry: ' . $tableName);
        }

        $baseConfiguration = (array)$register['typoLinkConfiguration'];
        $markers = [
            '###TABLENAME###' => $tableName,
            '###UID###'       => $uid,
        ];
        
        if ($register['callbackClass'] && class_exists($register['callbackClass'])) {
            /** @var LinkBuilderCallbackInterface $callback */
            $callback = GeneralUtility::makeInstance($register['callbackClass']);
            $callback->prepareLinkBuilding($tableName, $uid, $baseConfiguration, $markers);
        }

        return $this->replaceInArray($baseConfiguration, $markers);
    }

    /**
     * @param array $array
     * @param array $markers
     *
     * @return array
     */
    protected function replaceInArray(array $array, array $markers)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->replaceInArray($value, $markers);
            } else {
                $array[$key] = str_replace(array_keys($markers), $markers, $value);
            }
        }
        return $array;
    }
}
