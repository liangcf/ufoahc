<?php
/**
 * 运行时配置文件
 */
return array(
	/*数据库配置信息*/
	'default_db'=>array(
		'db_host'=>'localhost',
		'db_user'=>'root',
		'db_pwd'=>'Abcd4321@',
		'db_name'=>'ufoahc_db',
		'port'=>'3306',
		'db_char_set'=>'utf8'
	),
	/*配置第二个数据库*/
	'db_2'=>array(
		'db_host'=>'localhost',
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
	'mode'=>'dev',//pro
	/*缓存开关*/
	'cache_flag'=>false,//true开   false关
	'cache_time'=>120,//单位为秒
);