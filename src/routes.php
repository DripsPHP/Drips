<?php

use Drips\HTTP\Request;
use Drips\Routing\Router;
use Drips\Routing\Error404Exception;

$router = Router::getInstance();

// --- Routen können hier angelegt werden ---

/*
$router->add("home", "/", function(){
    $view = new Drips\MVC\View;
    $view->assign("title", "Hello world!");
    return $view->display("src/views/test.tpl");
});
*/
//$router->add("less_compiler", "/less/{file}.css", Drips\LessCompiler\Controller::class);
//$router->add("scss_compiler", "/scss/{file}.css", Drips\ScssCompiler\Controller::class);

// ---

$router->route();
