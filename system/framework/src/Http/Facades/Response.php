<?php

namespace System\Http\Facades;

class Response{
    private static $e = [];

    /**
     * init response
     */
    public static function init(){
        static::$e = config('response@codes');
    }

    /**
     * return error
     * 
     * @param int $code
     * @return mixed
     */
    public static function return(int $code){
        if (isset(static::$e[$code])) {
            return header('HTTP/1.1 '.$code.' '.static::$e[$code]);
        }
    }

    /**
     * get text for code
     * 
     * @param $code
     * @return array
     */
    public static function getError($code){
        if (isset(static::$e[$code])) {
            return ['code' => $code, 'text' => static::$e[$code]];
        }
        return ['code' => null, 'text' => null];
    }
}