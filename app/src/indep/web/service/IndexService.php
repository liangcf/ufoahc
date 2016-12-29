<?php
namespace app\src\indep\web\service;

use core\rds\service\Service;

class IndexService extends Service
{
    /*根据id方式*/
    public function getById($id){
        $userDao=$this->dbService('UsersDao');
        return $userDao->selectId($id);
    }
    /*查询phone 所有数据*/
    public function getPhoneAll(){
        $phoneDao=$this->dbService('PhoneDao');
        return $phoneDao->selectAll();
    }
    /*like 方法测试*/
    public function like(){
        $userDao=$this->dbService('UsersDao');
        return $userDao->like('name','郁',array(),array('sort_order'=>'desc'),1,2,array('name','content','sort_order'));
    }
    /*数量*/
    public function count(){
        $userDao=$this->dbService('UsersDao');
        return $userDao->count();
    }
    public function max(){
        $userDao=$this->dbService('UsersDao');
        return $userDao->max('sort_order');
    }
    public function min(){
        $userDao=$this->dbService('UsersDao');
        return $userDao->min('sort_order');
    }
    public function avg(){
        $userDao=$this->dbService('UsersDao');
        return $userDao->avg('sort_order');
    }
    public function sum(){
        $userDao=$this->dbService('UsersDao');
        return $userDao->sum('sort_order');
    }

    /*第二库的链接*/
    public function tGetAll(){
        $stuDao=$this->dbService('StuDao');
        return $stuDao->selectAll();
    }
}
