<?php
namespace app\web\src\controller;

use core\src\control\Controller;
use core\src\util\LogUtils;

class IndexController extends Controller
{
    public function indexAction(){
//        print_r($this->getConfigValue('my_array'));
//        $this->_setLayOut('test');
//        $this->view('kkk');
//        $userDao=parent::dbDao('UsersDao');
        /*根据id查询数据*/
//        $res2=$userDao->selectId('a0acd183542b0d2ab2d52291171aef0b');
//        p($res2);
        return $this->result(array('time'=>date('Y-m-d H:i:')))->response();
    }
}
