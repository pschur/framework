<?php

namespace System\Bootstrap;

use System\Exceptions\Whoops;
use System\Config\ENV;
use System\Http\Request;
use System\Http\Response;
use System\Filesystem\File;
use System\Http\Route;
use System\Session\Session;
use System\Log\Logger;

class App
{
    /**
     * App Constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * Run the App
     * 
     * @return void
     */
    public static function run()
    {
        //app path
        define('SYSTEM_PATH', realpath(__DIR__.'/..'));
        //Register Whoops
        Whoops::handle();

        // init env file
        ENV::init();

        // Start session
        Session::start();

        // init log file
        Logger::init();

        // Handle the request
        Request::handle();

        // Require routes directory
        File::require_file('routes/api.php');
        File::require_file('routes/web.php');

        // Handle the route
        $data = Route::handle();

        // Output the response
        Response::output($data);
    }
}