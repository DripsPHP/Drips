<?php

use Drips\Debugger\Handler;

// richtige PHP-Version?
if (version_compare(PHP_VERSION, '5.5', '<')) {
    include(DRIPS_ERRORS . '/wrong_php.phtml');
}

// Wurde bereits `composer update` durchgeführt?
if (!@include(DRIPS_DIRECTORY . '/vendor/autoload.php')) {
    include(DRIPS_ERRORS . '/install_composer.phtml');
}

// tmp anlegen
if (!is_dir(DRIPS_TMP)) {
    if (!mkdir(DRIPS_TMP)) {
        include(DRIPS_ERRORS . '/tmp.phtml');
    }
}

// mod_rewrite aktiviert?
Handler::on('Drips\Routing\ModRewriteNotEnabledException', function () {
    include DRIPS_ERRORS . '/mod_rewrite.phtml';
});

// Apache AllowOverride
Handler::on('Drips\Routing\AllowOverrideAllException', function () {
    include(DRIPS_ERRORS . '/allowoverride_all.phtml');
});

// sind bereits Routen registriert?
Handler::on('Drips\Routing\NoRoutesException', function () {
    include DRIPS_ERRORS . '/no_routes.phtml';
});


// Es kann keine Verbindung aufgebaut werden
Handler::on('Propel\Runtime\Connection\Exception\ConnectionException', function () {
    include DRIPS_ERRORS . '/connection_failed.phtml';
});
