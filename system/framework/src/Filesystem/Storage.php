<?php

namespace System\Filesystem;

use League\Flysystem\Local\LocalFilesystemAdapter as Service;
use League\Flysystem\Filesystem;

class Storage {
    /**
     * filesystem
     * 
     * @var mixed $filesystem
     */
    private static $filesystem;

    
    /**
     * File constructor
     *
     * @return void
     */
    private function __construct() {}

    /**
     * init
     */
    public static function init(){
        $adapter = new Service(File::path('storage/app/public/'));
        static::$filesystem = new Filesystem($adapter);;
    }
}