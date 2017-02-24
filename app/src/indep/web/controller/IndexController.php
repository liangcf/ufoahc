<?php
namespace app\src\indep\web\controller;

use app\src\indep\web\service\IndexService; //如果举得函数太多，可以写到这里面去
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
//        $this->errorPage('网络错误！请重试','网络错误');
        try{
            $tTime=$_SERVER['REQUEST_TIME'];
            /*设置layout指向layout.mobile*/
//            $this->_setLayOut('layout.mobile');
            /*测试二维码生成工具*/
//            $patch=$_SERVER['DOCUMENT_ROOT'];
//            $res=QRCodeUtils::createQRCode($this->uuid(),'http://weixin.qq.com/r/fTvfx0vE-xaArQ_k925v',$patch.'/qrCode',false,$patch.'/img/jxz_logo.jpg');
//            $res=QRCodeUtils::createQRCode($this->uuid(),'http://qm.qq.com/cgi-bin/qm/qr?k=sPrcl9UjzVfT1wMB68WTOQmI9bwzOjmx',$patch.'/qrCode',false,$patch.'/img/qq_logo.jpg');
//            $qrCode=stristr($res,'/qrCode/');
            $qrCode=null;
            /*获取配置文件方法*/
            $res1=$this->getConfigValue('my_array');
//            p($res1);die;
            $userDao=parent::dbDao('UsersDao');
            /*根据id查询数据*/
            $res2=$userDao->selectId('a0acd183542b0d2ab2d52291171aef0b');
            /*查看phone表所有数据*/
            $phoneDao=parent::dbDao('PhoneDao');
            $phone=$phoneDao->selectAll();
//            $phone=array();
            /*查询--第二个数据库的所有数据,使用的时候建议不要在同一个service上使用*/
            $stuDao=parent::dbDao('StuDao');

            $res3=$stuDao->selectAll();
//            p(parent::uuid());die;
//            p($res3);
            /*
             * TODO :: 更多查询 MysqliInstance.php
             */

            /*测试日志工具*/
            //LogUtils::log('liangchaofu','这是测试的内容','错误的内容--'.time());
            /*模糊查询方法*/
            $ret3=$userDao->like('name','郁',array(),array('sort_order'=>'desc'),1,2,array('name','content','sort_order'));
            /*邮件发送测试*/
            //$t=EmailUtils::sendEmail('ownziji@163.com','这里是密码','2271176865@qq.com','这是测试的邮件系统的','这是测试的内容，系统级别的');
            //p($t);
            //p($t);

            /*测试redis的*/
//            $redis=RedisUtils::getRedis($redisConfig);//此方法需要自己关闭redis
//            p($redis->get('ufoahc_test'));
//            RedisUtils::closeRedis();
//            $redis=Redis::getRedis();
//            p($redis->get('ufoahc_test'));
//            $redis2=Redis::getRedis();
//            p($redis2->get('ufoahc_test'));
            $userDao->count();
            $userDao->min('sort_order');
            $userDao->max('sort_order');
            $userDao->avg('sort_order');
            $userDao->sum('sort_order');
            $dbRunTime='访问数据库的时间：'.(microtime(true) - $tTime);

            return $this->result(array('date_test'=>date('Y-m-d H:i:s'),'my_result'=>$res2,'ret'=>$ret3,'db_time'=>$dbRunTime,'phone'=>$phone,'qr_code'=>$qrCode))->response();
        }catch (\Exception $e){
            LogUtils::log('test','异常',$e->getMessage());
            echo '网络错误！重试！';
            exit();
        }
    }

    /*接口方式*/
    public function apiAction(){
//        $redis=Redis::getRedis();
//        $redis->set('ufoahc_test','liangchaofu111');
//        p($redis->get('ufoahc_test'));
//        $redis2=Redis::getRedis();
//        p($redis2->get('ufoahc_test'));
//        die;
        $this->api();
        if(!$this->isPost()){
            return $this->msg(-1,'不是post请求')->response();
        }
        try{
            $userDao=parent::dbDao('UsersDao');
            /*根据id查询数据*/
            $res2=$userDao->selectId('a0acd183542b0d2ab2d52291171aef0b');
            return $this->msg(0,$res2)->response();
        }catch (\Exception $e){
            return $this->msg(-100,'异常'.$e->getMessage())->response();
        }
    }
}
