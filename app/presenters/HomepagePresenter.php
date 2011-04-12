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
		$this->template->anyVariable = 'any value';
					//     x,  y,   r,g,b, f,a, x1,y1, x2, y2,   r, g,b
		$img = new Image(300,300, 25,30,0, 1,7, 10,10,200,200, 110,20,0);
		$img->saveToFile("new.png");
		$this->template->img = "new.png";
	}

}
