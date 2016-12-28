<?php
namespace app\src\indep\mobile\controller;

use core\rds\control\Controller;

class IndexController extends Controller
{
    /*默认这个控制器制定的layout*/
    public $_layOut='layout.mobile';

    public function indexAction(){

        return $this->result(array('time'=>date('Y-m-d H:i:')))->response();
    }
}
