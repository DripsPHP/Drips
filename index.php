<?php

use Drips\Debugger\Handler;
use Drips\Config\Config;

define('DRIPS_START_TIME', microtime(true));

// Drips-Konstanten ------------------------------------------------------------
if(!defined('DRIPS_DIRECTORY')){
    define('DRIPS_DIRECTORY', __DIR__);
}
if(!defined('DRIPS_CORE')){
    define('DRIPS_CORE', __DIR__.'/core');
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
if(!defined('DRIPS_CONFIG')){
    define('DRIPS_CONFIG', DRIPS_DIRECTORY . '/config');
}
// -----------------------------------------------------------------------------

function drips_config(){
    $configFile = DRIPS_CONFIG.'/'.(DRIPS_DEBUG ? 'dev' : 'prod').'.config.php';
    if(file_exists($configFile)){
        $config = include($configFile);
        foreach($config as $key => $val){
            Config::set($key, $val);
        }
    }
    date_default_timezone_set(Config::get('timezone', 'Europe/Vienna'));
}

// Benutzerdefinierte Fehlermeldungen für Exceptions ---------------------------
if(PHP_SAPI != 'cli'){
    // richtige PHP-Version?
    if(version_compare(PHP_VERSION, '5.5', '<')){
        include(DRIPS_ERRORS.'/wrong_php.phtml');
    }

    // Wurde bereits `composer update` durchgeführt?
    if(!@include(DRIPS_DIRECTORY.'/vendor/autoload.php')){
        include(DRIPS_ERRORS.'/install_composer.phtml');
    }
    if(!defined('DRIPS_DEBUG')){
        define('DRIPS_DEBUG', false);
    }

    // tmp anlegen
    if(!is_dir(DRIPS_TMP)){
        if(!mkdir(DRIPS_TMP)){
            include(DRIPS_ERRORS.'/tmp.phtml');
        }
    }

    // mod_rewrite aktiviert?
    Handler::on('Drips\Routing\ModRewriteNotEnabledException', function(){
        include DRIPS_ERRORS.'/mod_rewrite.phtml';
    });

    // Apache AllowOverride
    Handler::on('Drips\Routing\AllowOverrideAllException', function(){
        include(DRIPS_ERRORS.'/allowoverride_all.phtml');
    });

    // sind bereits Routen registriert?
    Handler::on('Drips\Routing\NoRoutesException', function(){
        include DRIPS_ERRORS.'/no_routes.phtml';
    });

    // load config
    drips_config();

    include(DRIPS_SRC.'/bootstrap.php');

    // -----------------------------------------------------------------------------
} else {
    if(!@include(DRIPS_DIRECTORY.'/vendor/autoload.php')){
        die('composer update ausführen!');
    }
    drips_config();
}

// include(DRIPS_CORE.'/performance.php');

define('DRIPS_END_TIME', microtime(true));
