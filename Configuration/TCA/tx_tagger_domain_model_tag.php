<?php

/**
 * Base TCA generation for the model HDNET\\Tagger\\Domain\\Model\\Tag
 */

$base = \HDNET\Autoloader\Utility\ModelUtility::getTcaInformation('HDNET\\Tagger\\Domain\\Model\\Tag');

$custom = array(
    'columns' => [
        'title'     => [
            'config' => [
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'slug'      => [
            'config' => [
                'size' => 20,
                'eval' => 'trim,unique'
            ],
        ],
        'link'      => [
            'config' => [
                'type'    => 'input',
                'size'    => 20,
                'wizards' => [
                    'link' => [
                        'type'         => 'popup',
                        'title'        => 'Link',
                        'icon'         => 'link_popup.gif',
                        'module'       => [
                            'name' => 'link',
                        ],
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
                    ]
                ],
            ],
        ],
        'content'   => [
            'config' => [
                'type'           => 'group',
                'internal_type'  => 'db',
                'allowed'        => '*',
                'MM'             => 'tx_tagger_tag_mm',
                'MM_hasUidField' => true,
                'maxitems'       => 99999,
                'size'           => 10,
                'readOnly'       => 1,
            ],
        ],
        'valuation' => [
            'config' => [
                'type'    => 'input',
                'size'    => 6,
                'eval'    => 'double2',
                'default' => '1.0',
            ],
        ],
    ],
);

return \HDNET\Autoloader\Utility\ArrayUtility::mergeRecursiveDistinct($base, $custom);