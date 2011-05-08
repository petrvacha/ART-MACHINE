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
		$form->addText('artist', 'Your name:')->setRequired('Please enter your name.');
		
		$form->addText('generationCount', 'Generation count:')
			->setRequired('Please enter generation count.')
			->addRule(NForm::RANGE, 'Generation count must be in range from %d to %d', array(2, 100))
			->setDefaultValue("20");
			
		$form->addText('populationCount', 'Population count:')->setRequired('Please enter population count.')
			->addRule($form::INTEGER)
			->setDefaultValue("10")
			->addRule(NForm::RANGE, 'Generation count must be in range from %d to %d', array(2, 100));
          
		$form->addText('crossover', 'Crossover propability:')
			->setRequired('Please enter crossover propability.')
			->addRule(NForm::RANGE, 'Crossover propability must be in range from %d to %d', array(0, 100))
			->setDefaultValue("98");
			
		$form->addText('mutation', 'Mutation propability:')
			->setRequired('Please enter mutation propability.')
			->addRule(NForm::RANGE, 'Mutation propability must be in range from %d to %d', array(0, 100))
			->setDefaultValue("70");
		
		$form->addText('filter', 'Filter propability:')
			->setRequired('Please enter filter propability.')
			->addRule(NForm::RANGE, 'Filter propability must be in range from %d to %d', array(0, 100))
			->setDefaultValue("30");
			
		$form->addText('maxElements', 'Elements maximum:')
			->setRequired('Please enter elements maximum.')
			->addRule(NForm::RANGE, 'Elements maximum must be in range from %d to %d', array(10, 1000))
			->setDefaultValue("50");
			
		$form->addText('width', 'Picture width:')
			->setRequired('Please enter picture width.')
			->addRule(NForm::RANGE, 'Picture width must be in range from %d to %d', array(1, 1000))
			->setDefaultValue("400");
			
		$form->addText('height', 'Picture height:')
			->setRequired('Please enter picture height.')
			->addRule(NForm::RANGE, 'Picture height must be in range from %d to %d', array(1, 1000))
			->setDefaultValue("400");
		
		
		$form->addSubmit('start', 'Start');
		$form->onSubmit[] = callback($this, 'formSubmitted');
		return $form;
	}
	

}
