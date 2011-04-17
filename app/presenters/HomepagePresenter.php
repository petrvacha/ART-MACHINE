<?php

/**
 * My NApplication
 *
 * @copyright  Copyright (c) 2010 Petr Vácha
 */



/**
 * Homepage presenter.
 *
 * @author     Petr Vácha
 */

use Nette\Environment;

class HomepagePresenter extends BasePresenter
{

	private $picturesOnPage = 2;
	private $populations = 20;
	
	public function renderDefault($round, $selected)
	{   
		
		$session = NEnvironment::getSession("ga");
		
		
		if(!isset($session->generation) || !isset($round) || !isset($selected)) {
			$session->round = 0;
			$ga = new GA(500, 500);
			$ga->setCountOfPopulations($this->populations);
			$ga->generateInitGeneration();
			$session->generation = $ga->generation;
			$session->selected = array();
		}
		else {
			$session->selected[$round] = $selected;
			$session->round = $round;
		}
		
		if($session->round >= $this->populations/$this->picturesOnPage) {
			$session->round = 0;
			$this->redirect('default');
		}

		$imgArray = array();
		for($i=0; $i<$this->picturesOnPage; $i++) {
			$imgArray[] = new Image($session->generation[$round * $this->picturesOnPage+$i]);			
			$imgArray[$i]->saveToFile($i.".png");
		}
		$this->template->round = $session->round+1;
		$this->template->imgArray = $imgArray;
		
		
	}

}
