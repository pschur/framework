<?php

namespace Phplite\File;

class File{
    private function __construct(){}

    /**
     * root path
     * @return string
     */
    public static function root(){
        return ROOT;
    }

    /**
     * Directory Seperator
     * @return string
     */
    public static function ds(){
        return DS;
    }

    /**
     * get file full path
     * @param string $path
     * @return string $fullPath
     */
    public static function path($path){
        $path = static::root().static::ds().trim($path, '/');
        $path = str_replace(['/', '\\'], static::ds(), $path);
        return $path;
    }

    /**
     * check that the file exist
     * @param string $path
     * @return bool
     */
    public static function exist($path){
        return file_exists(static::path($path));
    }

    /**
     * require file
     * @param string $path
     * @return mixed
     */
    public static function require_file($path){
        if(static::exist($path)){
            return require_once static::path($path);
        }
        return null;
    }
    
    /**
     * include file
     * @param string $path
     * @return mixed
     */
    public static function include_file($path){
        if(static::exist($path)){
            return include static::path($path);
        }
        echo static::path($path)." | Error Datei nicht gefunden.<br>";
    }

    /**
     * require directory
     * @param string $path
     * @return mixed
     */
    public static function require_dir($path){
        $files =  array_diff(scandir(static::path($path)), ['.', '..']);
        foreach ($files as $file) {
            $file_path = $path.static::ds().$file;
            static::require_file($file_path);
        }
    }
}
