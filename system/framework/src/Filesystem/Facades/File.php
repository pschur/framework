<?php

namespace System\Filesystem\Facades;

use System\Filesystem\File as Main;

class File
{
    /**
     * instance
     * 
     * @var mixed $instance
     */
    private $instance;

    /**
     * path
     * 
     * @var mixed $path
     */
    private $path;

    /**
     * file
     * 
     * @var mixed $file
     */
    private $file;

    /**
     * mode
     * 
     * @var mixed $mode
     */
    private $mode;

    /**
     * file Constructor
     * 
     * @param string $file
     * @param string $mode
     * @return mixed $instance
     */
    public function __construct(string $file, string $mode){
        $this->path = Main::path($file);
        $this->mode = $mode;
        $this->open($this->path, $this->mode);
    }

    /**
     * instance
     * 
     * @return mixed
     */
    private function instance(){
        if (!$this->instance) {
            $this->instance = new File($this->file, $this->mode);
        }
        return $this->instance;
    }
    
    /**
     * open file
     * 
     * @return void
     */
    public function open($mode){
        $file = $this->path;
        return $this->file = fopen($file, $mode) or debug(function(){throw new \Exception("Unable to open the file", 1);});
        
    }

    /**
     * create file
     * 
     * @return void
     */
    public function create(){
        $path = $this->path;
        $file = $this->open($path, 'a+');
        fwrite($file, '');
        fclose($file);
    }

    

    /**
     * create file
     * 
     * @return void
     */
    public static function creator($path){
        if (!Main::exist($path)) {
            $file = fopen(Main::path($path), 'a+') or  debug(function(){throw new \Exception("Unable to open the file", 1);});
            fwrite($file, '');
            fclose($file);
        }
    }

    /**
     * read file
     * 
     * @return mixed
     */
    public function read(){
        return fread($this->file, filesize($this->path) or debug(function(){throw new \Exception("Unable to read the file", 1);}));
        
    }

    /**
     * write file
     * 
     * @param string $text
     * @return mixed
     */
    public function write(string $text){
        fwrite($this->file, $text) or debug(function(){throw new \Exception("Unable to write on file", 1);});
    }

    /**
     * close file
     * 
     * @return void
     */
    public function close()
    {
        return fclose($this->file);
    }
}
