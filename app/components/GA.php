<?php

	define('COUNT_OF_FUNCTIONS', 1);
	
class GA 
{
	
	private $functions = array(1);
	private $width = 200;
	private $height = 350;
	private $crossover = 0.2;
	private $mutation = 0.3;
	private $countOfPopulations = 10;
	private $maxElements = 1;
	public $generation = array();

	
	
	public function generateInitGeneration() {
			
		for($i=0; $i<$this->countOfPopulations; $i++) {
			$bgcolors = $this->generateColor();
			$function = mt_rand(1, COUNT_OF_FUNCTIONS);
			$coordinates = $this->generateCoordinates($function);
			$elementColors = $this->generateColor();

			$this->generation[$i] = array_merge(array($this->width, $this->height), $bgcolors, array($function), $coordinates, $elementColors);
		}
		
	}
	
	
	private function generateCoordinates($function) {
		$countPair = 1;
		switch($function) {
			case 1:
				$countPair = 2;
				break;
			default:
				$countPair = 1;
		}
		
		$coordinates = array();
		$coordinates[] = $countPair * 2 + 3; // + rgb
		
		for($i=0; $i < $countPair; $i++) {
			$coordinates[] = mt_rand(0, $this->width-1);
			$coordinates[] = mt_rand(0, $this->height-1);
		}
		return $coordinates;
	}
	
	private function generateColor() {		
		return array(mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	}
	
	
	
	public function rankPopulation() {
		
	}
	
	private function fitness() {
		
	}

	private function createNewPopulation() {
		
	}
	
	private function mutationColor($r, $g, $b) {
		
	}
	
	private function crossoverColors($r1, $g1, $b1, $r2, $g2, $b2) {
		
	}
	
	private function mutationDimensions() {
		$numargs = func_num_args();
		$argArray = func_get_args();
		  
	}

	private function crossoverDimensions() {
		$numargs = func_num_args();
		$argArray = func_get_args();
		
	}
	
	private function mutationFunction($function) {
		
	}
	
	private function crossoverFunction($function1, $function2) {
		
	}
	
	
	public function setDimensions($width, $height) {
		$this->width = $width;
		$this->height = $height;
	}
	
	public function setCountOfPopulations($countOfPopulations){
		$this->countOfPopulations = $countOfPopulations;
	}
	
	public function setMaxElements($maxElements){
		$this->maxElements = $maxElements;
	}
	
	public function setCrossoverProbability($crossover) {
		$this->crossover = $crossover;
	}
	
	public function setMutationPropability($mutation) {
		$this->mutation = $mutation;
		
	}
	
	
}