<?php

/**
 * Homepage presenter.
 *
 * @author     Petr Vácha
 */


class HomepagePresenter extends BasePresenter
{

	function renderDefault() {
		
	}

	
	protected function createComponentForm(){
		$form = new NAppForm;
		
		$form->addText('generationCount', 'Generation count:', 3, 3)
			->setRequired('Please enter generation count.')
			->addRule(NForm::RANGE, 'Generation count must be in range from %d to %d', array(2, 100))
			->setDefaultValue("20");
			
		$form->addText('populationCount', 'Population count:', 3, 3)->setRequired('Please enter population count.')
			->addRule($form::INTEGER)
			->setDefaultValue("10")
			->addRule(NForm::RANGE, 'Generation count must be in range from %d to %d', array(2, 100));
          
		$form->addText('crossover', 'Crossover propability:', 3, 3)
			->setRequired('Please enter crossover propability.')
			->addRule(NForm::RANGE, 'Crossover propability must be in range from %d to %d', array(0, 100))
			->setDefaultValue("98");
			
		$form->addText('mutation', 'Mutation propability:', 3, 3)
			->setRequired('Please enter mutation propability.')
			->addRule(NForm::RANGE, 'Mutation propability must be in range from %d to %d', array(0, 100))
			->setDefaultValue("70");
		
		$form->addText('filter', 'Filter propability:', 3, 3)
			->setRequired('Please enter filter propability.')
			->addRule(NForm::RANGE, 'Filter propability must be in range from %d to %d', array(0, 100))
			->setDefaultValue("30");
			
		$form->addText('maxElements', 'Elements maximum:', 3, 3)
			->setRequired('Please enter elements maximum.')
			->addRule(NForm::RANGE, 'Elements maximum must be in range from %d to %d', array(10, 1000))
			->setDefaultValue("50");
			
		$form->addText('width', 'Picture width:', 3, 3)
			->setRequired('Please enter picture width.')
			->addRule(NForm::RANGE, 'Picture width must be in range from %d to %d', array(1, 1000))
			->setDefaultValue("400");
			
		$form->addText('height', 'Picture height:', 3, 3)
			->setRequired('Please enter picture height.')
			->addRule(NForm::RANGE, 'Picture height must be in range from %d to %d', array(1, 1000))
			->setDefaultValue("400");
		
		
		$form->addSubmit('start', 'Start');
		$form->onSubmit[] = callback($this, 'formSubmitted');
		return $form;
	}


	public function formSubmitted(NAppForm $form){
		$session = NEnvironment::getSession("ga");
		
		$values = $form->getValues();
		$session->generationCount = $values['generationCount'];
		$session->populationCount = $values['populationCount'];
		$session->crossover = $values['crossover'];
		$session->mutation = $values['mutation'];
		$session->filter = $values['filter'];
		$session->maxElements = $values['maxElements'];
		$session->width = $values['width'];
		$session->height = $values['height'];
		
		$this->redirect('Homepage:evolution');
	}
	
	private $picturesOnPage = 2;
	private $populations = 10;
	
	public function renderEvolution($round, $selected)
	{   
		
		$session = NEnvironment::getSession("ga");

		if(isset($session->newgen) && $session->newgen && isset($session->gaObject)){
			$ga = unserialize($session->gaObject);
			unset($session->generation);
			$session->generation = $ga->generation;
			$session->selected = array();
			$session->genRound++;
			$session->newgen = False;
		}
		else if(!isset($session->generation) || !isset($round) || !isset($selected)) {
		//	dump("first");
			$session->round = 0;
			$ga = new GA($session->width, $session->height);
			$ga->setCountOfPopulations($session->populationCount);
			$ga->setFilterPropability($session->filter);
			$ga->setCrossoverProbability($session->crossover);
			$ga->setMutationPropability($session->mutation);
			$ga->setMaxElements($session->maxElements);
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
		
		if($session->round >= ($this->populations)/$this->picturesOnPage) {
			$session->round = 0;
			$session->newgen = True;
			$this->redirect('Homepage:nextgeneration');
		}

		
		$imgArray = array();
		for($i=0; $i<$this->picturesOnPage; $i++) {
			$imgArray[] = new Image($session->generation[$round * $this->picturesOnPage+$i]);			
			$imgArray[$i]->saveToFile($i.".png");
		}
		$this->template->generationRound = $session->genRound;
		$this->template->round = $session->round+1;
		$this->template->imgArray = $imgArray;
	}
	
	public function actionNextgeneration(){
		$session = NEnvironment::getSession("ga");
		$ga = unserialize($session->gaObject);
		$ga->createNewPopulation($session->selected);
		$session->gaObject = serialize($ga);
		$session->round = 0;
		$this->redirect('Homepage:evolution');
	}
	
	

}
