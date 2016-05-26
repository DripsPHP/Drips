<?php

// Drips-Konstanten ------------------------------------------------------------
define('DRIPS_CORE', __DIR__.'/core');
define('DRIPS_SRC', __DIR__.'/src');
define('DRIPS_ERRORS', DRIPS_CORE.'/errors');
define('DRIPS_PUBLIC', __DIR__.'/public');
// -----------------------------------------------------------------------------


// Benutzerdefinierte Fehlermeldungen für Exceptions ---------------------------

// Wurde bereits `composer update` durchgeführt?
if(!@include('vendor/autoload.php')){
    include(DRIPS_ERRORS.'/install_composer.phtml');
}

use Drips\Debugger\Handler;

// mod_rewrite aktiviert?
Handler::on('Drips\Routing\ModRewriteNotEnabledException', function(){
    include DRIPS_ERRORS.'/mod_rewrite.phtml';
    return true;
});

// sind bereits Routen registriert?
Handler::on('Drips\Routing\NoRoutesException', function(){
    include DRIPS_ERRORS.'/no_routes.phtml';
    return true;
});

// -----------------------------------------------------------------------------


include(DRIPS_SRC.'/bootstrap.php');
