<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/9/19
 * Time: 16:49
 * url: http://git.oschina.net/liangcf/ufoahc
 * url: https://github.com/liangcf/ufoahc
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