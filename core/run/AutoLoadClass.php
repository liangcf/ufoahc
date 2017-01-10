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
    /*自动加载函数*/
    public static function loader($class){
        if(class_exists($class,false)){
            return true;
        }
        $class=str_replace('\\','/',$class);
        $file=__DIR__.'/../../'.$class.'.php';
        if(isset(self::$class_Map[$class])){
            return true;
        }
        if(is_file($file)){
            include $file;
            self::$class_Map[$class]=$class;
            return true;
        }
        return false;
    }
}