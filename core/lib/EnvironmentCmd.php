<?php

namespace Drips;

use Drips\CLI\ICommand;
use Drips\CLI\Console;

abstract class EnvironmentCmd implements ICommand
{
    public static function dev()
    {
        $result = shell_exec('php composer.phar install --dev');
        if(strpos($result, 'Could not open input file: composer.phar') !== false){
            Console::error('Aktivierung der Entwicklungsumgebung nicht möglich - composer fehlt!');
        } else {
            Console::success('Drips wird nun in der Entwicklungsumgebung betrieben.');
        }
    }

    public static function prod()
    {
        $result = shell_exec('php composer.phar install --no-dev');
        if(strpos($result, 'Could not open input file: composer.phar') !== false){
            Console::error('Aktivierung der Produktivumgebung nicht möglich - composer fehlt!');
        } else {
            Console::success('Drips wird nun in der Produktivumgebung betrieben.');
        }
    }

    public static function help()
    {
        Console::writeln('Mithilfe des env-Kommandos kann zwischen Entwicklungs- und Produktivumgebung umgeschalten werden.');
        Console::writeln('Entwicklungsumgebung aktivieren:');
        Console::writeln('  php drips env dev');
        Console::writeln('Produktivumgebung aktivieren:');
        Console::writeln('  php drips env prod');
        Console::success('Aktiv: ' . (DRIPS_DEBUG ? 'DEVELOPMENT' : 'PRODUCTION'));
    }
}
