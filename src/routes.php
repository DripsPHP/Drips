<?php

use Drips\HTTP\Request;
use Drips\Routing\Router;
use Drips\Routing\Error404Exception;

$router = new Router(new Request);

// --- Routen können hier angelegt werden ---



// ---

$router->route();
