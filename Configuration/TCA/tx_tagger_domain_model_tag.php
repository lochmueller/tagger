<?php
return array(
    'ctrl' => [
        'title' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY title',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('tagger') . 'Resources/Public/Icons/Tag.png'
    ],
    'types' => [
        '1' => ['showitem' => 'title,--palette--;sluglink;sluglink,content,valuation,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime, sys_language_uid, l10n_parent, l10n_diffsource, hidden'],
    ],
    'palettes' => [
        'sluglink' => ['showitem' => 'slug,link'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_tagger_domain_model_tag',
                'foreign_table_where' => 'AND tx_tagger_domain_model_category.pid=###CURRENT_PID### AND tx_tagger_domain_model_category.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'slug' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.slug',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim,unique'
            ],
        ],
        'link' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.link',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'checkbox' => '',
                'wizards' => [
                    'link' => [
                        'type' => 'popup',
                        'title' => 'Link',
                        'icon' => 'link_popup.gif',
                        'module' => [
                            'name' => 'link',
                        ],
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
                    ]
                ],
            ],
        ],
        'content' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.content',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => '*',
                'MM' => 'tx_tagger_tag_mm',
                'MM_hasUidField' => TRUE,
                'maxitems' => 999,
                'size' => 10,
                'readOnly' => 1,
            ],
        ],
        'valuation' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.valuation',
            'config' => [
                'type' => 'input',
                'size' => 6,
                'eval' => 'double2',
                'default' => '1.0',
            ],
        ],
    ],
);