<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @link http://git.oschina.net/liangcf/ufoahc
 * @link https://github.com/liangcf/ufoahc
 */
if (is_file('./'.parse_url(@$_SERVER['REQUEST_URI'], PHP_URL_PATH))||stristr('cli',php_sapi_name())) {
    return false;
}
include '../init.php';
//执行开始
\core\run\Entry::run();