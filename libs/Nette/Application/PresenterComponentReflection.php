<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004, 2011 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Application
 */



/**
 * Helpers for NPresenter & NPresenterComponent.
 *
 * @author     David Grudl
 * @internal
 */
class NPresenterComponentReflection extends NClassReflection
{
	/** @var array getPersistentParams cache */
	private static $ppCache = array();

	/** @var array getPersistentComponents cache */
	private static $pcCache = array();

	/** @var array isMethodCallable cache */
	private static $mcCache = array();



	/**
	 * @return array of persistent parameters.
	 */
	public function getPersistentParams($class = NULL)
	{
		$class = $class === NULL ? $this->getName() : $class; // TODO
		$params = & self::$ppCache[$class];
		if ($params !== NULL) return $params;
		$params = array();
		if (is_subclass_of($class, 'NPresenterComponent')) {
			// $class::getPersistentParams() in PHP 5.3
			$defaults = get_class_vars($class);
			foreach (call_user_func(array($class, 'getPersistentParams'), $class) as $name => $meta) {
				if (is_string($meta)) $name = $meta;
				$params[$name] = array(
					'def' => $defaults[$name],
					'since' => $class,
				);
			}
			$params = $this->getPersistentParams(get_parent_class($class)) + $params; // TODO
		}
		return $params;
	}



	/**
	 * @return array of persistent components.
	 */
	public function getPersistentComponents()
	{
		$class = $this->getName();
		$components = & self::$pcCache[$class];
		if ($components !== NULL) return $components;
		$components = array();
		if (is_subclass_of($class, 'NPresenter')) {
			// $class::getPersistentComponents() in PHP 5.3
			foreach (call_user_func(array($class, 'getPersistentComponents'), $class) as $name => $meta) {
				if (is_string($meta)) $name = $meta;
				$components[$name] = array('since' => $class);
			}
			$components = self::getPersistentComponents(get_parent_class($class)) + $components;
		}
		return $components;
	}



	/**
	 * Is a method callable? It means class is instantiable and method has
	 * public visibility, is non-static and non-abstract.
	 * @param  string  method name
	 * @return bool
	 */
	public function hasCallableMethod($method)
	{
		$class = $this->getName();
		$cache = & self::$mcCache[strtolower($class . ':' . $method)];
		if ($cache === NULL) try {
			$cache = FALSE;
			$rm = NMethodReflection::from($class, $method);
			$cache = $this->isInstantiable() && $rm->isPublic() && !$rm->isAbstract() && !$rm->isStatic();
		} catch (ReflectionException $e) {
		}
		return $cache;
	}

}
