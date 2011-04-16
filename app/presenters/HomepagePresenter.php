<?php

/**
 * My NApplication
 *
 * @copyright  Copyright (c) 2010 Petr Vácha
 */



/**
 * Homepage presenter.
 *
 * @author     Petr Vácha
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$ga = new GA(500, 500);
		$ga->generateInitGeneration();
		//echo "<pre>";
		//print_r($ga->generation);die;
		//dump(array(300,300, 250,30,100, 1,7, 120,10,200,200, 10,20,0));die;
					//     x,  y,   r, g,  b, f,a, x1, y1, x2, y2,   r,g,b
		//$img = new Image(array(300,300, 250,30,100, 1,7, 120,10,200,200, 10,20,0));
		$img = new Image($ga->generation[0]);
		$img2 = new Image($ga->generation[1]);
		$img->saveToFile("new.png");
		$img2->saveToFile("new2.png");
		$this->template->img = "new.png";
		$this->template->img2 = "new2.png";
	}

}
