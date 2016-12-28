<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/12/26
 * Time: 21:54
 */

namespace core\rds\util;

class DirUtils
{
    /**
     * @param string $dirName 路径
     */
    public static function  delDir($dirName){
        if ($handle=opendir($dirName)){
            while (false!==($item=readdir($handle))){
                if ($item!="."&&$item!=".."){
                    if (is_dir($dirName.'/'.$item)){
                        self::delDir($dirName.'/'.$item);
                    } else {
                        unlink($dirName.'/'.$item);
//                        echo $dirName.'/'.$item."\r\n\r\n";
                    }
                }
            }
            closedir($handle);
            rmdir($dirName);//删除文件夹
//            echo "delete file".$dirName."\r\n\r\n";
        }
    }
}