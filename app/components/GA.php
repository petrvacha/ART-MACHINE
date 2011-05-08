<?php

	define('COUNT_OF_FUNCTIONS', 5);
	
class GA
{
	private $functions = array(1);
	private $width = 400;
	private $height = 400;
	private $crossoverPropability = 99; // %
	private $mutationPropability = 70;  // %
	private $filterPropability = 60;    // %
	private $countOfPopulations = 10;
	private $maxElements = 50;
	public $generation = array();
	public $newGeneration = array();

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
			$this->generation[$i]['filter'] = mt_rand(0, (101 - $this->filterPropability)*6);	//TODO		
			
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
	
	private function debugHelper(array $chromozome1, array $chromozome2){
		echo '<pre>';
		$text= array();
		$chromoArray = array($chromozome1, $chromozome2);
		foreach($chromoArray as $k => $a){
			$text[$k] = '';
			$text[$k].=$a['width'].' ';
			$text[$k].=$a['height'].' ';
			$text[$k].=$a['bgcolor']['r'].' ';
			$text[$k].=$a['bgcolor']['g'].' ';
			$text[$k].=$a['bgcolor']['b'].' ';
			$text[$k].='<strong>*ELEMENTS*</strong> ';
			foreach($a['elements'] as $c){
				$text[$k].='<strong>START</strong> ';
				$text[$k].=$c['element'].' ';
				foreach($c['coordinates'] as $coordinate){
					$text[$k].=$coordinate.' ';
				}
				$text[$k].=$c['color']['r'].' ';
				$text[$k].=$c['color']['g'].' ';
				$text[$k].=$c['color']['b'].' ';
			}
			$text[$k].='<strong>*FILTER*</strong> ';
			$text[$k].=$a['filter'].' ';
		}
		
		print_r($text[0].'</br>');
		print_r($text[1].'</br>');
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
		$tmpGeneration = array();
		//DUMP($selected);
		foreach($selected as $k => $s){
			$tmpGeneration[] = $this->generation[2*$k+$s-1];
		}
		unset($this->generation);
		$finalCount=count($tmpGeneration);
		for($i=0; $i<2*$finalCount; $i++){
			$this->generation[$i] = $this->crossover($tmpGeneration[mt_rand(0,$finalCount-1)],$tmpGeneration[mt_rand(0,$finalCount-1)]);
			$this->generation[$i] = $this->mutation($this->generation[$i]);
		}
		//$this->debugHelper($tmpGeneration[0], $this->newGeneration[0]);
		//$this->debugHelper($tmpGeneration[0], $this->newGeneration[1]);die;
	}
	
	
	private function crossover($chromozome1, $chromozome2){
		$newChromozone = $chromozome1;
		$separe = mt_rand(0,count($chromozome2["elements"])+3);
		$side = mt_rand(0,1);
		if(mt_rand(1,100)<$this->crossoverPropability){
			
			if($side){
				//dump("měním 2. půlku".$separe);
				for($i=$separe; $i<count($chromozome1["elements"])+4; $i++){
					
					if($i<3)
						$newChromozone["bgcolor"] = $chromozome2["bgcolor"];					
					
					if(isset($chromozome2["elements"][$i-3]))
						$newChromozone["elements"][$i-3] = $chromozome2["elements"][$i-3];

					if($i == count($chromozome1["elements"])+3)
						$newChromozone["filter"] = $chromozome2["filter"];
				}
			}
			else{
				//dump("měním 1. půlku".$separe);
				for($i=0; $i<$separe; $i++){
					
					if($i<3)
						$newChromozone["bgcolor"] = $chromozome2["bgcolor"];					
					
					if(isset($chromozome2["elements"][$i-3]))
						$newChromozone["elements"][$i-3] = $chromozome2["elements"][$i-3];

					if($i == count($chromozome1["elements"])+3)
						$newChromozone["filter"] = $chromozome2["filter"];
				}
			}
		}
		else if($side)
			return $chromozome1;
		else
			return $chromozome2;
			
		return $newChromozone;
	}
	
	
	private function mutation($chromozome){
		if(mt_rand(1,100)<$this->mutationPropability){
			$rnd = mt_rand(0,count($chromozome["elements"])+4);
			if($rnd <3){
				$chromozome["bgcolor"] = $this->generateColor();
			}
			else if($rnd<count($chromozome["elements"])+3){
				if(count($chromozome["elements"])){
					$el = mt_rand(0,count($chromozome["elements"]));
					$element = mt_rand(1, COUNT_OF_FUNCTIONS);
					$coordinates = $this->generateCoordinates($element);
					$elementColors = $this->generateColor();
					$chromozome["elements"][$el]['element'] = $element;
					$chromozome["elements"][$el]['coordinates'] = $coordinates;
					$chromozome["elements"][$el]['color'] = $elementColors;
				}
			}
			else{//FILTER
				$chromozome["filter"]= mt_rand(0, (101 - $this->filterPropability)*6);
			}
		}			
		return $chromozome;
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