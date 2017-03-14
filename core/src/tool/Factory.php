<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function dao和service工厂方法
 */

namespace core\src\tool;

class Factory
{
    private static $daoObj=array();

    /**
     * @param $className
     * @param $module
     * @return \core\src\db\Mysqli object 返回Dao实例
     * @throws \Exception
     */
    public static function getDaoObj($className,$module){
        $class='app\\'.$module.'\\src\\dao\\'.ucwords($className);
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