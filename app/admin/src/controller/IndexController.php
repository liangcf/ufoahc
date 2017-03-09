<?php
namespace app\admin\src\controller;

use core\src\control\Controller;

class IndexController extends Controller
{
    public function indexAction(){
        $userDao=parent::dbDao('UsersDao');
        /*根据id查询数据*/
        $res2=$userDao->selectId('a0acd183542b0d2ab2d52291171aef0b');
        p($res2);
        return $this->result(array('time'=>date('Y-m-d H:i:')))->response();
    }
}
