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


class HomepagePresenter extends BasePresenter
{

	private $picturesOnPage = 2;
	private $populations = 10;
	
	public function renderDefault($round, $selected)
	{   
		
		$session = NEnvironment::getSession("ga");
		
		
		if(!isset($session->generation) || !isset($round) || !isset($selected)) {
			$session->round = 0;
			$ga = new GA(500, 500);
			$ga->setCountOfPopulations($this->populations);
			$ga->generateInitGeneration();
			$session->generation = $ga->generation;
			$session->gaObject = serialize($ga); 
			$session->selected = array();
			
		}
		else {
			$session->selected[$round-1] = $selected;
			$session->round = (int) $round;
		}
		$this->template->round = $round;
		
		if($session->round >= ($this->populations)/$this->picturesOnPage) {
			$session->round = 0;
			$this->redirect('Homepage:nextgeneration');
		}

		$imgArray = array();
		for($i=0; $i<$this->picturesOnPage; $i++) {
			
			$imgArray[] = new Image($session->generation[$round * $this->picturesOnPage+$i]);			
			$imgArray[$i]->saveToFile($i.".png");
		}
		$this->template->round = $session->round+1;
		$this->template->imgArray = $imgArray;
	}
	
	public function actionNextgeneration(){
		$session = NEnvironment::getSession("ga");
		//DUMP($session->gaObject);die;
		$ga = unserialize($session->gaObject);
		$ga->createNewPopulation($session->selected);
		
		
	}

}
