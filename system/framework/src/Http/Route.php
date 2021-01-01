<?php

namespace System\Http;

use System\Http\Request;
use System\View\View;

class Route {
    /**
     * Route id
     * 
     * @var string $routeId
     */
    private static $routeId;

    /**
     * Route container
     *
     * @var array $routes
     */
    protected static $routes = [];
    
    /**
     * Route name container
     *
     * @var array $names
     */
    private static $names = [];

    /**
     * Middleware
     *
     * @var string $middleware
     */
    private static $middleware;

    /**
     * Prefix
     *
     * @var string $prefix
     */
    private static $prefix;

    /**
     * Instance
     *
     * @var $instance
     */
    private static $instance;

    /**
     * Route constructor
     *
     * @return void
     */
    private function __construct($id) {
        self::$routeId = $id;
    }

    /**
     * instance
     */
    private static function instance($id)
    {
        if (!static::$instance) {
            static::$instance = new Route($id);
        }
        return static::$instance;
    }

    /**
     * Add route
     *
     * @param string methods
     * @param string $uri
     * @param object|callback $callback
     */
    private static function add($methods, $uri, $callback) {
        $uri = trim($uri, '/');
        $uri = rtrim(static::$prefix . '/' . $uri, '/');
        $uri = $uri?:'/';
        foreach(explode('|', $methods) as $method) {
            static::$routes[] = [
                'uri' => $uri,
                'callback' => $callback,
                'method' => $method,
                'middleware' => static::$middleware,
            ];
        }
        return count(static::$routes);
    }

    /**
     * name route
     * 
     * @param string $name
     */
    private function name(string $name){
        if ($name != null) {
            static::$names[$name] = [
                'id' => static::$routeId,
                'route' => static::$routes[static::$routeId]['uri']
            ];
        }
    }

    /**
     * Add new get route
     *
     * @param string $uri
     * @param object|callback $callback
     */
    public static function get($uri, $callback) {
        $id = static::add('GET', $uri, $callback);
        return static::instance($id);
    }

    /**
     * Add new post route
     *
     * @param string $uri
     * @param object|callback $callback
     */
    public static function post($uri, $callback) {
        $id = static::add('POST', $uri, $callback);
        return static::instance($id);
    }

    /**
     * Add any get route
     *
     * @param string $uri
     * @param object|callback $callback
     */
    public static function any($uri, $callback) {
        static::add('GET|POST', $uri, $callback);
    }

    /**
     * Set prefix for routing
     *
     * @param string $prefix
     * @param callback $callback
     */
    public static function prefix($prefix, $callback) {
        $parent_prefix = static::$prefix;
        static::$prefix .= '/' . trim($prefix, '/');
        if (is_callable($callback)) {
            call_user_func($callback);
        } else {
            throw new \BadFunctionCallException("Please provide valid callback function");
        }

        static::$prefix = $parent_prefix;
    }

    /**
     * Set middleware for routing
     *
     * @param string $middleware
     * @param callback $callback
     */
    public static function middleware($middleware, $callback = null) {
        $parent_middleware = static::$middleware;
        static::$middleware .= '|' . trim($middleware, '|');
        if (is_callable($callback)) {
            call_user_func($callback);
        } elseif ($callback == null AND static::$routeId != null) {
            static::$routes[static::$routeId]['middleware'] = static::$middleware;
        } else {
            throw new \BadFunctionCallException("Please provide valid callback function");
        }

        static::$middleware = $parent_middleware;
    }

    /**
     * Handle the request and match the routes
     *
     * @return mixed
     */
    public static function handle() {
        $uri = Request::url();

        foreach(static::$routes as $route) {
            $matched = true;
            $route['uri'] = preg_replace('/\/{(.*?)}/', '/(.*?)', $route['uri']);
            $route['uri'] = '#^' . $route['uri'] . '$#';
            if (preg_match($route['uri'], $uri, $matches)) {
                array_shift($matches);
                $params = array_values($matches);
                foreach($params as $param) {
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
            }
        }

        return View::error(404);
    }

    /**
     * Invokde the route
     *
     * @param array $route
     * @param array $params
     */
    public static function invoke($route, $params = []) {
        static::executeMiddleware($route);
        $callback = $route['callback'];
        if (is_callable($callback)) {
            return call_user_func_array($callback, $params);
        } elseif (strpos($callback, '@') !== false) {
            list($controller, $method) = explode('@', $callback);
            $controller = 'App\Controllers\\' . $controller;
            if (class_exists($controller)) {
                $object = new $controller;
                if (method_exists($object, $method)) {
                    return call_user_func_array([$object, $method], $params);
                } else {
                    debug(function(){throw new \BadFunctionCallException("The method is not exists at the controller class");});
                }
            } else {
                debug(function(){throw new \ReflectionException("the controller class is not found");});
            }
        } else {
            debug(function(){throw new \InvalidArgumentException("Please provide valid callback function");});
        }
    }

    /**
     * Execute middleware
     *
     * @param array $route
     */
    public static function executeMiddleware($route) {
        foreach(explode('|', $route['middleware']) as $middleware) {
            if ($middleware != '') {
                $middleware = 'App\Middleware\\' . $middleware;
                if (class_exists($middleware)) {
                    $object = new $middleware;
                    call_user_func_array([$object, 'handle'], []);
                } else {
                    throw new \ReflectionException("class " . $middleware . " is not found");
                }
            }
        }
    }

    /**
     * route function
     * 
     * @param string $name
     * @return string
     */
    public static function route($name){
        return static::$names[$name];
    }
}