<?php

namespace System\View;

use System\Filesystem\File;
use System\Session\Session;

class View {
    private static $path = 'views';
    /**
     * View Constructor
     *
     *
     */
    private function __construct() {}

    /**
     * Render error file
     * 
     * @param $code
     * @return string
     */
    public static function error($code){
        static::$path = 'storage'.File::ds().'framework'.File::ds().'errors';
        $data = self::render('error', \System\Http\Facades\Response::getError($code));
        static::$path = 'views';
        return $data;
    }

    /**
     * Render view file
     *
     * @param string $path
     * @param array $data
     * @return string
     */
    public static function render($path, $data = []) {
        $path = static::$path . File::ds() . str_replace(['/', '\\', '.'], File::ds(), $path) . '.blade.php';
        if (! File::exist($path)) {
            throw new \Exception("The view file {$path} is not exist");
        }

        ob_start();
        extract($data);
        include File::path($path);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}