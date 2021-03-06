<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 配置文件加载
 */
namespace core\run;

class GetConfigs
{
    private static $runConfig=array();
    private static $appConfig=array();
    private static $_root=null;
    /**
     * 读取配置文件
     * @return mixed
     */
    public static function getAppConfigs(){
        if(isset(self::$appConfig['application.data'])){
            return self::$appConfig['application.data'];
        }
        if(empty(self::$_root)){
            self::$_root=__DIR__.'/../..';
        }
        $data=require self::$_root.'/config/application.config.php';
        self::$appConfig['application.data']=$data;
        return self::$appConfig['application.data'];
    }

    /**
     * 由于一上来就读取改配置，需要对其判断
     * 读取数据库配置文件
     * @return mixed
     */
    public static function getRunConfigs(){
        if(isset(self::$runConfig['run.data'])){
            return self::$runConfig['run.data'];
        }
        if(empty(self::$_root)){
            self::$_root=__DIR__.'/../..';
        }
        $runFile=self::$_root.'/config/run.config.php';
        if(is_file($runFile)){
            $data=require $runFile;
            self::$runConfig['run.data']=$data;
            return self::$runConfig['run.data'];
        }
        ErrorHandle::errorConfig();
        exit;
    }
}