<?php
/**
 * @author 梁朝富
 * @mail lcf@jionx.com
 * @function 入口
 */
namespace core\run;

class Application
{
    private $runConfig;
    private $dev;
    private static $config;
    public static function init(){
        self::$config=GetConfigs::getRunConfigs();
        return new self();
    }
    /**
     * 入口
     * @throws \Exception
     */
    public function run(){
        $this->initHeader();
        $runTime=$_SERVER['REQUEST_TIME'];
//        self::$config=GetConfigs::getRunConfigs();
        $this->dev=isset(self::$config['mode'])?self::$config['mode']:false;
        $this->handleException();
        $action=$this->route();
        $this->action($action);
        if($this->dev===true){
            echo '<input type="hidden" value="'.(microtime(true)-$runTime).'">';
        }
    }

    /*拼装路由*/
    private function route(){
        $_reqUri=$_SERVER['REQUEST_URI'];
        $_index=strpos($_reqUri,'?');
        $_uri=$_index>0?substr($_reqUri,0,$_index):$_reqUri;
        if(stripos($_uri,'index.php')){
            throw new \Exception('访问出错！', 404);
        }
        $action=self::$config['route'];
        if($_uri=='/'){
            //$action=array('_module'=>'web','_controller'=>'index','_action'=>'index');
            return $action;
        }
        $pathArr=explode('/',trim($_uri,'/'));
        if(isset($pathArr[0])){
            $_module=$pathArr[0];
        }else{
            $_module=$action['_module'];
        }
        if(isset($pathArr[1])){
            $controller=$pathArr[1];
        }else{
            $controller=$action['_controller'];
        }
        if(isset($pathArr[2])){
            $_action=$pathArr[2];
        }else{
            $_action=$action['_action'];
        }
        $action=array('_module'=>$_module,'_controller'=>$controller,'_action'=>$_action);
        return $action;
    }

    /*转到view*/
    private function action($action){
        (new View())->view($this->actioning($action));
    }
    /*实例化控制器返回数据*/
    private function actioning($action){
        $_module=$action['_module'];
        $_controller=$action['_controller'];
        $_action=$action['_action'];
        $_url='/app/'.$_module.'/view/'.$_module.'/'.$_controller.'/'.$_action;
        /* 组装类路径 */
        $_className='app\\'.strtolower($_module).'\\src\\controller\\'.ucfirst($_controller).'Controller';
        $_funName=$_action.'Action';
        if(!class_exists($_className)){
            throw new \Exception("Controller in not found",404);
        }
        $data=MainRun::runMethod($_className,$_funName,strtolower($_module));
        if(empty($data)){
            throw new \Exception("not return data",404);
        }
        $wholes['layout']='/app/'.$_module.'/view/layout/'.$data['layout'];
        /* 寻找视图文件的路径 */
        $wholes['view_dir']=$_url;
        $wholes['view_diy']='/app/'.$_module.'/view/'.$_module.'/'.$_controller.'/';;

        $whole['before']=$data['before'];
        $whole['data']=$data['data'];
        $whole['after']=$data['after'];
        return array('whole'=>$whole,'wholes'=>$wholes);
    }

    private function initHeader(){
        header('Content-Type: text/html; charset=UTF-8');
    }
    /**
     * 异常处理参考
     * @url:https://github.com/zhangbaitong/plume
     * -------------- 异常处理函数 ----------------
     **/

    //非开发环境全局处理error(warning)，exception,shutdown
    private function handleException(){
        if($this->dev!==true){
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            set_error_handler(array($this,'error_function'));
            set_exception_handler(array($this,'exception_function'));
            register_shutdown_function(array($this,'shutdown_function'));
        }
    }

    //1=>'ERROR', 2=>'WARNING', 4=>'PARSE', 8=>'NOTICE'
    public function error_function($errno, $errstr, $errfile, $errline, $errcontext){
        /*log*/
        self::log('error_function','error_function',array('errno' => $errno,'errstr' => $errstr, 'errfile' => $errfile, 'errline' => $errline, 'errcontext' => $errcontext));
        ErrorHandle::error404();
    }

    /**
     * @param $e \Exception
     */
    public function exception_function($e){
        /*log*/
        self::log('exception_function','exception_function',$e->getMessage());
        if($e->getCode()==404){
            ErrorHandle::error404();
        }else{
            ErrorHandle::error500();
        }
        exit;
    }

    public function shutdown_function(){
        $error = error_get_last();
        if(!empty($error)){
            self::log('shutdown_function','shutdown_function',$error);
        }
        exit;
    }

    private static function log($file,$message,$context,$dir=null){
        if($dir){
            $dirs=rtrim($dir,'/');
        }else{
            $dirs=__DIR__.'/../../data/logs';
        }
        $dir=$dirs.'/error_exception/';
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        if(!is_string($context)){
            $context=json_encode($context);
        }
        $fileName=$dir.date('Ymd').$file.'.log';
        $date=date('Y-m-d H:i:s');
        $log='['.$date.'] - '.$message.' - '.$context."\r\n\r\n";
        return file_put_contents($fileName, $log,FILE_APPEND);
    }
}