<?php

// Drips
define('DRIPS_CORE', __DIR__.'/core');
define('DRIPS_SRC', __DIR__.'/src');
define('DRIPS_ERRORS', DRIPS_CORE.'/errors');
define('DRIPS_PUBLIC', __DIR__.'/public');

// Wurde bereits `composer update` durchgeführt?
if(!@include('vendor/autoload.php')){
    include(DRIPS_ERRORS.'/install_composer.phtml');
}

include(DRIPS_SRC.'/bootstrap.php');
