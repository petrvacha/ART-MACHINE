<?php

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
		
		if(isset($session->newgen) && $session->newgen && isset($session->gaObject)){
			//dump("newGen");	
			//dump($session->generation);die;
			$ga = unserialize($session->gaObject);
			$session->generation = $ga->newGeneration;
			//unset($session->gaObject);
			$session->selected = array();
			$session->genRound++;
			$session->newgen = False;
		}
		else if(!isset($session->generation) || !isset($round) || !isset($selected)) {
		//	dump("first");
			$session->round = 0;
			$ga = new GA(500, 500);
			$ga->setCountOfPopulations($this->populations);
			$ga->generateInitGeneration();
			$session->genRound = 0;
			$session->gaObject = serialize($ga); 
			$session->generation = $ga->generation;
			$session->selected = array();
		}
		else {
		//	dump("next");
			$session->selected[$round-1] = $selected;
			$session->round = (int) $round;
		}
		//die;
		
		if($session->round >= ($this->populations)/$this->picturesOnPage) {
			$session->round = 0;
			$session->newgen = True;
			$this->redirect('Homepage:nextgeneration');
		}

		$imgArray = array();
	//	dump($session->generation);//die;
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
		//dump($ga);
		$ga->createNewPopulation($session->selected);
		$session->gaObject = serialize($ga);
		$session->round = 0;
		$this->redirect('Homepage:default');
	}

}
