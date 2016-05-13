<?php

use Drips\Routing\Router;
use Drips\Routing\Error404Exception;

define("INIT_FILE", __DIR__."/init.php");
define("DRIPS_SRC", __DIR__."/src");
define("ROUTES_FILE", DRIPS_SRC."/routes.php");
define("AUTOLOAD_FILE", DRIPS_SRC."/autoload.php");

if(file_exists(INIT_FILE)){
    require_once INIT_FILE;
    if(file_exists(ROUTES_FILE)){
        try {
            require_once ROUTES_FILE;
        } catch(Error404Exception $e) {
            if(!Router::getInstance()->hasRoutes()){
                die("Es wurden noch keine Routen eingetragen! Erste Schritte ...");
            } else {
                throw $e;
            }
        }
    }
    if(file_exists(AUTOLOAD_FILE)){
        require_once AUTOLOAD_FILE;
    }
} else {
    echo "Drips-Fehler: die Installation ist unvollständig!";
}
