<?php
/**
 * @author 梁朝富 lcf@jionx.com
 */


namespace core\src\db;

use core\run\GetConfigs;

class Redis
{
    private static $redisObj=array();

    /**
     * @param array $config
     * @return \Redis
     */
    public static function getRedis($config=array()){
        if(empty($config)){
            $config=GetConfigs::getRunConfigs()['redis'];
        }
        if(isset(self::$redisObj[$config['host'].':'.$config['port']])){
            return self::$redisObj[$config['host'].':'.$config['port']];
        }
        $redis=RedisInstance::initRedis($config);
        self::$redisObj[$config['host'].':'.$config['port']]=$redis->getRedisConn();
        return self::$redisObj[$config['host'].':'.$config['port']];
    }
}