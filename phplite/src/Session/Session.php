<?php

namespace Phplite\Session;

class Session
{
    /**
     * session constructor
     * @return void
    **/
    private function __construct(){}

    /**
     * Session start
     * @return void
    **/
    public static function start()
    {
        if (!session_id()){
            ini_set('session.use_only_cookies', 1);
            session_start();
        }
    }
    /**
     * set new session
     * @param string $key
     * @param string $value
     * @return string $value
    **/
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;

        return $_SESSION[$key];
    }

    /**
     * check the session has $key
     * @param string $key
     * @return bool
    **/

    public  static function has($key)
    {
       return isset($_SESSION[$key]);
    }

    /**
     * get session by $key
     * @param string $key
     * @return mixed
    **/
    public static function get($key)
    {
        return static::has($key) ? $_SESSION[$key] : null;
    }

    /**
     * remove session by $key
     * @param string $key
     * @return void
    **/
    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * return all session
     * @return array
    **/
    public static function all()
    {
        return $_SESSION;
    }

    /**
     * unset session
     * @return void
     */
    public static function destroy(){
        foreach (static::all() as $key => $value) {
            static::remove($key);
        }
        unset($_SESSION);
        session_destroy();
        session_start();
    }

    /**
     * flash session by key
     * @param string $key
     * @return mixed
    **/
    public static function flash($key)
    {
        $value = null;
        if (static::has($key)) {
            $value = static::get($key);
            static::remove($key);
        }
        return $value;
    }
}
