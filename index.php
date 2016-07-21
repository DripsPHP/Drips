<?php

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
    if(!defined('DRIPS_DEBUG')){
        define('DRIPS_DEBUG', false);
    }

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
    include(DRIPS_CORE.'/errors.php');

    // load config
    drips_config();

    include(DRIPS_SRC.'/bootstrap.php');

    // -----------------------------------------------------------------------------
} else {
    if(!@include(DRIPS_DIRECTORY.'/vendor/autoload.php')){
        die('composer update ausführen!');
    }
    drips_config();
    include(DRIPS_CORE.'/cmds.php');
}

// include(DRIPS_CORE.'/performance.php');

define('DRIPS_END_TIME', microtime(true));
