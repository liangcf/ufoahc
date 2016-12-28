<?php
//测试数据连接的
handleException();
$config= include "lib/config/config.php";
$config=$config['default_db'];
$conn=new \mysqli($config['db_host'],$config['db_user'],$config['db_pwd'],$config['db_name'],$config['port']);
if($conn->connect_errno){
    echo "\r\n\r\n database connect failed ! please configure the run.config.php file under the config folder \r\n\r\n";
}else{
    echo "\r\n\r\n database connect success ...\r\n\r\n";
}
if($conn){
    $conn->close();
}
exit;
function handleException(){
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    set_error_handler('error_handler');
}

function error_handler(){
    echo "\r\n\r\n no database,create connect failed !\r\n\r\n";
    exit;
}
