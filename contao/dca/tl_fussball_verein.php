<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 *
 * PHP version 5
 * @copyright  Martin Kozianka 2011-2015 <http://kozianka.de/>
 * @author     Martin Kozianka <http://kozianka.de/>
 * @package    fussball
 * @license    LGPL
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_fussball_verein'] = array(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'switchToEdit'                => true,
        'enableVersioning'            => true,
        'sql' => array(
            'keys' => array('id' => 'primary')
        )
    ),


// List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'fields'                  => array('name ASC'),
            'flag'                    => 11,
            'panelLayout'             => 'filter, search, limit'
        ),
        'label' => array
        (
            'fields'                  => array('wappen', 'name_short', 'name', 'location'),
            'showColumns'             => true,
        ),


        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_fussball_verein']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif',
                'attributes'          => 'class="contextmenu"'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_fussball_verein']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_fussball_verein']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            )
        )

    ),

    // Palettes
    'palettes' => array
    (
        'default' => '{title_legend},name,name_short,home,wappen,location,teams'
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'label'                   => array('ID'),
            'search'                  => false,
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'label'                   => array('TSTAMP'),
            'search'                  => false,
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
        ),

        'name' => array
        (
            'label'                   => $GLOBALS['TL_LANG']['tl_fussball_verein']['name'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'long'),
            'sql'                     => "varchar(255) NOT NULL default ''",
        ),
        'name_short' => array
        (
            'label'                   => $GLOBALS['TL_LANG']['tl_fussball_verein']['name_short'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'flag'                    => 1,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class' => 'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''",
        ),
        'home' => array
        (
            'label'                   => $GLOBALS['TL_LANG']['tl_fussball_verein']['home'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => false,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50 m12'),
            'sql'                     => "char(1) NOT NULL default ''",
        ),
        'location' => array
        (
            'label'                   => $GLOBALS['TL_LANG']['tl_fussball_verein']['location'],
            'search'                  => false,
            'inputType'               => 'textarea',
            'eval'                    => array('tl_class' => 'clr long'),
            'sql'                     => "varchar(255) NOT NULL default ''",
        ),
        'wappen' => array
        (
            'label'                   => $GLOBALS['TL_LANG']['tl_fussball_verein']['wappen'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'inputType'		          => 'fileTree',
            'eval'			          => array('tl_class' => 'clr long', 'mandatory'=> false, 'files' => true, 'filesOnly' => true, 'fieldType' => 'radio'),
            'sql'                     => "binary(16) NULL",
        ),
        'teams' => array
        (
            'label'                   => $GLOBALS['TL_LANG']['tl_fussball_verein']['teams'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'inputType'		          => 'optionWizard',
            'eval'			          => array('mandatory'=> false),
            'sql'                     => "blob NULL",
        ),
    ) //fields

);

class tl_fussball_verein extends Backend {

}

