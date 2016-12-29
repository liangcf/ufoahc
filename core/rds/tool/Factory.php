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
    private static $objects;

    /**
     * 返回Dao实例
     * @param $className
     * @return \core\rds\db\MysqliInterface object
     * @throws \Exception
     */
    public static function getDaoModel($className)
    {
        $class='app\\src\\toge\\dao\\'.ucwords($className);
        if(isset(self::$objects[$class])){
            return self::$objects[$class];
        }
        try{
            self::$objects[$class]=new $class();
        }catch (\Exception $e){
            throw new \Exception($class.'-- is not found:Factory',500);
        }
        return self::$objects[$class];
    }
}