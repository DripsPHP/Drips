<?php

// =============================================================================
//
//                  Diese Datei beinhaltet Performance-Tests
//
// =============================================================================

use Drips\Logger\Logger;
use Monolog\Handler\StreamHandler;
use Drips\App;

$logger = new Logger('performance');
$logger->pushHandler(new StreamHandler(DRIPS_LOGS.'/performance.log'));

App::on('shutdown', function() use ($logger){
    $logger->addInfo(sprintf('Requestdauer: %.3fs', DRIPS_END_TIME - DRIPS_START_TIME));
});
