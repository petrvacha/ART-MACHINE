<?php

	define('COUNT_OF_FUNCTIONS', 1);
	
class GA 
{
	
	private static $functions = array(1);
	private static $width = -1; // has to set
	private static $height = -1;
	private static $crossover = 0.2;
	private static $mutation = 0.3;
	private static $countOfPopulations = 10;
	private static $generation = array();

	
	
	public static function generateInitPopulation(){		
		$function = mt_rand(1, COUNT_OF_FUNCTIONS);
		$coordinates = self::generateCoordinates($function);
		$colors = self::generateColor();
	}
	
	
	private static function generateCoordinates($function) {
		$countPair = 1;
		switch($function) {
			case '1':
				$countPair = 1;
			default:
				$countPair = 1;
		}
		
		$coordinates = array();
		for($i=0; $i < $countPair; $i++) {
			$coordinates[] = mt_rand(0, self::width-1);
			$coordinates[] = mt_rand(0, self::height-1);
		}
		return $coordinates;
	}
	
	private static function generateColor() {		
		return array(mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	}
	
	
	
	public static function rankPopulation() {
		
	}
	
	private static function fitness() {
		
	}

	private static function createNewPopulation() {
		
	}
	
	private static function mutationColor($r, $g, $b) {
		
	}
	
	private static function crossoverColors($r1, $g1, $b1, $r2, $g2, $b2) {
		
	}
	
	private static function mutationDimensions() {
		$numargs = func_num_args();
		$argArray = func_get_args();
		  
	}

	private static function crossoverDimensions() {
		$numargs = func_num_args();
		$argArray = func_get_args();
		
	}
	
	private static function mutationFunction($function) {
		
	}
	
	private static function crossoverFunction($function1, $function2) {
		
	}
	
	
	public static function setDimensions($width, $height) {
		self::$width = $width;
		self::$height = $height;
	}
	
	public static function setcountOfPopulations($countOfPopulations){
		self::$countOfPopulations = $countOfPopulations;
	}
	
	public static function setCrossoverProbability($crossover) {
		self::$crossover = $crossover;
	}
	
	public static function setMutationPropability($mutation) {
		self::$mutation = $mutation;
		
	}
	
	
}