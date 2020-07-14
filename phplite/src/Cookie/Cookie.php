<?php
namespace Phplite\Cookie;

class Cookie
{
    /**
     * cookie constructor
     * 
     * @return void
    **/
    private function __construct(){}
    /**
     * set new cookie
     * 
     * @param string $key
     * @param string $value
     * 
     * @return string $value
    **/
    public static function set($key, $value, $path = null, $domain = null)
    {
        $expiered = time() + (1 * 365 * 24 * 60 * 60);
        if ($path != null) {
            if ($domain != null) {
                setcookie($key, $value, $expiered, $path, $domain);
                return $value;
            }
            else {
                setcookie($key, $value, $expiered, $path);
                return $value;
            }
        }
        else {
            setcookie($key, $value, $expiered);
            return $value;
        }
    }

    /**
     * check the cookie has $key
     * 
     * @param string $key
     * 
     * @return bool
    **/

    public  static function has($key)
    {
       return isset($_COOKIE[$key]);
    }

    /**
     * get cookie by $key
     * 
     * @param string $key
     * 
     * @return mixed
    **/
    public static function get($key)
    {
        return static::has($key) ? $_COOKIE[$key] : null;
    }

    /**
     * remove cookie by $key
     * 
     * @param string $key
     * 
     * @return void
    **/
    public static function remove($key)
    {
        unset($_COOKIE[$key]);
        setcookie($key, null, -1);
    }

    /**
     * return all cookie
     * 
     * @return array
    **/
    public static function all()
    {
        return $_COOKIE;
    }

    /**
     * unset cookie
     * 
     * @return void
     */
    public static function destroy(){
        foreach (static::all() as $key => $value) {
            static::remove($key);
        }
        unset($_COOKIE);
    }

    /**
     * flash cookie by $key
     * 
     * @param string $key
     * 
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
