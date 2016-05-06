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

if(stripos($_SERVER["SERVER_SOFTWARE"], "apache") !== false && !file_exists(DRIPS_HTACCESS)){
    if(!copy(ROUTING_HTACCESS, DRIPS_HTACCESS)){
        die("Konnte ".ROUTING_HTACCESS." nicht nach ".DRIPS_HTACCESS." kopieren!");
    }
}

require_once COMPOSER_AUTOLOAD;

// Debugger aktivieren, sofern dieser existiert
$debug = false;
if(class_exists(Debugger::class)){
    $debug = true;
    $debugger = new Debugger;
}
define("DRIPS_DEBUG", $debug);
