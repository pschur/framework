<?php

namespace Phplite\Exeption;

class Whoops
{
    /**
     * Whoops constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * Handle the whoops error
     * 
     * @return void
     */
    public static function handle()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }
}
