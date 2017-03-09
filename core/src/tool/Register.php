<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 注册方法
 */

namespace core\src\tool;

class Register
{
    private static $objects;

    public static function set($key,$object)
    {
        self::$objects[$key]=$object;
    }

    public static function get($key)
    {
        if (isset(self::$objects[$key]))
        {
            return self::$objects[$key];
        }
        return false;
    }

    public function _unset($key)
    {
        unset(self::$objects[$key]);
    }
}