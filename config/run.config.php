<?php
/**
 * 运行时配置文件
 */
return array(
	/*数据库配置信息*/
	'db'=>array(
		'db_host'=>'106.14.32.146',
		'db_user'=>'root',
		'db_pwd'=>'Abcd4321@',
		'db_name'=>'ufoahc_db',
		'port'=>'3306',
		'db_char_set'=>'utf8'
	),
	/*配置第二个数据库*/
	'db_2'=>array(
		'db_host'=>'106.14.32.146',
		'db_user'=>'root',
		'db_pwd'=>'Abcd4321@',
		'db_name'=>'ufoahc_db_test',
		'port'=>'3306',
		'db_char_set'=>'utf8'
	),
    /*配置redis*/
    'redis'=>array(
        'host'=>'127.0.0.1',
        'port'=>6379,
        'db_index'=>'0'
    ),
	/*配置开发环境*/
	'mode'=>true,// true开发环境，false非开发环境
);