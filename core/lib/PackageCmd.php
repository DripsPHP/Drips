<?php

namespace Drips;

use Drips\CLI\ICommand;
use Drips\CLI\Console;

abstract class PackageCmd implements ICommand
{

    public static function install($package = null, $version = '')
    {
        if($package == null){
            Console::error('Du musst ein Package angeben');
        }else{
            if(strpos($package, '/') === false){
                $package = 'drips/'.$package;
            }
            shell_exec('composer require '.$package.' '.$version);
        }
    }

    public static function uninstall($package = null)
    {
        if($package == null){
            Console::error('Du musst ein Package angeben');
        }else{
            if(strpos($package, '/') === false){
                $package = 'drips/'.$package;
            }
            shell_exec('composer remove '.$package);
        }
    }

    public static function help()
    {
        Console::writeln('Mithilfe des Package Kommandos können die Abhängigkeiten verwaltet werden.');
        Console::writeln('Installation:');
        Console::writeln('  php drips package install {name} {version}');
        Console::writeln('  php drips package install {name}');
        Console::writeln('Deinstallation:');
        Console::writeln('  php drips package uninstall {name}');
    }
}
