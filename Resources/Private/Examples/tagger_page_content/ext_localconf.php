<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\HDNET\Tagger\Utility\TaggerRegister::registerTagsFor('pages', ['parameter' => '###UID###'],
    \HDNET\TaggerPageContent\LinkBuilder::class);

\HDNET\Tagger\Utility\TaggerRegister::registerTagsFor('tt_content', ['parameter' => '###PAGE_UID###'],
    \HDNET\TaggerPageContent\LinkBuilder::class);
