<?php
namespace app\src\indep\web\controller;

use app\src\indep\web\service\UsersService;
use core\rds\control\Controller;
use core\rds\util\EmailUtils;
use core\rds\util\LogUtils;
use core\rds\util\QRCodeUtils;
use core\rds\util\UuidUtils;

class IndexController extends Controller
{
    /*默认这个控制器制定的layout*/
    //public $_layOut='layout.pc'; //默认就是指向layout.pc

    public function indexAction(){
        $tTime=$_SERVER['REQUEST_TIME'];
        /*设置layout指向layout.mobile*/
//        $this->_setLayOut('layout.mobile');
        /*测试二维码生成工具*/
        /*$patch=$_SERVER['DOCUMENT_ROOT'];
        $res=QRCodeUtils::createQRCode(UuidUtils::uuid(),'test 二维码',$patch.'/test',false,$patch.'/img/logo_1.png');
        $res=stristr($res,'/test/');
        p($res);
        echo '<img src="'.$res.'">';*/
        /*获取配置文件方法*/
        $res1=$this->getConfigValue('my_array');
//        p($res1);
        /*实例化service*/
        $usersService=new UsersService();
        /*根据id查询数据*/
        $res2=$usersService->getById('a0acd183542b0d2ab2d52291171aef0b');
//        p($res2);
        /*查询--第二个数据库的所有数据*/
//        $res3=$usersService->tGetAll();
//        p($res3);
        /*
         * TODO :: 更多查询 Mysqli.php
         */

        /*测试日志工具*/
//        LogUtils::log('liangchaofu','这是测试的内容','错误的内容');
        /*模糊查询方法*/
//        $ret3=$usersService->like();
        $usersService->count();
        $ret3=array();//die;

        /*邮件发送测试*/
        //$t=EmailUtils::sendEmail('ownziji@163.com','这里是密码','2271176865@qq.com','这是测试的邮件系统的','这是测试的内容，系统级别的');
        //p($t);
//        p($usersService->count());
//        p($usersService->min());
//        p($usersService->max());
//        p($usersService->avg());
//        p($usersService->sum());

        $dbRunTime='访问数据库的时间：'.(microtime(true) - $tTime);

        /*
         *TODO :: 返回的方式 两种
         */
        /*第一种*/
//        $this->result(array('date_test'=>date('Y-m-d H:i:s'),'my_result'=>$res2,'ret'=>$ret3,'db_time'=>$dbRunTime));
//        return $this->response();
        /*第二种*/
        return $this->result(array('date_test'=>date('Y-m-d H:i:s'),'my_result'=>$res2,'ret'=>$ret3,'db_time'=>$dbRunTime))->response();
    }

    /*接口方式*/
    public function apiAction(){
        $this->api();
        if(!$this->isPost()){
            return $this->msg(-1,'不是post请求')->response();
        }
        $usersService=new UsersService();
        $res2=$usersService->getById('a0acd183542b0d2ab2d52291171aef0b');
        return $this->msg(0,$res2)->response();
    }
}
