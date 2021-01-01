<?php

namespace System\Log;

use Monolog\Logger as Service;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Formatter\LineFormatter;
use System\Filesystem\File;

class Logger{
    /**
     * logger
     * @var mixed $logger
     */
    private static $logger;

    /**
     * Logger constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * init
     */
    public static function init(){
        $dateFormat = "d.m.Y, H:m:s";
        $output = "[%datetime%] [%level_name%]: %message% %context% %extra%\n";
        $logger = new Service('App');
        // Now add some handlers
        $date = date('d.m.Y');
        $stream = new StreamHandler(File::path('storage/framework/log/'.$date.'.log'), Service::DEBUG);
        $stream->setFormatter(new LineFormatter($output, $dateFormat));
        $logger->pushHandler($stream);
        $logger->pushHandler(new FirePHPHandler());
        static::$logger = $logger;
        static::add('App Started at url: '.\System\Http\Server::get('PATH_INFO', '/'));
    }

    /**
     * add a log to the file
     * 
     * @param string $log
     * @return void
     */
    public static function add($log, $flag = 'info'){
        if (!is_string($log)) {
            if (is_callable($log)) {
                $log = call_user_func($log);
            }
        }

        if ($flag == 'info') {
            static::$logger->info($log);
        } elseif ($flag == 'warning') {
            static::$logger->warning($log);
        } elseif ($flag == 'error') {
            static::$logger->error($log);
        } else {
            static::$logger->info($log);
        }
        return null;
    }
}