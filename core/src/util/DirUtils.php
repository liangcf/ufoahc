<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 文件夹操作工具
 */
namespace core\src\util;

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

    /**
     * 删除文件夹
     * @param $dirName
     */
    public static function  delFile($dirName){
        if ($handle=opendir($dirName)){
            while (false!==($item=readdir($handle))){
                if ($item!="."&&$item!=".."){
                    if (is_dir($dirName.'/'.$item)){
                        self::delDir($dirName.'/'.$item);
                    } else {
                        unlink($dirName.'/'.$item);
                    }
                }
            }
            closedir($handle);
//            rmdir($dirName);//删除文件夹
        }
    }
}