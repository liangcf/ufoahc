<?php
namespace app\example\src\controller;

use core\src\utils\EmailUtils;
use core\src\control\Controller;
use core\src\utils\LogUtils;
use core\src\utils\QRCodeUtils;

class IndexController extends Controller
{
    public function indexAction(){
//        $this->errorPage('网络错误！请重试','网络错误');
        try{
            /*设置layout指向layout.mobile*/
//            $this->_setLayOut('test');
//            $this->view('kkk');
            $tTime=$_SERVER['REQUEST_TIME'];
            /*测试二维码生成工具*/
            $patch=$_SERVER['DOCUMENT_ROOT'];
//            $res=QRCodeUtils::createQRCode($this->uuid(),'http://weixin.qq.com/r/HOIIEFjERwU4rRxz97cO',$patch.'/qrCode',false,$patch.'/img/wx_logo.jpg');
//            $res=QRCodeUtils::createQRCode($this->uuid(),'http://qm.qq.com/cgi-bin/qm/qr?k=RNJWNqoys5CLhvmf9ECM12_YnjCRVn3Y',$patch.'/qrCode',false,$patch.'/img/qq_logo.jpg');
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
//            LogUtils::log('liangchaofu','这是测试的内容','错误的内容--'.time());
            /*模糊查询方法*/
            $ret3=$userDao->like('name','郁',array(),array('sort_order'=>'desc'),1,2,array('name','content','sort_order'));
            /*邮件发送测试*/
//            $t=EmailUtils::sendEmail('ownziji@163.com','这里是密码','2271176865@qq.com','这是测试的邮件系统的','这是测试的内容，系统级别的');
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
}
