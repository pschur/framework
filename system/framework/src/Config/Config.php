<?php

namespace System\Config;

use System\Filesystem\File;

class Config
{
    /**
     * Config Constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * Get Config
     * 
     * @param string $source
     * @return mixed
     */
    public static function get($source)
    {
        list($file, $array) = explode('@', $source);
        $data = File::require_file('/config/'.$file.'.php');
        if (isset($data[$array])) {
            return($data[$array]);
        }
        throw new \Exception("In the Configfile [$file.php] isn't a config [".$array."]", 1);
        
        return null;
    }
}