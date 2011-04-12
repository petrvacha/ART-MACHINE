<?php

/*
 * 
 *  imagearc ( resource $image , int $cx , int $cy , int $width , int $height , int $start , int $end , int $color )
 *  imagechar ( resource $image , int $font , int $x , int $y , string $c , int $color )
 *  imagecharup ( resource $image , int $font , int $x , int $y , string $c , int $color )
 *  imagecolorallocate ( resource $image , int $red , int $green , int $blue )
 *  imagedashedline ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
 *  imageellipse ( resource $image , int $cx , int $cy , int $width , int $height , int $color )
 *  imagefill ( resource $image , int $x , int $y , int $color )
 *  imagefilledarc ( resource $image , int $cx , int $cy , int $width , int $height , int $start , int $end , int $color , int $style )
 *  imagefilledellipse ( resource $image , int $cx , int $cy , int $width , int $height , int $color )
 *  imagefilledpolygon ( resource $image , array $points , int $num_points , int $color )
 *  imagefilledrectangle ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
 *  imagefilltoborder ( resource $image , int $x , int $y , int $border , int $color )
 *  imagefilter ( resource $image , int $filtertype [, int $arg1 [, int $arg2 [, int $arg3 [, int $arg4 ]]]] )
 * OK imageline ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
 *  imagesetpixel ( resource $image , int $x , int $y , int $color )
 *  imagesetstyle ( resource $image , array $style )
 *  imagesetthickness ( resource $image , int $thickness )
 *  imagefilltoborder ( resource $image , int $x , int $y , int $border , int $color ) 
 * 
 */
class Image {
	
	private $numargs = 0;
	private $argList = array();
	private $img = NULL;
	private $width = 0;
	private $height = 0;
	private $r = 0;
	private $g = 0;
	private $b = 0;
	
	//x,y,r,g,b,func,argsCount,...
	public function __construct() {
		$this->numargs = func_num_args();
		$this->argList = func_get_args();
		$this->parseInput();
	}
	
	
	private function parseInput() {
		$this->width = $this->argList[0];
		$this->height = $this->argList[1];
		$this->r = $this->argList[2];
		$this->g = $this->argList[3];
		$this->b = $this->argList[4];
		
		$this->createPicture();
		
		for($i=5; $i< $this->numargs; $i++) {
			$function = $this->argList[$i++];
			$argsCount = $this->argList[$i++];
			$argArray = array();
			for($y=0; $y<$argsCount; $y++, $i++) {
				$argArray[] = $this->argList[$i];
			}
			$this->applyFunction($function, $argArray);
		}
	}
	
	
	private function createPicture() {
		$this->img = imagecreatetruecolor($this->width, $this->height);
		$background = imagecolorallocate($this->img, $this->r, $this->g, $this->b); // set background
		imagefilledrectangle($this->img,0,0,$this->width,$this->height,$background);
		
		//imageantialias($this->img, true);
	}

	private function applyFunction($function, $argArray) {
		if ($function == 1) {
			$color = imagecolorallocate($this->img, $argArray[4], $argArray[5], $argArray[6]); 
			imageline($this->img, $argArray[0], $argArray[1], $argArray[2], $argArray[3], $color);
		}
	}
	
	public function saveToFile($fileName) {
		imagepng($this->img, $fileName);
		imagedestroy($this->img);
	}
}