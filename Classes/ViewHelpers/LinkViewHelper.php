<?php

namespace HDNET\Tagger\ViewHelpers;

use HDNET\Tagger\Utility\TaggerRegister;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class LinkViewHelper extends AbstractViewHelper
{

    /**
     * @param string $tableName
     * @param int $foreignUid
     *
     * @return string
     */
    public function render($tableName, $foreignUid)
    {
        $typoLinkConfiguration = $this->getTypoLinkConfiguration($tableName);
        DebuggerUtility::var_dump($typoLinkConfiguration);
        // DebuggerUtility::var_dump($tag);
        // TaggerRegister::getRegister() ....
        // typoLinkConfiguration
        // $this->renderChildren()
        return 'hallo' . $tableName . ':' . $foreignUid;
    }

    /**
     * @param string $tableName
     *
     * @return array
     * @throws \Exception
     */
    protected function getTypoLinkConfiguration($tableName)
    {
        foreach (TaggerRegister::getRegister() as $configuration) {
            if ($configuration['tableName'] === $tableName) {
                return $configuration['typoLinkConfiguration'];
            }
        }
        throw new \Exception('Invalid table name: ' . $tableName);
    }
}
