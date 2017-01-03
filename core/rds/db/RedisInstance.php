<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2017/1/3
 * Time: 16:40
 */

namespace core\rds\db;


class RedisInstance
{
    private static $instance=null;
    private static $connect=null;
    private $redis=null;

    /**
     * RedisUtils constructor.
     * @param $config
     * @throws \Exception
     */
    private function __construct($config){
        if(empty($config)){
            throw new \Exception('$config null');
        }
        try{
            $this->redis=new \Redis();
            $dbIndex=isset($redis_info['db_index'])?$redis_info['db_index']:'0';
            self::$connect=$this->redis->connect($config['host'],$config['port']);
            $this->redis->select($dbIndex); //数据库选择
        }catch (\Exception $e){
            throw new \Exception('create redis connection Fail:'.$e->getMessage());
        }
    }

    /**
     * @param $config
     * @return RedisInstance|null
     */
    public static function initRedis($config){
        if(self::$instance&&self::$connect){
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
            self::$connect=null;
            $this->redis->close();
        }
    }
}