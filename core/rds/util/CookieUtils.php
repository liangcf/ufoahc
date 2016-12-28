<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/12/6
 * Time: 11:06
 */

namespace core\rds\util;


class CookieUtils
{
    /**
     * 清空
     * @param $cookieKey
     * @return bool
     */
    public function clearCookie($cookieKey) {
        $res=$this->saveCookie($cookieKey,array());
        if($res){
            return true;
        }
        return false;
    }

    /**
     * 查看cookie 信息
     * @param $cookieKey
     * @return bool|mixed|string
     */
    public function getCookie($cookieKey) {
        $cookieInfo=isset($_COOKIE[$cookieKey])?$_COOKIE[$cookieKey]:'';
        if(!$cookieInfo){
            return false;
        }
        $cookieInfo = json_decode($cookieInfo,true);
        if(!$cookieInfo){
            return false;
        }
        return $cookieInfo;
    }

    /**
     * 保存cookie
     * @param $cookieKey
     * @param $cookieArr
     * @param int $expires
     * @param string $dir
     * @return bool
     */
    public function saveCookie($cookieKey,$cookieArr,$expires=3600*24*7,$dir='/') {
        $tmpSerialize = json_encode($cookieArr);
        $res=setcookie($cookieKey,$tmpSerialize,time()+$expires,$dir);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}