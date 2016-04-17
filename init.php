<?php

use Drips\Debugger\Debugger;

define("VENDOR_DIRECTORY", __DIR__."/vendor");
define("COMPOSER_AUTOLOAD", VENDOR_DIRECTORY."/autoload.php");
define("ROUTING_HTACCESS", VENDOR_DIRECTORY."/drips/routing/.htaccess");
define("DRIPS_HTACCESS", __DIR__."/.htaccess");

// Diese Datei darf nur included werden, anderfalls wird sie nicht ausgeführt!
if(basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])){
    die();
}

// Wurde bereits `composer update` durchgeführt?
if(!is_dir(VENDOR_DIRECTORY) || !file_exists(__DIR__."/composer.lock") || !file_exists(COMPOSER_AUTOLOAD)){
    die("Führen Sie bitte zuerst ein <code>composer update</code> durch");
}

if(strtolower($_SERVER["SERVER_SOFTWARE"]) == "apache" && !file_exists(DRIPS_HTACCESS)){
    copy(ROUTING_HTACCESS, DRIPS_HTACCESS);
}

require_once COMPOSER_AUTOLOAD;

// Debugger aktivieren, sofern dieser existiert
if(class_exists(Debugger::class)){
    $debugger = new Debugger;
}
