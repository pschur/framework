<?php

/**
 * App function
 * 
 * @return void
 */
if (!function_exists('app')) {
    function app(){
        return null;
    }
}

/**
 * Auth
 * 
 * @return mixed
 */
if (!function_exists('auth')) {
    function auth(){
        #return \System\Auth\Auth::helper();
    }
}

/**
 * Asset path
 *
 * @param string $path
 * @return mixed
 */
if (! function_exists('asset')) {
    function asset($path) {
        return \System\Http\Url::path($path);
    }
}

/**
 * get config
 * 
 * @param string $source
 * @return mixed
 */
if (!function_exists('config')) {
    function config($source){
        return \System\Config\Config::get($source);
    }
}

/**
 * Dump
 *
 * @param string $data
 * @return void
 */
if (! function_exists('d')) {
    function d($data) {
        echo "<pre>";
        if (is_string($data)) {
            echo $data;
        } else {
            print_r($data);
        }
        echo "</pre>";
    }
}

/**
 * Dump and die
 *
 * @param string $data
 * @return void
 */
if (! function_exists('dd')) {
    function dd($data) {
        echo "<pre>";
        if (is_string($data)) {
            echo $data;
        } else {
            print_r($data);
        }
        echo "</pre>";
        die();
    }
}

/**
 * debuger
 * 
 * @param object $action
 * @param $code = 500
 * @return mixed
 */
if (!function_exists('debug')) {
    function debug($action, $code = 500){
        return \System\Debug\Debug::debug($action, $code);
    }
}

/**
 * env function.
 * 
 * @param string $name
 * @param string $default
 * @return string
 */
if (!function_exists('env')) {
    function env($name, $default = null){
        return \System\Config\ENV::get($name, $default);
    }
}

/**
 * error function
 * 
 * @param int $code
 * @return mixed
 */
if (!function_exists('e')) {
    function e(int $code){
        return \System\Http\Facades\Response::return($code);
    }
}

/**
 * Get/set/delete/... session data
 *
 * @param string $key = null
 * @param string $value = null
 * @return mixed
 */
if (! function_exists('session')) {
    function session($key = null, $value = null) {
        return System\Session\Session::facade($key, $value);
    }
}


/**
 * View render
 *
 * @param string $path
 * @param array $data
 * @return mixed
 */
if (! function_exists('view')) {
    function view($path, $data = []) {
        return System\View\View::render($path, $data);
    }
}

/**
 * Request get
 *
 * @param string $key
 * @return mixed
 */
if (! function_exists('request')) {
    function request($key = null) {
        return System\Http\Request::get($key);
    }
}

/**
 * Redirect
 *
 * @param string $path
 * @return mixed
 */
if (! function_exists('redirect')) {
    function redirect($path) {
        return System\Http\Url::redirect($path);
    }
}

/**
 * Previous
 *
 * @return mixed
 */
if (! function_exists('previous')) {
    function previous() {
        return System\Http\Url::previous();
    }
}

/**
 * Url path
 *
 * @param string $path
 * @return mixed
 */
if (! function_exists('url')) {
    function url($path) {
        return System\Http\Url::path($path);
    }
}

/**
 * Show pagination links
 *
 * @param string $current_page
 * @param string $pages
 * @return string
 */
if (! function_exists('links')) {
    function links($current_page, $pages) {
        return System\Database\DB::links($current_page, $pages);
    }
}

/**
 * Route
 * @param string $name
 * @return string $uri
 */
if (!function_exists('route')) {
    function route($name){
        $uri = \System\Http\Route::route($name)['route'];
        $uri = trim($uri, '/');
        $uri = '/'.$uri;
        return url($uri);
    }
}