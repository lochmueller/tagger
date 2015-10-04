<?php

########################################################################
# Extension Manager/Repository config file for ext "tagger".
#
# Auto generated 16-08-2015 02:10
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF['tagger_sites'] = array(
    'title'          => 'Tagger for Pages and Content',
    'description'    => 'Enables tags for pages and content elements',
    'category'       => 'plugin',
    'version'        => '0.1.0',
    'state'          => 'stable',
    'author'         => 'Tim Lochmüller,Maik Hagenbruch',
    'author_email'   => '',
    'author_company' => 'HDNET',
    'constraints'    => array(
        'depends' => array(
            'php'    => '5.5.0-0.0.0',
            'typo3'  => '6.2.0-7.99.99',
            'tagger' => '',
        ),
    ),
);