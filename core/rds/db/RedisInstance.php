<?php
/**
 * @author 梁朝富 lcf@jionx.com
 */

namespace core\rds\db;


class RedisInstance
{
    private static $instance=null;
    private static $redisObj=array();
    private $redis=null;

    /**
     * RedisUtils constructor.
     * @param $config
     * @throws \Exception
     */
    private function __construct($config){
        if(empty($config)){
            throw new \Exception('redis config null');
        }
        try{
            $this->redis=new \Redis();
            $dbIndex=isset($redis_info['db_index'])?$redis_info['db_index']:'0';
            self::$redisObj[$config['host'].':'.$config['port']]=$this->redis->connect($config['host'],$config['port']);
            $this->redis->select($dbIndex); //数据库选择
        }catch (\Exception $e){
            throw new \Exception('create redis connection Fail:'.$e->getMessage());
        }
    }

    private function __clone(){}

    /**
     * @param $config
     * @return RedisInstance|null
     */
    public static function initRedis($config){
        if(self::$instance&&isset(self::$redisObj[$config['host'].':'.$config['port']])){
            return self::$instance;
        }
        self::$instance=new self($config);
        return self::$instance;
    }

    /**
     * 获取redis链接，好调用析构函数关闭该链接
     * @return null|\Redis
     */
    public function getRedisConn(){
        return $this->redis;
    }

    function __destruct(){
        if(!empty($this->redis)){
            self::$instance=null;
            self::$redisObj=array();
            $this->redis->close();
        }
    }
}