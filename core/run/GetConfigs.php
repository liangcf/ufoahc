<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/11/18
 * Time: 14:11
 */

namespace core\run;

class GetConfigs
{
    private static $runConfig=array();
    private static $appConfig=array();
    /**
     * 读取配置文件
     * @return mixed
     */
    public static function getAppConfigs(){
        if(isset(self::$appConfig['application.config'])){
            return self::$appConfig['application.data'];
        }
        $data=require __DIR__.'/../../config/application.config.php';
        self::$appConfig['application.data']=$data;
        return self::$appConfig['application.data'];
    }

    /**
     * 由于一上来就读取改配置，需要对其判断
     * 读取数据库配置文件
     * @return mixed
     */
    public static function getRunConfigs(){
        if(isset(self::$runConfig['run.config'])){
            return self::$runConfig['run.data'];
        }
        $runFile=__DIR__.'/../../config/run.config.php';
        if(is_file($runFile)){
            $data=require $runFile;
            self::$runConfig['run.data']=$data;
            return self::$runConfig['run.data'];
        }
        $message='<h2 style="text-align: center">没有配置文件[run.config.php]</h2>';
        include __DIR__ . '/../../var/error-page/500.phtml';
        exit;
    }

}