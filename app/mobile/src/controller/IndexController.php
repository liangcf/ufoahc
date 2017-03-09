<?php
namespace app\mobile\src\controller;

use core\src\control\Controller;
use core\src\util\LogUtils;

class IndexController extends Controller
{
    public function indexAction(){
        try{
            $userDao=parent::dbDao('UsersDao');
            /*根据id查询数据*/
            $res2=$userDao->selectId('a0acd183542b0d2ab2d52291171aef0b');
            p($res2);
            return $this->result()->response();
        }catch (\Exception $e){
            LogUtils::log('test','异常',$e->getMessage());
            echo '网络错误！重试！';
            exit();
        }
    }
}
