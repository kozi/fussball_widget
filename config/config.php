<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2013 Leo Feyer
 *
 *
 * PHP version 5
 * @copyright  Martin Kozianka 2011-2013 <http://kozianka.de/>
 * @author     Martin Kozianka <http://kozianka.de>
 * @package    fussball_widget 
 * @license    LGPL 
 * @filesource
 */

$GLOBALS['TL_CRON']['hourly'][]                            = array('FussballDataManager', 'updateMatches');
$GLOBALS['TL_CRON']['daily'][]                             = array('FussballDataManager', 'updateCalendar');

$GLOBALS['TL_CTE']['fussball']['fussball_goalgetter']      = 'ContentFussballGoalgetter';
$GLOBALS['TL_CTE']['fussball']['fussball_tournament']      = 'ContentFussballTournament';
$GLOBALS['TL_CTE']['fussball']['fussball_matches']         = 'ContentFussballMatches';
$GLOBALS['TL_CTE']['fussball']['fussball_widget']          = 'ContentFussballWidget';
$GLOBALS['TL_CTE']['fussball']['fussball_calendar']        = 'ContentFussballFullCalendar';


array_insert($GLOBALS['BE_MOD'], 1, array('fussball' => array()));

array_insert($GLOBALS['BE_MOD']['fussball'], 0, array(
    'fussball_teams' => array
    (
        'tables'     => array('tl_fussball_team'),
        'icon'       => 'system/modules/fussball_widget/assets/icons/soccer.png',
    ),
    'fussball_matches' => array
    (
        'tables'     => array('tl_fussball_matches'),
        'icon'       => 'system/modules/fussball_widget/assets/icons/chain.png',
    ),
    'fussball_tournament' => array
    (
        'tables'     => array('tl_fussball_tournament'),
        'icon'       => 'system/modules/fussball_widget/assets/icons/tournament.png',
    )
));

if(TL_MODE === 'BE') {
	$GLOBALS['TL_CSS'][]          = 'system/modules/fussball_widget/assets/be_style.css';
	$GLOBALS['TL_JAVASCRIPT'][]   = 'system/modules/fussball_widget/assets/be_script.js';
}
