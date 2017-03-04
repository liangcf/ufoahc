<?php
/**
 * @author 梁朝富
 * @mail lcf@jionx.com
 * @link http://git.oschina.net/liangcf/ufoahc
 * @link https://github.com/liangcf/ufoahc
 *
 * ═━═━═━═━═━═━═━═━═━═━═
 * LCF   枪毙BUG  ▄︻┻═┳一     oO~BUG
 * ═━═━═━═━═━═━═━═━═━═━═
 */
if (is_file('./'.parse_url(@$_SERVER['REQUEST_URI'], PHP_URL_PATH))||stristr('cli',php_sapi_name())) {
    return false;
}
include '../init.php';
$num=isset($_GET['num'])?$_GET['num']:'';
if($num==404){
    \core\run\ErrorHandle::error404();
}else{
    \core\run\ErrorHandle::error500();
}