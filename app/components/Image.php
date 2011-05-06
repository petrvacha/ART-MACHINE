<?php


class Image
{
	
	private $numargs = 0;
	private $argList = array();
	private $img = NULL;
	private $width = 0;
	private $height = 0;
	private $r = 0;
	private $g = 0;
	private $b = 0;

	//x,y,r,g,b,func,argsCount,...
	public function __construct(array $population) {
		$this->width = $population['width'];
		$this->height = $population['height'];
		$this->r = $population['bgcolor']['r'];
		$this->g = $population['bgcolor']['g'];
		$this->b = $population['bgcolor']['b'];
		$this->elements = $population['elements'];
		$this->filter = $population['filter'];
		$this->createPicture();
		$this->draw();
		$this->filter();
	}
	
	private function createPicture() {
		$this->img = imagecreatetruecolor($this->width, $this->height);
		$background = imagecolorallocate($this->img, $this->r, $this->g, $this->b); // set background
		imagefilledrectangle($this->img,0,0,$this->width,$this->height,$background);
		
		if (function_exists('imageantialias'))
			imageantialias($this->img, true);
	}

	private function draw() {
		foreach($this->elements as $el) {
			$this->applyFunction($el['element'], $el['coordinates'], $el['color']);
		}
	}

	private function applyFunction($element, $coordinates, $color) {
		$color = imagecolorallocate($this->img, $color['r'], $color['g'], $color['b']);
		
		switch ($element){
			case 1:
				imagefill($this->img, $coordinates[0], $coordinates[1], $color);
				break;
			case 2:
				imageline($this->img, $coordinates[0], $coordinates[1], $coordinates[2], $coordinates[3], $color);
				break;
			case 3:
				imagefilledrectangle($this->img, $coordinates[0], $coordinates[1], $coordinates[2], $coordinates[3], $color);
				break;
			case 4:
				imagefilledellipse($this->img, $coordinates[0], $coordinates[1], $coordinates[2], $coordinates[3], $color);
				break;
			case 5:
				imagefilledpolygon ($this->img , $coordinates , count($coordinates)/2, $color);
				break;
		}
	}
	
	private function filter() {
		switch($this->filter) {
			case 1:
				imagefilter($this->img, IMG_FILTER_GRAYSCALE);
				break;
			case 2:
				imagefilter($this->img, IMG_FILTER_EDGEDETECT);
				break;
			case 3:
				imagefilter($this->img, IMG_FILTER_EMBOSS);
				break;
			case 4:
				imagefilter($this->img, IMG_FILTER_GAUSSIAN_BLUR);
				break;
			case 5:
				imagefilter($this->img, IMG_FILTER_SELECTIVE_BLUR);
				break;
			case 6:
				imagefilter($this->img, IMG_FILTER_MEAN_REMOVAL);
				break;
			default:
				break;
		}
	}
	
	public function saveToFile($fileName) {
		imagepng($this->img, $fileName);
	}
	
	public function __destruct(){
		imagedestroy($this->img);
	}
}