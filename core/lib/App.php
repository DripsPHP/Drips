<?php

namespace Drips;

use Drips\Utils\Event;
use Drips\Routing\Router;
use Drips\Debugger\Debugger;

class App
{
    use Event;
    
    private static $instance;

    public static function getInstance(){
        if(static::$instance === null){
            static::$instance = new static;
        }

        return static::$instance;
    }

    private function __construct()
    {
        static::call("create", $this);
    }

    private function __clone(){}

    public function run()
    {
        static::call("startup", $this);
    }

    public function __destruct()
    {
        static::call("shutdown", $this);
    }
}
