<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 日志
 */
namespace core\src\utils;

class LogUtils
{
    private static $logDir=null;
    /**
     * 日志记录工具
     * @param string $file 日志名称
     * @param string $message 日志描述
     * @param null $context 日志内容
     * @return int
     */
    public static function log($file,$message,$context=null){
        if(self::$logDir){
            $dir=self::$logDir;
        }else{
            $dir=self::$logDir=__DIR__.'/../../../data/logs';
        }
        $dir=rtrim($dir,'/');
        $dir=$dir.'/'.date('Ym').'/';
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        if($context&&!is_string($context)){
            $context=json_encode($context);
        }
        $fileName=$dir.$file.'_'.date('Y-m-d').'.log';
        $date=date('Y-m-d H:i:s');
        $log='['.$date.'] - '.$message.' - '.$context."\r\n\r\n";
        return file_put_contents($fileName, $log,FILE_APPEND);
    }

    /**
     * @param string $file 绝对路径和文件名
     * @param string $message 内容
     * @return int
     */
    public static function logs($file,$message){
        $date=date('Y-m-d H:i:s');
        $logs='['.$date.'] - '.$message."\r\n\r\n";
        return file_put_contents($file, $logs,FILE_APPEND);
    }
}