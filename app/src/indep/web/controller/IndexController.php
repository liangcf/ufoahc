<?php
namespace app\src\indep\web\controller;

use app\src\indep\web\service\IndexService;
use core\rds\control\Controller;
use core\rds\db\Redis;
use core\rds\util\EmailUtils;
use core\rds\util\LogUtils;
use core\rds\util\QRCodeUtils;
use core\rds\util\RedisUtils;

class IndexController extends Controller
{
    /*默认这个控制器制定的layout*/
    //public $_layOut='layout.pc'; //默认就是指向layout.pc

    public function indexAction(){
        try{
            $tTime=$_SERVER['REQUEST_TIME'];
            /*设置layout指向layout.mobile*/
//            $this->_setLayOut('layout.mobile');
            /*测试二维码生成工具*/
            $patch=$_SERVER['DOCUMENT_ROOT'];
            $res=QRCodeUtils::createQRCode($this->id(),'test 二维码',$patch.'/qrCode',false,$patch.'/img/logo_1.png');
            $qrCode=stristr($res,'/qrCode/');
//            $qrCode=null;
            /*获取配置文件方法*/
            $res1=$this->getConfigValue('my_array');
//            p($res1);
            /*实例化service*/
            $indexService=new IndexService();
            /*根据id查询数据*/
            $res2=$indexService->getById('a0acd183542b0d2ab2d52291171aef0b');
            $indexService->max();
//            p($res2);
            /*查看phone表所有数据*/
            $phone=$indexService->getPhoneAll();
            /*查询--第二个数据库的所有数据,使用的时候建议不要在同一个service上使用*/
            $res3=$indexService->tGetAll();
//            p($res3);
            /*
             * TODO :: 更多查询 MysqliInstance.php
             */

            /*测试日志工具*/
            LogUtils::log('liangchaofu','这是测试的内容','错误的内容--'.time());
            /*模糊查询方法*/
            $ret3=$indexService->like();
            /*邮件发送测试*/
            //$t=EmailUtils::sendEmail('ownziji@163.com','这里是密码','2271176865@qq.com','这是测试的邮件系统的','这是测试的内容，系统级别的');
            //p($t);

            /*测试redis的*/
//            $indexService->redis();
//            $indexService->redis2();
//            $redisConfig=$this->getRunConfigValue('redis');
//            $redis=RedisUtils::getRedis($redisConfig);//此方法需要自己关闭redis
//            p($redis->get('ufoahc_test'));
//            RedisUtils::closeRedis();
            $indexService->count();
            $indexService->min();
            $indexService->max();
            $indexService->avg();
            $indexService->sum();
            $dbRunTime='访问数据库的时间：'.(microtime(true) - $tTime);

            /*
             *TODO :: 返回的方式 两种
             */
            /*第一种*/
//            $this->result(array('date_test'=>date('Y-m-d H:i:s'),'my_result'=>$res2,'ret'=>$ret3,'db_time'=>$dbRunTime));
//            return $this->response();
            /*第二种*/
            return $this->result(array('date_test'=>date('Y-m-d H:i:s'),'my_result'=>$res2,'ret'=>$ret3,'db_time'=>$dbRunTime,'phone'=>$phone,'qr_code'=>$qrCode))->response();
        }catch (\Exception $e){
            echo $e->getMessage();
            die;
        }
    }

    /*接口方式*/
    public function apiAction(){
        $this->api();
        if(!$this->isPost()){
            return $this->msg(-1,'不是post请求')->response();
        }
        $indexService=new IndexService();
        $res2=$indexService->getById('a0acd183542b0d2ab2d52291171aef0b');
        return $this->msg(0,$res2)->response();
    }
}
