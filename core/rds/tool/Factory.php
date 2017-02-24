<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function dao和service工厂方法
 */

namespace core\rds\tool;

class Factory
{
    private static $daoObj=array();
    private static $serviceObj=array();

    /**
     * 返回Dao实例
     * @param $className
     * @return \core\rds\db\Mysqli object
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

    /**
     * @param $className
     * @return \core\rds\service\Service object
     * @throws \Exception
     */
    public static function getServiceObj($className){
        $class='app\\src\\indep\\'.ltrim($className,'\\');
        if(isset(self::$serviceObj[$class])){
            return self::$serviceObj[$class];
        }
        try{
            self::$serviceObj[$class]=new $class();
        }catch (\Exception $e){
            throw new \Exception($class.'-- is not found:Factory->getServiceObj',500);
        }
        return self::$serviceObj[$class];
    }
}