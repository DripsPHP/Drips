<?php

// Drips-Konstanten ------------------------------------------------------------
if(!defined('DRIPS_DIRECTORY')){
    define('DRIPS_DIRECTORY', __DIR__);
}
if(!defined('DRIPS_CORE')){
    define('DRIPS_CORE', DRIPS_DIRECTORY.'/core');
}
if(!defined('DRIPS_SRC')){
    define('DRIPS_SRC', DRIPS_DIRECTORY.'/src');
}
if(!defined('DRIPS_PUBLIC')){
    define('DRIPS_PUBLIC', DRIPS_DIRECTORY.'/public');
}
if(!defined('DRIPS_TMP')){
    define('DRIPS_TMP', DRIPS_DIRECTORY.'/tmp');
}
if(!defined('DRIPS_LOGS')){
    define('DRIPS_LOGS', DRIPS_DIRECTORY.'/logs');
}
if(!defined('DRIPS_ERRORS')){
    define('DRIPS_ERRORS', DRIPS_CORE.'/errors');
}
// -----------------------------------------------------------------------------


// Benutzerdefinierte Fehlermeldungen für Exceptions ---------------------------

// richtige PHP-Version?
if(version_compare(PHP_VERSION, '5.5', '<')){
    include(DRIPS_ERRORS.'/wrong_php.phtml');
}

// Wurde bereits `composer update` durchgeführt?
if(!@include('vendor/autoload.php')){
    include(DRIPS_ERRORS.'/install_composer.phtml');
}

// tmp anlegen
if(!is_dir(DRIPS_TMP)){
    if(!mkdir(DRIPS_TMP)){
        include(DRIPS_ERRORS.'/tmp.phtml');
    }
}

use Drips\Debugger\Handler;

// mod_rewrite aktiviert?
Handler::on('Drips\Routing\ModRewriteNotEnabledException', function(){
    include DRIPS_ERRORS.'/mod_rewrite.phtml';
});

// sind bereits Routen registriert?
Handler::on('Drips\Routing\NoRoutesException', function(){
    include DRIPS_ERRORS.'/no_routes.phtml';
});

// -----------------------------------------------------------------------------


include(DRIPS_SRC.'/bootstrap.php');
