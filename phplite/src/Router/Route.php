<?php

namespace Phplite\Router;

use Phplite\Http\Server;
use Phplite\Http\Request;

class Route{
    /**
     * Route container
     * @var array $routes
     */
    private static $routes = [];

    /**
     * middleware
     * @var string $middleware
     */
    private static $middleware;

    /**
     * prefix
     * @var string $prefix
     */
    private static $prefix = null;

    /**
     * Route Constructor
     * @return void
     */
    private function __construct(){}

    /**
     * current url
     * @return string $url
     */
    public static function curUrl(){
        $url = Server::get('REQUEST_URI');
        $url = explode('?', $url);
        return $url[0];
    }
    /**
     * add Route
     * @param string $methods
     * @param string $uri
     * @param object|callback $callback 
     */
    private static function add($methods, $uri, $callback){
        $uri = trim($uri, '/');
        $uri = rtrim(static::$prefix.'/'.$uri, '/');
        $uri = $uri?:'/';
        foreach (explode('|', $methods) as $method) {
            static::$routes[] = [
                'uri'=>$uri,
                'callback'=>$callback,
                'method'=>$method,
                'middleware'=>static::$middleware
            ];
        }
    }

    /**
     * add new get route
     * @param string $uri
     * @param object|callback $callback
     */
    public static function get($uri, $callback){
        static::add("GET", $uri, $callback);
    }

    /**
     * add new post route
     * @param string $uri
     * @param object|callback $callback
     */
    public static function post($uri, $callback){
        static::add("POST", $uri, $callback);
    }

    /**
     * add any get route
     * @param string $uri
     * @param object|callback $callback
     */
    public static function any($uri, $callback){
        static::add("GET|POST", $uri, $callback);
    }

    /**
     * Set prefix for routing
     * 
     * @param string $prefix
     * @param callback $callback
     */
    public static function prefix($prefix, $callback){
        $parent_prefix = static::$prefix;
        static::$prefix .= '/'.trim($prefix, '/');
        if (is_callable($callback)) {
            call_user_func($callback);
        }
        else{
            throw new \Exception("Please provide valid callback function.", 1);
        }


        static::$prefix = $parent_prefix;
    }

    /**
     * Set middleware for routing
     * 
     * @param string $middleware
     * @param callback $callback
     */
    public static function middleware($middleware, $callback){
        $parent_middleware = static::$middleware;
        static::$middleware .= '|'.trim($middleware, '|');
        if (is_callable($callback)) {
            call_user_func($callback);
        }
        else{
            throw new \Exception("Please provide valid callback function.", 1);
        }


        static::$prefix = $parent_middleware;
    }

    /**
     * handle the request
     * @return mixed
     */
    public static function handle(){
        $uri = Request::url();
        foreach (static::$routes as $route) {
            $route['uri'] = preg_replace('/\/{(.*?)}/', '/(.*?)', $route['uri']);
            $route['uri'] = '#^'.$route['uri'].'$#';
            if (preg_match($route['uri'], $uri, $matches)) {
                array_shift($matches);
                $params = array_values($matches);
                $matched = true;
                foreach ($params as $param) {
                    if (strpos($param, '/')) {
                        $matched = false;
                    }
                }
                if ($route['method'] != Request::method()) {
                    $matched = false;
                }
                if ($matched == true) {
                    return static::invoke($route, $params);
                }
                throw new \Exception("The Page not found.", 1);
            }
        }
    }

    /**
     * invokde the Route
     * @param array $route
     * @param array $params
     */
    public static function invoke($route, $params){
        $callback = $route['callback'];
        if (is_callable($callback)) {
            return call_user_func_array($callback, $params);
        }
        elseif (strpos($callback, '@') !== false) {
            list($controller, $method) = explode('@', $callback);
            $controller = 'App\Controllers\\'.$controller;
            if(class_exists($controller)){
                $object = new $controller;
                if (method_exists($object, $method)) {
                    return call_user_func_array([$object, $method], $params);
                }
                else{
                    throw new \ReflectionException("The method ($method) doesn't exists in the class ($controller)");
                }
            }
            else {
                throw new \ReflectionException("The class ($controller) does not exist.");
            }
        }
        else {
            throw new \ReflectionException("Please provide a valid callback function.");
        }
    }

    /**
     * redirect
     * @param string $url
     * @param string $redirect
     */
    public static function redirect($url, $redirect){
        $url = trim($url, '/');
        $url = rtrim(static::$prefix.'/'.$url, '/');
        $url = $url?:'/';
        if ($uri == static::curUrl()) {
            $redirect = trim($url, '/');
            $redirect = rtrim(static::$prefix.'/'.$redirect, '/');
            $redirect = $redirect?:'/';
            return header("location: $redirect");
        }
        return null;
    }

    public static function all(){
        return static::$routes;
    }
}