<?php

namespace System\Console\Facades;

use System\Filesystem\Facades\File;
use Symfony\Component\Console\Style\SymfonyStyle;

class Console {
    /**
     * Console constructor
     *
     * @return void
     */
    private function __construct() {}

    /**
     * file
     * 
     * @return \System\Filesystem\Facades\File
     */
    public static function file(string $path, string $mode){
        return new File($path, $mode);
    }

    /**
     * style
     * 
     * @return Symfony\Component\Console\Style\SymfonyStyle
     */
    public static function style($input, $output){
        return new SymfonyStyle($input, $output);
    }
}