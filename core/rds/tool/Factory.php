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
    private static $daoObj=array();

    /**
     * 返回Dao实例
     * @param $className
     * @return \core\rds\db\MysqliInterface object
     * @throws \Exception
     */
    public static function getDaoObj($className){
        $class='app\\src\\toge\\dao\\'.ucwords($className);
        if(isset(self::$daoObj[$class])){
            return self::$daoObj[$class];
        }
        try{
            self::$daoObj[$class]=new $class();
        }catch (\Exception $e){
            throw new \Exception($class.'-- is not found:Factory->getDaoObj',500);
        }
        return self::$daoObj[$class];
    }
}