<?php
namespace app\src\indep\web\service;

use app\src\toge\dao\StuDao;
use app\src\toge\dao\UsersDao;
use core\rds\tool\Factory;

class UsersService
{
    //根据id方式
    public function getById($id){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->selectId($id);
    }
    //查询所有
    public function getAll(){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->selectAll();
    }
    /*like 方法测试*/
    public function like(){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->like('name','郁',array(),array('sort_order'=>'desc'),1,2,array('name','content','sort_order'));
    }
    /*数量*/
    public function count(){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->count();
    }
    public function max(){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->max('sort_order');
    }
    public function min(){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->min('sort_order');
    }
    public function avg(){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->avg('sort_order');
    }
    public function sum(){
        /** @var $userDao \app\src\toge\dao\UsersDao*/
        $userDao=Factory::getDaoModel('UsersDao');
        return $userDao->sum('sort_order');
    }

    public function tGetAll(){
        /** @var $stuDao \app\src\toge\dao\StuDao*/
        $stuDao=Factory::getDaoModel('StuDao');
        return $stuDao->selectAll();
    }
}
