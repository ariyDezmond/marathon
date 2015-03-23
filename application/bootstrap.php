<?php

/**
 * 
 * 
 * 
 **/
define(CONTROLLER,APP_PATH."/application/controllers/");
define(MODEL,APP_PATH."/application/models/");
define(VIEW,APP_PATH."/application/views/");
define(CORE,APP_PATH."/application/core/");
define(SITE,"http://".$_SERVER["SERVER_NAME"]);

/**
 * 
 * @param type $class
 * 
 **/
function __autoload($class)
{
    if(preg_match("{model[a-z]+}i", $class))
        include MODEL.$class.".php";
    elseif(preg_match("{controller[a-z0-9]+}i", $class))
        include CONTROLLER.$class.".php";
    else 
        include CORE.$class.".php";
}

Route::start();
$view = View::getInstance();
echo $view->getBody();
