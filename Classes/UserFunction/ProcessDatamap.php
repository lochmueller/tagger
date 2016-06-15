<?php

/**
 * Process data map
 */

namespace HDNET\Tagger\UserFunction;

/**
 * Class ProcessDatamap
 */
class ProcessDatamap
{

    /**
     * Call the pre process field array
     *
     * @param array $incomingFieldArray
     * @param string $table
     * @param integer $id
     * @param object $obj
     */
    public function processDatamap_preProcessFieldArray(&$incomingFieldArray, $table, $id, $obj)
    {
        if ($table != 'tx_tagger_domain_model_tag') {
            return;
        }

        if ($incomingFieldArray['slug'] == '') {
            $incomingFieldArray['slug'] = $this->createSlug($incomingFieldArray['title']);
        }
    }

    /**
     * Create slug for the given title
     *
     * @param string $title
     * @return string
     * @author Martin Poelstra (from RealURL extension)
     */
    protected function createSlug($title)
    {

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
        $processedTitle = preg_replace(
            '/\\' . $space . '+/',
            $space,
            $processedTitle
        ); // Convert multiple 'spaces' to a single one
        $processedTitle = trim($processedTitle, $space);

        return $processedTitle;
    }
}
