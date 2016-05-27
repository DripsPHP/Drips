<?php

$app = new Drips\App;

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
    echo "<a href='".routeLink("test")."'>Test</a>";
});


$app->router->add("test", "/test", function(){
    echo "<a href='".routeLink("home")."'>Zur&uuml;ck</a>";
});

$app->run();
