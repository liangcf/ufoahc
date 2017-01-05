<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/12/28
 * Time: 15:33
 */

namespace core\rds\tool;

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