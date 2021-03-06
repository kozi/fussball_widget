<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 *
 * PHP version 5
 * @copyright  Martin Kozianka 2011-2015 <http://kozianka.de/>
 * @author     Martin Kozianka <http://kozianka.de>
 * @package    fussball
 * @license    LGPL 
 * @filesource
 */

namespace ContaoFussball\Elements;

/**
 * Class ContentFussballGoalgetter
 *
 * @copyright  Martin Kozianka 2011-2015 <http://kozianka.de/>
 * @author     Martin Kozianka <http://kozianka.de>
 * @package    fussball
 */

class ContentFussballGoalgetter extends \ContentElement
{
	protected $strTemplate = 'ce_fussball_goalgetter';
	private $ggArr         = null;
	
	public function generate()
	{
		$this->ggArr = unserialize($this->fussball_goalgetter);
		
		if (TL_MODE == 'BE')
        {
			$objTemplate           = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### Goalgetter ###<table>';

			foreach ($this->ggArr as $gg)
			{
				$objTemplate->wildcard .= '<tr><td style="padding:2px 6px;">'.$gg['fussball_gg_name'].'</td>';
				$objTemplate->wildcard .= '<td style="padding:2px 6px;">'.$gg['fussball_gg_goals'].'</td></tr>';
			}
			$objTemplate->wildcard .= '</table>';

			$objTemplate->title     = $this->headline;
			$objTemplate->id        = $this->id;
			$objTemplate->link      = $this->name;
			$objTemplate->href      = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}		
		return parent::generate();
	}
			
	protected function compile()
    {
		$arr = [];
		foreach ($this->ggArr as $gg)
        {
			$name  = $gg['fussball_gg_name'];
			$goals = $gg['fussball_gg_goals'];
			
			if (array_key_exists($goals, $arr))
            {
				$arr[$goals]->names[] = $name;
			}
            else
            {
				$arr[$goals] = (object) [
					'goals' => $goals,
					'names' => [$name]
				];
			}
		}
		
		krsort($arr);

		$goalsSum = 0;
		$i        = 0;
		$position = 1;

		foreach ($arr as &$row)
        {
			$countNames      = count($row->names);
			$row->position   = $position;
			$row->cssClass   = 'row_'.$i;
			$row->cssClass  .= ($i++ == 0) ? ' first': '';
			$row->cssClass  .= ($i % 2 == 0 ) ? ' odd': ' even';

			$row->goalsView  = ($countNames > 1) ? 'je ' : '';
			$row->goalsView .= $row->goals;
			$row->goalsView .= ($row->goals==1) ? ' Tor' : ' Tore';

			$goalsSum       += $countNames * $row->goals;
			$position       += $countNames;
		}

		$row->cssClass .= ' last';

		$this->Template->goalsSum       = $goalsSum.(($goalsSum==1) ? ' Tor' : ' Tore');
		$this->Template->goalgetterList = $arr;
	}

}
