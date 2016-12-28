<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/12/28
 * Time: 15:32
 */

namespace core\rds\tool;


class Factory
{
    /**
     * 返回到实例
     * @param $className
     * @return bool
     */
    public static function getDaoModel($className)
    {
        $class='app\\src\\toge\\dao\\'.ucwords($className);
        $model=Register::get($class);
        if (!$model) {
            $model=new $class;
            Register::set($class, $model);
        }
        return $model;
    }
}