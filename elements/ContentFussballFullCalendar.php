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

/**
 * Class ContentFussballFullCalendar
 *
 * @copyright  Martin Kozianka 2011-2013 <http://kozianka.de/>
 * @author     Martin Kozianka <http://kozianka.de>
 * @package    fussball_widget
 */

class ContentFussballFullCalendar extends ContentElement {
    private $events        = null;
    private $teamIds       = null;
    private $teams         = array();
    protected $strTemplate = 'ce_fussball_calendar';

	public function generate() {
		if (TL_MODE == 'BE') {
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### FullCalendar ###';
			$objTemplate->title    = $this->headline;
			$objTemplate->id       = $this->id;
			$objTemplate->link     = $this->name;
			$objTemplate->href     = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
        $this->teamIds = unserialize($this->fussball_team_id_array);

        $result = $this->Database->execute("SELECT * FROM tl_fussball_team WHERE id IN (".implode(',', $this->teamIds).")");
        while($result->next()) {
            $row                      = $result->row();
            $row['bgcolor']           = unserialize($row['bgcolor']);
            $this->teams[$result->id] = $row;
        }
		return parent::generate();
	}
			
	protected function compile() {
        $year  = date('Y');
        $month = date('m');

        $this->getEvents();

        if ('json' === Input::get('fullcalendar')) {

            echo json_encode($this->events);
            exit;
        }
	}

    private function getEvents() {
        if ($this->events !== null) {
            return true;
        }
        $this->events = array();

        $result = $this->Database->execute("SELECT * FROM tl_fussball_matches
            WHERE team_id IN (".implode(',', $this->teamIds).")");
        while ($result->next()) {
            $this->events[] = FullCal::fullCalEventFromMatchEntry($result->row(), '#'.$this->teams[$result->team_id]['bgcolor'][0]);
        }

    }

}



class FullCal {
    public static $matchLength = 6300;

    public static function fullCalEventFromMatchEntry($match, $bgColor) {
        $erg   = (strlen($match['ergebnis']) > 0) ? ' '.$match['ergebnis'] : '';
        $title = $match['heim'].' - '.$match['gast'].' ['.$match['typ'].']'.$erg;

        return static::fullCalEvent(
            $match['id'],
            $title,
            $match['anstoss'],
            $match['anstoss'] + static::$matchLength,
            false,
            $bgColor
        );
    }

    public static function fullCalEvent($id, $title, $start, $end, $url = false, $bgColor = false) {
        $event = array(
            'id'     => $id,
            'title'  => $title,
            'start'  => $start,
            'end'    => $end,
            'allDay' => false,
        );

        if ($url     !== false) $event['url']             = $url;
        if ($bgColor !== false) $event['backgroundColor'] = $bgColor;

        return $event;
    }
}

