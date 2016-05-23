<?php

use Drips\Routing\Router;
use Drips\HTTP\Request;
use Drips\Routing\Error404Exception;
use Drips\Debugbar\Debugbar;

define("INIT_FILE", __DIR__."/init.php");
define("DRIPS_SRC", __DIR__."/src");
define("ROUTES_FILE", DRIPS_SRC."/routes.php");
define("AUTOLOAD_FILE", DRIPS_SRC."/autoload.php");

if(file_exists(INIT_FILE)){
    require_once INIT_FILE;
    if(file_exists(AUTOLOAD_FILE)){
        require_once AUTOLOAD_FILE;
    }
    if(file_exists(ROUTES_FILE)){
        try {
            require_once ROUTES_FILE;
        } catch(Error404Exception $e) {
            if(!Router::getInstance()->hasRoutes()){
                include(DRIPS_ERRORS."/no_routes.phtml");
            } else {
                throw $e;
            }
        }
    }
	/* TODO: Debugbar
    if(class_exists("Drips\Debugbar\Debugbar") && in_array("text/html", $router->getRequest()->getAccept())){
        $debugbar = Debugbar::getInstance();
        $debugbar->registerInfo("date", date("d.m.Y"));
        dump($router->getRequest());
        $debugbar->registerTab("request", "Request", $content);
        echo $debugbar;
    }
	*/
}
