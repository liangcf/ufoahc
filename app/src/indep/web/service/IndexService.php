<?php
namespace app\src\indep\web\service;

use core\rds\db\Redis;
use core\rds\service\Service;
use core\run\GetConfigs;

class IndexService extends Service
{
    /*根据id方式*/
    public function getById($id){
        $userDao=parent::dbService('UsersDao');
        return $userDao->selectId($id);
    }
    /*查询phone 所有数据*/
    public function getPhoneAll(){
        $phoneDao=parent::dbService('PhoneDao');
        return $phoneDao->selectAll();
    }
    /*like 方法测试*/
    public function like(){
        $userDao=parent::dbService('UsersDao');
        return $userDao->like('name','郁',array(),array('sort_order'=>'desc'),1,2,array('name','content','sort_order'));
    }
    /*数量*/
    public function count(){
        $userDao=parent::dbService('UsersDao');
        return $userDao->count();
    }
    public function max(){
        $userDao=parent::dbService('UsersDao');
        return $userDao->max('sort_order');
    }
    public function min(){
        $userDao=parent::dbService('UsersDao');
        return $userDao->min('sort_order');
    }
    public function avg(){
        $userDao=parent::dbService('UsersDao');
        return $userDao->avg('sort_order');
    }
    public function sum(){
        $userDao=parent::dbService('UsersDao');
        return $userDao->sum('sort_order');
    }

    /*第二库的链接*/
    public function tGetAll(){
        $stuDao=parent::dbService('StuDao');
        return $stuDao->selectAll();
    }
    /*redis-test*/
    public function redis(){
        $redisConfig=GetConfigs::getRunConfigs()['redis'];
        $redis=Redis::getRedis($redisConfig);
        $redis->set('ufoahc_test','liangchaofu');
        p($redis->get('ufoahc_test'));
        $redis2=Redis::getRedis($redisConfig);
        p($redis2->get('ufoahc_test'));
    }
    public function redis2(){
        $redisConfig=GetConfigs::getRunConfigs()['redis'];
        $redis=Redis::getRedis($redisConfig);
        p($redis->get('ufoahc_test'));
        $redis2=Redis::getRedis($redisConfig);
        p($redis2->get('ufoahc_test'));
    }
}
