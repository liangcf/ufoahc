<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @link http://git.oschina.net/liangcf/ufoahc
 * @link https://github.com/liangcf/ufoahc
 */
//打印函数
include '../data/var/function.php';

require '../core/run/AutoLoadClass.php';
//自动加载类 '\core\run\AutoLoadClass::loader'
spl_autoload_register('\core\run\AutoLoadClass::loader',true,true);
//如果不启用上述的spl_autoload_register自动加载类可以使用composer，执行composer dump-autoload后注销spl_autoload_register 放开如下的引入即可
//require '../vendor/autoload.php';