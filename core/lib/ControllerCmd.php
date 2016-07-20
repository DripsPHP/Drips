<?php

namespace Drips;

use Drips\CLI\ICommand;
use Drips\CLI\Console;
use Drips\Utils\ClassGenerator;

abstract class ControllerCmd implements ICommand
{
    public static function add($name = NULL)
    {
        if($name == NULL){
            Console::error('Gib einen Namen an');
        } else {
                $generator = new ClassGenerator($name, 'extends \\Drips\\MVC\\Controller');
                $generator->setNamespace('controllers');
                if(file_put_contents(DRIPS_SRC.'/controllers/'.$name.'.php', $generator->generate(true)) !== false){
                    Console::success('Der Controller wurde generiert');
                }else{
                    Console::error('Der Controller konnte nicht generiert werden');
                }

        }

    }


    public static function help()
    {
        Console::writeln('Mithilfe des Controller-Kommandos wird eine neue Controllerklasse erzeugt.');
        Console::writeln('  php drips controller add {name}');
    }
}
