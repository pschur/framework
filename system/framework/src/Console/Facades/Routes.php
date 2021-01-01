<?php

namespace System\Console\Facades;

use System\Http\Route as Router;

class Routes extends Router {
    /**
     * Route constructor
     *
     * @return void
     */
    private function __construct() {}

    /**
     * list all routes
     * 
     * @return string
     */
    public static function list(){
        foreach (static::$routes as $route) {
            echo $route['uri'], '---', $route['callback'], '---', $route['method'], '---', $route['middleware'];
        }
        exit();
    }
}