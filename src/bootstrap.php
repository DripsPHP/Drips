<?php

$app = new Drips\App;

$app->router->add("home", "/", function(){
    echo "It Works!";
    echo "<a href='".routeLink("test")."'>Test</a>";
});

$app->router->add("test", "/test", function(){
    echo "<a href='".routeLink("home")."'>Zur&uuml;ck</a>";
});

$app->run();
