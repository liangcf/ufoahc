<?php
namespace core\rds\util;

class RedisUtils {
    /**
     * @var \Redis
     */
    private static $redis=null;
    private static $redisConnect=null;

    /**
     * RedisUtils constructor.
     * @param $config
     * @throws \Exception
     */
    private function __construct($config){
        try{
            if(self::$redis==null){
                self::$redis = new \Redis();
            }
            $dbIndex=isset($redis_info['db_index'])?$redis_info['db_index']:0;
            self::$redisConnect=self::$redis->connect($config['host'],$config['port']);
            self::$redis->select($dbIndex); //数据库选择
            return self::$redis;
        }catch (\Exception $e){
            throw new \Exception('create redis connection Fail:'.$e->getMessage());
        }
    }

    /**
     * @param $config
     * @return \Redis
     */
    public static function getRedis($config){
        if(self::$redis&&self::$redisConnect){
            return self::$redis;
        }
        new self($config);
        return self::$redis;
    }
    /**
     * 关闭redis
     */
    public static function closeRedis(){
        if(!empty(self::$redis)){
            self::$redisConnect=null;
            self::$redis->close();
        }
    }

}