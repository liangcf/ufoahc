<?php
/* 數據庫配置*/
$runFile=__DIR__.'/../../../config/run.config.php';
if(is_file($runFile)){
    $data=require $runFile;
    return $data;
}
exit('no run.config.php file');
/* 如果不需要和web的數據配置一致，注释以上 放开以下 */

/*return array(
    'default_db'=>array(
        'db_host'=>'127.0.0.1',//加p:是持久化数据连接
        'db_user'=>'root',
        'db_pwd'=>'Abcd4321',
        'db_name'=>'fr_test',
        'port'=>'3306',
        'db_char_set'=>'utf8'
    ),
);*/