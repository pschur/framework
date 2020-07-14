<?php

namespace Phplite\Http;

class Request{
    /**
     * Script name
     * @var $script_name
     */
    private static $script_name;

    /**
     * Base Url
     * @var $base_url
     */
    private static $base_url;

    /**
     * Url
     * @var $url
     */
    private static $url;

    /**
     * full url
     * @var $full_url
     */
    private static $full_url;

    /**
     * Query string
     * @var $query_string
     */
    private static $query_string;

    /**
     * request constructor
     * @return void
     */
    private function __construct(){}

    /**
     * Handle the Request
     * 
     * @return void
     */
    public static function handle(){
        static::$script_name = str_replace( '\\', '', dirname(Server::get('SCRIPT_NAME')), );
        static::setBaseUrl();
        static::setUrl();
    }

    /**
     * set baseUrl
     * 
     * @return void
     */
    private static function setBaseUrl(){
        // http://framework.test
        $protocol = Server::get('REQUEST_SCHEME').'://';
        $host = Server::get('HTTP_HOST');
        $script_name = static::$script_name;

        static::$base_url = $protocol.$host.$script_name;
    }

    /**
     * set Url
     * 
     * @return void
     */
    private static function setUrl(){
        $request_uri = urldecode(Server::get('REQUEST_URI'));
        $request_uri = rtrim(str_replace(static::$script_name, '', $request_uri));
        static::$full_url = $request_uri;
        if (strpos($request_uri, '?') !== false) {
            $query_string = Server::get('QUERY_STRING');
            $explode = explode('?', $request_uri);
            list($request_uri, $query_string) = $explode;
            static::$query_string = $query_string;
        }
        static::$url = $request_uri;
    }

    /**
     * get baseUrl
     * 
     * @return string $base_url
     */
    public static function baseUrl(){
        return static::$base_url;
    }

    /**
     * get Url
     * 
     * @return string $url
     */
    public static function url(){
        return static::$url;
    }

    /**
     * get query string
     * 
     * @return string $query_string
     */
    public static function query_stirng(){
        return static::$query_string;
    }

    /**
     * get full_url
     * 
     * @return string $full_url
     */
    public static function full_url(){
        return static::$full_url;
    }

    /**
     * get request method
     * 
     * @return string
     */
    public static function method(){
        return Server::get('REQUEST_METHOD');
    }

    /**
     * Check that the request has the key
     * 
     * @param array $type
     * @param string $key
     * @return bool
     */
    public static function has($type, $key){
        return array_key_exists($key, $type);
    }

    /**
     * get the value from the Request
     * 
     * @param string $key
     * @param array $type
     * @return bool
     */
    public static function value($key, array $type = null){
        $type = isset($type) ? $type : $_REQUEST;
        return static::has($type, $key) ? $type[$key] : null;
    }

    /**
     * get value form get Request
     * 
     * @param string $key
     * @return string $value
     */
    public static function get($key){
        return static::value($key, $_GET);
    }

    /**
     * get value form post Request
     * 
     * @param string $key
     * @return string $value
     */
    public static function post($key){
        return static::value($key, $_POST);
    }

    /**
     * Set value for request by given key
     * @param string $key
     * @param string $value
     * @return string $value
     */
    public static function set($key, $value){
        $_REQUEST[$key] = $value;
        $_GET[$key] = $value;
        $_POST[$key] = $value;

        return $value;
    }

    /**
     * get previos request value
     * 
     * @return string
     */
    public static function previos(){
        return Server::get('HTTP_REFERER');
    }

    /**
     * get request all
     * 
     * @return array
     */
    public static function all(){
        return $_REQUEST;
    }
}