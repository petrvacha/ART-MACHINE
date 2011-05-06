<?php

	define('COUNT_OF_FUNCTIONS', 5);
	
class GA
{
	
	private $functions = array(1);
	private $width = 400;
	private $height = 400;
	private $crossoverPropability = 95; // %
	private $mutationPropability = 0.1;  // %
	private $filterPropability = 1;    // %
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
			$this->generation[$i]['filter'] = mt_rand(6*$this->filterPropability, 600);	//TODO		
			
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
		$tmpGeneration = array();
		//DUMP($selected);die;
		echo '<pre>';
		foreach($selected as $k => $s){
			$tmpGeneration[] = $this->generation[2*$k+$s-1];
			//var_dump($tmpGeneration[$k]);
		}
		
		$i=0;
		$c = count($tmpGeneration);
		foreach($tmpGeneration as $k => $tg){
			for($second=$k+1; $second<$c; $second++){
				$separe = mt_rand(1,count($tmpGeneration[$k]["elements"]));
				$side = mt_rand(0,1);
				$this->newGeneration[$i] = $this->crossover($tmpGeneration[$k],$tmpGeneration[$second],$separe,$side);
				$this->newGeneration[$i] = $this->mutation($this->newGeneration[$i]);
				$i++;
			}
		}
		
		
	}
	
	
	/*private function crossover($chromozone1, $chromozone2){
		if(mt_rand(1,100)<$this->crossoverPropability){
			
			$separe = mt_rand(1,count($chromozone1["elements"]));
			$side = mt_rand(0,1);
			
			if($side){//CHANGE LEFT
				if($separe <=5){//color
					
				}
				else if($separe<count($chromozone1["elements"])-1){//color,elements
					
				}
			}
			else{
				if($side){
					if($separe <=5){//elements,filter
						
					}
					else if($separe<count($chromozone1["elements"])-1){//elements,filter
						
					}
				}
			}
		}
	}
	*/
	
	
	
	private function mutation($chromozone){
		if(mt_rand(1,100)<$this->mutationPropability){
			$rnd = mt_rand(0,1+count($chromozone["elements"])+1); 
			if($rnd <1){
				$chromozone["bgcolor"] = $this->generateColor();
			}
			else if($rnd<1+count($chromozone["elements"])){
				if(count($chromozone["elements"])){
					$el = mt_rand(0,count($chromozone["elements"]));
					$element = mt_rand(1, COUNT_OF_FUNCTIONS);
					$coordinates = $this->generateCoordinates($element);
					$elementColors = $this->generateColor();
					$chromozone["elements"] = $chromozone["elements"][$el]['element'] = $element;
					$chromozone["elements"] = $chromozone["elements"][$el]['coordinates'] = $coordinates;
					$chromozone["elements"] = $chromozone["elements"][$el]['color'] = $elementColors;
				} 
			}
			else{//FILTER
				
			}
		}
	}
	
	
	private function crossover($chromozone1, $chromozone2, $separe, $side){
		$newChromozone;
		if(mt_rand(1,100)<$this->crossoverPropability){
			$separe = $separe - 5;
			if($side){
				$newChromozone = $chromozone1;
				for($i=$separe; $i<count($chromozone1); $i++){
					if(isset($chromozone2[$i]))
						$newChromozone["elements"][$i] = $chromozone2[$i];
				}
				$newChromozone["filter"] = $chromozone2["filter"];
			}
			else{
				$newChromozone = $chromozone1;
				$newChromozone["bgcolor"] = $chromozone2["bgcolor"];
				for($i=0; $i<$separe; $i++){
					if(isset($chromozone2[$i]))
						$newChromozone["elements"][$i] = $chromozone2[$i];
				}			
			}
		}
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