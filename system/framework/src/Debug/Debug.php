<?php

namespace System\Debug;

use System\Http\Facades\Response;
use System\Log\Logger;

class Debug
{
    /**
     * Debug constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * debug
     * 
     * @param object|callback $action
     * @param $code
     * @return mixed
     */
    public static function debug($action, $code = 500){
        Logger::add($action);
        if (env('APP_DEBUG', false) == true) {
            if (is_callable($action)) {
                return call_user_func($action);
            } else {
                return $action;
            }
        } else {
            if ($code == 0 OR $code == 200) {
                return null;
            } else {
                return Response::return($code);
            }
        }
    }
}
