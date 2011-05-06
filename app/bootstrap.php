<?php

/**
 * My NApplication bootstrap file.
 */



// Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';


// Enable NDebug for error visualisation & logging
NDebug::$strictMode = TRUE;
NDebug::enable();


// Load configuration from config.neon file
NEnvironment::loadConfig();


// Configure application
$application = NEnvironment::getApplication();
$application->errorPresenter = 'Error';
//$application->catchExceptions = TRUE;


// Setup router
{
$router = $application->getRouter();

//$router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);

$router[] = new NRoute('<presenter>/<action>[/<id>]', array(
    'presenter' => 'homepage',
    'action' => 'default',
    'id' => NULL,
));
};


// Run the application!
$application->run();
