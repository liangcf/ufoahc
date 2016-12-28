<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/7/20
 * Time: 15:32
 * url: http://git.oschina.net/liangcf/ufoahc
 * url: https://github.com/liangcf/ufoahc
 */
if (is_file('./'.parse_url(@$_SERVER['REQUEST_URI'], PHP_URL_PATH))||stristr('cli',php_sapi_name())) {
    return false;
}
include '../init.php';
//执行开始
\core\run\Entry::run();