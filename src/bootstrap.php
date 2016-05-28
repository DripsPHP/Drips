<?php

$app = Drips\App::getInstance();

// !!! ONLY FOR TESTING
$app->logger->addDebug('Nur zum Debuggen');
$app->logger->addInfo('Das ist eine Info');
$app->logger->addNotice('Das ist ein Notice');
$app->logger->addError('Das ist ein Error');
$app->logger->addWarning('Das ist ein Warning');
$app->logger->addCritical('Das ist ein Critical');
$app->logger->addAlert('Das ist ein Alert');
$app->logger->addEmergency('Das ist ein Emergency');
// ----------------------------------------

$app->router->add("home", "/", function(){
    echo "It Works!";
    echo "<a href='".route("test")."'>Test</a>";
});


$app->router->add("test", "/test", function(){
    echo "<a href='".route("home")."'>Zur&uuml;ck</a>";
});

$app->run();
