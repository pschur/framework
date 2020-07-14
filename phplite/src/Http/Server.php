<?php

namespace Phplite\Http;

class Server{
    /**
     * construct
     */
    private function __construct() {}

    /**
     * check that the server has $key
     * 
     * @param string $key
     * 
     * @return bool 
     */
    public static function has($key){
        return isset($_SERVER[$key]);
    }

    /**
     * get a key
     * 
     * @param $key
     * 
     * @return mixed
     */
    public static function get($key){
        return static::has($key) ? $_SERVER[$key] : null;
    }

    /**
     * get all data
     * 
     * @return array
     */
    public static function all(){
        return $_SERVER;
    }

    /**
     * get path info for path
     * 
     * @param string $path
     * 
     * @return array
     */
    public static function path_info($path){
        return pathinfo($path);
    }
}