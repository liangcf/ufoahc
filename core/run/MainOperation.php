<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/11/15
 * Time: 11:04
 */
namespace core\run;

class MainOperation{
	
    private static $objects = array();

    public static function mainMethod($className,$method){
        try {
            if(!isset(self::$objects[$className])){
                self::$objects[$className]=new $className();
            }
            $whole['before']=self::$objects[$className]->beforeRequest();
            if(!method_exists(self::$objects[$className],$method)){
                throw new \Exception($method.'-- is not found',500);
            }
            $whole['data']=self::$objects[$className]->$method();
            $whole['after']=self::$objects[$className]->afterRequest();
            $whole['layout']=self::$objects[$className]->_getLayOut();
            return $whole;
        } catch (\Exception $e) {
            throw new \Exception($className.'-- is not found',500);
        }
    }
}