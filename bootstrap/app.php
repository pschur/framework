<?php

use Phplite\Bootstrap\App;


class Application{
    /**
     * App constructior
     */
    private function __construct(){}

    /**
     * Run the Application
     * 
     * @return void
     */
    public static function run(){
        /**
         * Define root path
         */
        define('ROOT', realpath(__DIR__.'/..'));

        /**
         * Define separator
         */
        define('DS', DIRECTORY_SEPARATOR);

        /**
         * Runs the application
         */
        App::run();
    }
}