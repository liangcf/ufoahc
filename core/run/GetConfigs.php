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
    private static $dbConfig=array();
    private static $appConfig=array();
    /**
     * 读取配置文件
     * @return mixed
     */
    public static function getAppConfigs(){
        if(isset(self::$appConfig['application.config'])&&self::$appConfig['application.config']===true){
            return self::$appConfig['application.data'];
        }
        $data=require __DIR__.'/../../config/application.config.php';
        self::$appConfig['application.config']=true;
        self::$appConfig['application.data']=$data;
        return self::$appConfig['application.data'];
    }

    /**
     * 由于一上来就读取改配置，需要对其判断
     * 读取数据库配置文件
     * @return mixed
     */
    public static function getRunConfigs(){
        if(isset(self::$dbConfig['run.config'])&&self::$dbConfig['run.config']===true){
            return self::$dbConfig['run.data'];
        }
        $runFile=__DIR__.'/../../config/run.config.php';
        if(is_file($runFile)){
            $data=require $runFile;
            self::$dbConfig['run.config']=true;
            self::$dbConfig['run.data']=$data;
            return self::$dbConfig['run.data'];
        }
        $message='<h2 style="text-align: center">没有配置文件[run.config.php]</h2>';
        include __DIR__ . '/../../var/error-page/500.phtml';
        exit;
    }

}