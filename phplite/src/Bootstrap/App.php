<?php

namespace Phplite\Bootstrap;

use Phplite\File\File;
use Phplite\Http\Server;
use Phplite\Http\Request;
use Phplite\Exeption\Whoops;
use Phplite\Session\Session;
use Phplite\Cookie\Cookie;
use Phplite\Router\Route;

class App{
    /**
     * App constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * Run application
     * 
     * @return void
     */
    public static function run(){
        //register Whoops
        Whoops::handle();

        //Start session
        Session::start();

        //handle the Request
        Request::handle();

        //include routes
        File::require_dir('routes');
        
        return Route::handle();
        echo "<pre>";
        #print_r(Server::all());
        echo "</pre>";
    }
}
