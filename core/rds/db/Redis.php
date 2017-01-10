<?php
/**
 * @author 梁朝富 lcf@jionx.com
 */


namespace core\rds\db;


class Redis
{
    /**
     * @var \Redis
     */
    private static $connect=null;

    /**
     * @param $config
     * @return null|\Redis
     */
    public static function getRedis($config){
        if(self::$connect){
            return self::$connect;
        }
        $redis=RedisInstance::initRedis($config);
        self::$connect=$redis->getRedisConn();
        return self::$connect;
    }
}