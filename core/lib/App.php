<?php

namespace Drips;

use Drips\Utils\Event;
use Drips\Routing\Router;
use Drips\Debugger\Debugger;

class App extends Event
{
    public $router;

    public function __construct()
    {
        static::call("create", $this);
    }

    public function run()
    {
        static::call("startup", $this);
    }

    public function __destruct()
    {
        static::call("shutdown", $this);
    }
}
