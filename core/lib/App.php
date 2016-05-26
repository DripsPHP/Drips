<?php

namespace Drips;

use Drips\Utils\Event;
use Drips\Routing\Router;
use Drips\Debugger\Debugger;

class App extends Event
{
    public $router;
    protected $debugger;

    public function __construct()
    {
        $this->install();
        $this->debugger = new Debugger;
        $this->router = Router::getInstance();
    }

    private function install()
    {
        // Apache?
        if (PHP_SAPI != 'cli' && stripos($_SERVER['SERVER_SOFTWARE'], 'apache') !== false){
            if (!in_array('mod_rewrite', apache_get_modules())) {
                include(DRIPS_ERRORS."/mod_rewrite.phtml");
            }
        }
    }

    public function run()
    {
        static::call("startup");
        if($this->router->hasRoutes()){
            $this->router->route();
        } else {
            include(DRIPS_ERRORS."/no_routes.phtml");
        }
    }

    public function __destruct()
    {
        static::call("shutdown");
    }
}
