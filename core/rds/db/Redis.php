<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2017/1/3
 * Time: 16:24
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