<?php

namespace System\Console;

use Symfony\Component\Console\Application;
use System\Filesystem\File;

class Console{
    /**
     * app variable
     * 
     * @var class $app
     */
    private static $app;
    /**
     * console consrtuctor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * start console
     * 
     * @return mixed
     */
    public static function run(){
        self::$app = new Application();

        #self::add('CreateController');
        self::$app->add(new Commands\CreateController());
        self::$app->add(new Commands\AddEmailValidator());
        #File::require_file('routes/console.php');

        return self::$app->run();
    }

    /**
     * add a new command to console
     * 
     * @param string $class
     * @return void
     */
    public static function add(string $class){
        $class = 'App\Console\\'.$class;
        if (class_exists($class)) {
            static::$app->add(new $class);
        }
        else {
            debug(function(){dd('the console class not found!');});
        }
    }
}