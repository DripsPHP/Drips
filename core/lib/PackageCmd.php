<?php

namespace Drips;

use Drips\CLI\ICommand;
use Drips\CLI\Console;

abstract class PackageCmd implements ICommand
{

    protected static function composer()
    {
        $composer_path = 'composer.phar';
        if (file_exists($composer_path)) {
            return 'php ' . $composer_path;
        }
        return 'composer';
    }

    public static function install($package = null, $version = '')
    {
        if ($package == null) {
            Console::error('Du musst ein Package angeben');
        } else {
            if (strpos($package, '/') === false) {
                $package = 'drips/' . $package;
            }
            shell_exec(static::composer() . ' require ' . $package . ' ' . $version);
        }
    }

    public static function uninstall($package = null)
    {
        if ($package == null) {
            Console::error('Du musst ein Package angeben');
        } else {
            if (strpos($package, '/') === false) {
                $package = 'drips/' . $package;
            }
            shell_exec(static::composer() . ' remove ' . $package);
        }
    }

    public static function installed()
    {
        echo shell_exec(static::composer() . ' show 2>&1');
    }

    public static function available()
    {
        echo shell_exec(static::composer() . ' search drips 2>&1');
    }


    public static function help()
    {
        Console::writeln('Mithilfe des Package Kommandos können die Packages verwaltet werden.');
        Console::writeln('Installation:');
        Console::writeln('  php drips package install {name} {version}');
        Console::writeln('  php drips package install {name}');
        Console::writeln('Deinstallation:');
        Console::writeln('  php drips package uninstall {name}');
        Console::writeln('Auflistung aller Packages:');
        Console::writeln('  php drips package installed');
        Console::writeln('Auflistung aller verfügbaren Packages:');
        Console::writeln('  php drips package available');
    }
}
