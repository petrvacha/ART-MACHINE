<?php

	define('COUNT_OF_FUNCTIONS', 5);
	
class GA
{
	
	private $functions = array(1);
	private $width = 400;
	private $height = 400;
	private $crossoverPropability = 2; // %
	private $mutationPropability = 3;  // %
	private $filterPropability = 1;    // %
	private $countOfPopulations = 10;
	private $maxElements = 50;
	public $generation = array();

	public function __construct($width=400, $height=400) {
		$this->width = $width;
		$this->height = $height;
	}
	
	public function generateInitGeneration() {
			
		for($i=0; $i<$this->countOfPopulations; $i++) {
			$bgcolors = $this->generateColor();

			$this->generation[$i] = array();
			$this->generation[$i]['width'] = $this->width;
			$this->generation[$i]['height'] = $this->height;
			$this->generation[$i]['bgcolor'] = $bgcolors;
			$this->generation[$i]['elements'] = array();
			$this->generation[$i]['filter'] = mt_rand(6*$this->filterPropability, 600);			
			
			for($y=0; $y<mt_rand(0,$this->maxElements); $y++) {
				$element = mt_rand(1, COUNT_OF_FUNCTIONS);
				$coordinates = $this->generateCoordinates($element);
				$elementColors = $this->generateColor();
				$this->generation[$i]['elements'][$y] = array();
				$this->generation[$i]['elements'][$y]['element'] = $element;
				$this->generation[$i]['elements'][$y]['coordinates'] = $coordinates;
				$this->generation[$i]['elements'][$y]['color'] = $elementColors;
			}
			
		}
		
	}
	
	
	private function generateCoordinates($function) {
		$countPair = 1;
		switch($function) {
			case 1:
				$countPair = 1;
				break;
			case 2:
			case 3:
			case 4:
				$countPair = 2;
				break;
			case 5:
				$countPair = mt_rand(3,8);
				break;
			default:
				$countPair = 1;
		}
		
		$coordinates = array();
		
		for($i=0; $i < $countPair; $i++) {
			$coordinates[] = mt_rand(0, $this->width-1);
			$coordinates[] = mt_rand(0, $this->height-1);
		}
		return $coordinates;
	}
	
	private function generateColor() {		
		return array('r' => mt_rand(0,255),'g' => mt_rand(0,255),'b' => mt_rand(0,255));
	}
	

	public function createNewPopulation($selected) {
		DUMP($selected);die;
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
		$this->crossoverPropability = $crossover;
	}
	
	public function setMutationPropability($mutation) {
		$this->mutationPropability = $mutation;
	}
	
	public function setFilterPropability($filter) {
		$this->filterPropability = $filter;
	}
	
}