<?php

namespace System\Session;


class Session {
    /**
     * instance
     * @var mixed $instance
     */
    private static $instance;

    /**
     * instance
     * @var mixed $driver
     */
    private static $driver = 'local';

    /**
     * Session constructor
     *
     * @return void
     */
    private function __construct($driver = 'local') {
        static::$driver = $driver;
    }

    /**
     * instance
     * 
     */
    private static function instance($driver = 'local'){
        if (!static::$instance){
            static::$instance = new Session($driver);
        }
        return static::$instance;
    }

    /**
     * driver 
     * 
     * @param string $driver
     * @return mixed
     */
    public static function driver($driver){
        return self::instance($driver);
    }

    /**
     * Session start
     *
     * @return void
     */
    public static function start() {
        if (! session_id()) {
            ini_set('session.use_only_cookies', 1);
            session_start();
        }
    }

    /**
     * Set new session
     *
     * @param string $key
     * @param string $value
     *
     * @return string $value
     */
    public static function set($key, $value) {
        $_SESSION[static::$driver][$key] = $value;

        return $value;
    }

    /**
     * Check that session has the key
     *
     * @param string $key
     *
     * @return bool
     */
    public static function has($key) {
        return isset($_SESSION[static::$driver][$key]);
    }

    /**
     * Get session by the given key
     *
     * @param string $key
     *
     * @return mixed
     */
    public static function get($key) {
        return static::has($key) ? $_SESSION[static::$driver][$key] : null;
    }

    /**
     * Remove session by the given key
     *
     * @param string $key
     * @return void
     */
    public static function remove($key) {
        unset($_SESSION[static::$driver][$key]);
    }

    /**
     * Return all sessions
     *
     * @return array
     */
    public static function all() {
        return $_SESSION[static::$driver];
    }

    /**
     * Destroy the session
     *
     * return void
     */
    public static function destroy() {
        foreach(static::all() as $key => $value) {
            $value = null;
            static::remove($key);
        }
    }

    /**
     * Get flash session
     *
     * @params string $key
     * @return string $value
     */
    public static function flash($key) {
        $value = null;
        if (static::has($key)) {
            $value = static::get($key);
            static::remove($key);
        }
        return $value;
    }

    /**
     * Facade session
     * 
     * @param string $key = null
     * @param mixed $value = null
     * @return mixed
     */
    public static function facade(string $key = null, $value = null){
        if ($key == null && $value == null) {
            return self::instance();
        } elseif ($key != null && $value == null) {
            return self::get($key);
        } elseif ($key != null && $value != null) {
            return self::set($key, $value);
        } else {
            throw new \Exception("You have used an invalid type", 1);
        }
    }

}