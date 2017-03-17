<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 验证码
 */
namespace core\src\utils;

class VerifyCode
{
    /**
     * @param int $width 验证码宽度
     * @param int $height 验证码高度
     * @param int $length 验证码长度
     * @param string $yzmKey 验证码session key
     * @return bool
     */
    public static function yzmCode($width=100,$height=30,$length=4,$yzmKey='yzm_code'){
        if(!isset($_SESSION)){
            session_start();
        }
        $code=self::getCode($length);
        $_SESSION[$yzmKey]=$code;
        $img=imagecreate($width,$height);
        //画背景
        imagecolorallocate($img,255,255,255);
        //画边框
//        $borderColor=imagecolorallocate($img,mt_rand(0,150),mt_rand(0,150),mt_rand(0,150));
//        imagerectangle($img,0,0,$width-1,$height-1,$borderColor);
        //循环写字
        for($i=0;$i<strlen($code);$i++){
            $code_color=imagecolorallocate($img,mt_rand(0,200),mt_rand(0,128),mt_rand(0,200));
            $yRand=(int)$height/3;
            $charX=(($i*$width)/$length)+mt_rand(3,$yRand-$length);
            $charY=mt_rand(3,$yRand+$length);
            imagestring($img,5,$charX,$charY,$code[$i],$code_color);
        }

        //干扰的点点
        for($i=0;$i<$length*50;$i++){
            $pointColor=imagecolorallocate($img,mt_rand(0,200),mt_rand(0,200),mt_rand(0,200));
            imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),$pointColor);
        }

        //干扰的线
        for($i=0;$i<$length;$i++){
            $linkColor=imagecolorallocate($img,mt_rand(0,220),mt_rand(0,200),mt_rand(0,200));
            imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$linkColor);
        }
        ob_clean();
        header("Content-type:image/png;");
        imagepng($img);
        imagedestroy($img);
        return true;
    }
    /**
     * 生成验证码随机数
     * @param int $length 长度
     * @return string 返回的字符串
     */
    private static function getCode($length){
        $pattern='3571264890';//字符池
        $key='';
        for($i=0;$i<$length;$i++) {
            $key .= $pattern{mt_rand(0,9)};
        }
        return $key;
    }
}