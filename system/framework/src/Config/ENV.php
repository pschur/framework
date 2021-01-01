<?php

namespace System\Config;

use System\Filesystem\File;

class ENV
{
    /**
     * var $env
     */
    private static $env;

    /**
     * Config Constructor
     * 
     * @return void
     */
    private function __construct(){}

    public static function init(){
        if (self::$env == null) {
            $dotenv = \Dotenv\Dotenv::createImmutable(ROOT);
            self::$env = $dotenv->load();
        }
    }

    /**
     * Get Config
     * 
     * @param string $source
     * @return mixed
     */
    public static function get($name, $default = null)
    {
        self::init();
        $env = self::$env;
        if (!isset($env[$name])) {
            return $default;
        }
        return $env[$name];
    }
}