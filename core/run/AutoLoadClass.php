<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 自动加载类
 * @link http://git.oschina.net/liangcf/ufoahc
 * @link https://github.com/liangcf/ufoahc
 */

namespace core\run;

class AutoLoadClass{
    private static $class_Map=array();
    private static $root=null;
    /*自动加载函数*/
    public static function loader($class){
        if(empty(self::$root)){
            self::$root=__DIR__.'/../../';
        }
        if(class_exists($class,false)){
            return true;
        }
        $class=str_replace('\\','/',$class);
        $file=self::$root.$class.'.php';
        if(isset(self::$class_Map[$class])){
            return true;
        }
        if(is_file($file)){
            require $file;
            self::$class_Map[$class]=$class;
            return true;
        }
        return false;
    }
}