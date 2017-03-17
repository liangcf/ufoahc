<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 数据反射
 */
namespace core\run;

class MainRun{
	
    private static $objects = array();

    public static function runMethod($className,$method,$module){
        try {
            if(!isset(self::$objects[$className])){
                self::$objects[$className]=new $className();
            }
            self::$objects[$className]->initModule($module);
//            self::$objects[$className]->initPath($root);
            $whole['before']=self::$objects[$className]->beforeRequest();
            if(!method_exists(self::$objects[$className],$method)){
                throw new \Exception($method.'-- is not found',500);
            }
            $whole['data']=self::$objects[$className]->$method();
            $whole['after']=self::$objects[$className]->afterRequest();
            $whole['layout']=self::$objects[$className]->_getLayOut();
            return $whole;
        } catch (\Exception $e) {
            throw new \Exception($className.'-- is not found in MainRun:runMethod',500);
        }
    }
}