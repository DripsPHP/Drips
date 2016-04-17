<?php

define("INIT_FILE", __DIR__."/init.php");
define("DRIPS_SRC", __DIR__."/src");
define("ROUTES_FILE", DRIPS_SRC."/routes.php");
define("AUTOLOAD_FILE", DRIPS_SRC."/autoload.php");

if(file_exists(INIT_FILE)){
    require_once INIT_FILE;
    if(file_exists(ROUTES_FILE)){
        require_once ROUTES_FILE;
    }
    if(file_exists(AUTOLOAD_FILE)){
        require_once AUTOLOAD_FILE;
    }
} else {
    echo "Drips-Fehler: die Installation ist unvollständig!";
}
