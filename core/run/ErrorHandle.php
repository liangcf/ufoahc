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
    public static function redirect(){
        header('location:/error.html');
        exit();
    }
    public static function errorPage($errorInfo,$errorMsg){
        $msg=$errorMsg;
        $info=$errorInfo;
        require __DIR__ . '/../../data/var/error-page/error_info.phtml';
        exit;
    }

    public static function error404(){
        ob_clean();
        require __DIR__ . '/../../data/var/error-page/404.html';
        exit;
    }

    public static function error500(){
        ob_clean();
        require __DIR__ . '/../../data/var/error-page/500.html';
        exit;
    }

    public static function errorConfig(){
        require __DIR__ . '/../../data/var/error-page/error_config.html';
        exit;
    }
}