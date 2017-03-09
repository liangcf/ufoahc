<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function redis操作
 */
namespace core\src\util;

class RedisUtils {
    /**
     * @var \Redis
     */
    private static $redis=null;
    private static $connect=null;

    /**
     * @param $config
     * @return \Redis
     */
    public static function getRedis($config){
        if(self::$redis&&self::$connect){
            return self::$redis;
        }
        self::$redis=new \Redis();
        self::$connect=self::$redis->connect($config['host'],$config['port']);
        self::$redis->select(isset($redis_info['db_index'])?$redis_info['db_index']:'0');
        return self::$redis;
    }
    
    public static function closeRedis(){
        if(!empty(self::$redis)){
            self::$connect=null;
            self::$redis->close();
        }
    }
}