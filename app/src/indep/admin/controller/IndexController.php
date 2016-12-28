<?php
namespace app\src\indep\admin\controller;

use core\rds\control\Controller;

class IndexController extends Controller
{
    /*默认这个控制器制定的layout*/
    public $_layOut='layout.admin';

    public function indexAction(){
        print_r($this->getConfigValue('my_array'));
//        $this->_setLayOut('layout.mobile');
        return $this->result(array('time'=>date('Y-m-d H:i:')))->response();
    }
}
