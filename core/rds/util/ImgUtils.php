<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/12/2
 * Time: 18:47
 */

namespace core\rds\util;


class ImgUtils
{
    /**
     * @param $dir
     * @param $imgInfo
     * @param null $fileName
     * @return bool|string
     */
    public static function imgPng($dir,$imgInfo,$fileName=null){
        $dir=ltrim($dir,'/');
        $str=substr($dir,0,stripos($dir,'/')+1);
        if(stristr($imgInfo,$str)){
            return $imgInfo;
        }
        try {
            $dir=rtrim($dir,'/');
            $path=$_SERVER['DOCUMENT_ROOT'].'/'.$dir;
            $base64Info=substr(strstr($imgInfo,','),1);
            $imgInfo=base64_decode($base64Info);
            if(empty($fileName)){
                $fileName=UuidUtils::uuid().'.png';
            }else{
                $fileName=$fileName.'.png';
            }
            if (!is_dir($path)){
                mkdir($path, 0777,true);
            }
            $imgUrl='/'.$dir.'/'.$fileName;
            $path=$path.'/'.$fileName;
            file_put_contents($path,$imgInfo);//返回的是字节数
            return $imgUrl;
        }catch(\Exception $e) {
            echo '图片base64解码异常：'.$e->getMessage();
            return false;
        }
    }
}