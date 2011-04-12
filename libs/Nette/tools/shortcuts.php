<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004, 2011 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

// no namespace



/**
 * NCallback factory.
 * @param  mixed   class, object, function, callback
 * @param  string  method
 * @return NCallback
 */
function callback($callback, $m = NULL)
{
	return ($m === NULL && $callback instanceof NCallback) ? $callback : new NCallback($callback, $m);
}



/**
 * NDebug::dump shortcut.
 */
function dump($var)
{
	foreach (func_get_args() as $arg) NDebug::dump($arg);
	return $var;
}
