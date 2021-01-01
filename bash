<?php

/*
| Define root path
|
*/
define('ROOT', realpath(__DIR__));

/*
| Directory separator
|
*/
define('DS', DIRECTORY_SEPARATOR);

echo "\n";
#die('Die Konsole ist in Arbeit...');

/*if ($argc != 2 || in_array($argv[1], array('--help', '-help', '-h', '-?'))) {
    ?>
    
    Das ist ein Kommandozeilenprogramm in PHP mit einer Option.
    
      Benutzung:
      <?php echo $argv[0]; ?> <option>
    
      <option> kann ein Wort sein, das Sie gerne
      ausgeben möchten. Mit den Optionen --help,
      -help, -h oder -? bekommen Sie diese Hilfe.
    
    <?php
    } else {
        echo $argv[1];
    }*/

require __DIR__.'/vendor/autoload.php';

System\Console\Console::run();