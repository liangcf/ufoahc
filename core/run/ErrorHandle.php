<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/2/24
 * Time: 16:18
 */

namespace core\run;


class ErrorHandle
{
    public static function errorPage($errorInfo,$errorMsg){
        $msg=$errorMsg;
        $info=$errorInfo;
        require __DIR__ . '/../../var/error-page/error_info.phtml';
        exit;
    }

    public static function error404(){
        require __DIR__ . '/../../var/error-page/404.html';
        exit;
    }

    public static function error500(){
        require __DIR__ . '/../../var/error-page/500.html';
        exit;
    }

    public static function errorConfig(){
        include __DIR__ . '/../../var/error-page/error_config.html';
        exit;
    }
}