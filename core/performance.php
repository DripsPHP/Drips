<?php

// =============================================================================
//
//                  Diese Datei beinhaltet Performance-Tests
//
// =============================================================================

$logger = new Drips\Logger\Logger('performance');
$logger->pushHandler(new Monolog\Handler\StreamHandler(DRIPS_LOGS.'/performance.log'));

Drips\App::on('shutdown', function() use ($logger){
    $logger->addInfo(sprintf('Requestdauer: %.3fs', DRIPS_END_TIME - DRIPS_START_TIME));
});
