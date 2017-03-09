<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function cookie操作工具
 */

namespace core\src\util;


class CookieUtils
{
    /**
     * 清空
     * @param $cookieKey
     * @return bool
     */
    public static function clearCookie($cookieKey) {
        $res=self::saveCookie($cookieKey,array());
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
    public static function getCookie($cookieKey) {
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
    public static function saveCookie($cookieKey,$cookieArr,$expires=3600*24*7,$dir='/') {
        $tmpSerialize = json_encode($cookieArr);
        $res=setcookie($cookieKey,$tmpSerialize,time()+$expires,$dir);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}