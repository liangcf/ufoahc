<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 入口
 */
namespace core\run;

class Application
{
    private $runConfig;
    /**
     * 入口
     * @throws \Exception
     */
    public function run(){
        $this->runConfig=GetConfigs::getRunConfigs();
        $this->initHeader();
        $mode=isset($this->runConfig['mode'])?$this->runConfig['mode']:'pro';
        if($mode!=='dev'){
            $this->handleException();
        }else{
            $runTime=$_SERVER['REQUEST_TIME'];
        }
        $cache=isset($this->runConfig['cache_flag'])?$this->runConfig['cache_flag']:false;
        $action=$this->route();
        if($cache===true){
            $this->cacheAction($action);
        }else{
            $this->action($action);
        }
        if($mode==='dev'){
            echo ' run-time : '.(microtime(true)-$runTime);
        }
    }

    /*拼装路由*/
    public function route(){
        $_reqUri=$_SERVER['REQUEST_URI'];
        $_index=strpos($_reqUri,'?');
        $_uri=$_index>0?substr($_reqUri,0,$_index):$_reqUri;
        if(stripos($_uri,'index.php')){
            throw new \Exception('访问出错！', 404);
        }
        if($_uri=='/'){
            $action=array('_module'=>'web','_controller'=>'index','_action'=>'index');
            return $action;
        }
        $pathArr=explode('/',trim($_uri,'/'));
        if(isset($pathArr[0])){
            $_module=$pathArr[0];
        }else{
            $_module='web';
        }
        if(isset($pathArr[1])){
            $controller=$pathArr[1];
        }else{
            $controller='index';
        }
        if(isset($pathArr[2])){
            $_action=$pathArr[2];
        }else{
            $_action='index';
        }
        $action=array('_module'=>$_module,'_controller'=>$controller,'_action'=>$_action);
        return $action;
    }
    /*判断是否缓存的函数*/
    public function cacheAction($action){

        $_module=$action['_module'];
        $_controller=$action['_controller'];
        $_action=$action['_action'];
        $_url='/'.$_module.'/'.$_controller.'/'.$_action;
        $_url=strtolower($_url);
        $cacheTime=isset($this->runConfig['cache_time'])?$this->runConfig['cache_time']:0;
        $cacheFile = __DIR__ . '/../../var/cache' . $_url.'.html';
        if (is_file($cacheFile)&&filemtime($cacheFile) + $cacheTime >= time()) {
            require $cacheFile;
        }else{
            @unlink($cacheFile);
            $this->cache($action);
        }
    }
    /*有缓存*/
    public function cache($action){
        $view=new View();
        $view->cacheView($this->actioning($action));
    }
    /*无缓存*/
    public function action($action){
        $view=new View();
        $view->view($this->actioning($action));
    }
    /*实例化控制器返回数据*/
    private function actioning($action){
        $_module=$action['_module'];
        $_controller=$action['_controller'];
        $_action=$action['_action'];
        $_url='/'.$_module.'/'.$_controller.'/'.$_action;
        /* 组装类路径 */
        $_className='app\\src\\indep\\'.strtolower($_module).'\\controller\\'.ucfirst($_controller).'Controller';
        $_funName=$_action.'Action';
        if(!class_exists($_className)){
            throw new \Exception("Controller in not found",404);
        }
        $data=MainOperation::mainMethod($_className,$_funName);
        if(empty($data)){
            throw new \Exception("not return data",404);
        }
        $wholes['layout']=$data['layout'];
        /* 寻找视图文件的路径 */
        $wholes['view_dir']=$_url;

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
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        set_error_handler(array($this,'error_function'));
        set_exception_handler(array($this,'exception_function'));
        register_shutdown_function(array($this,'shutdown_function'));
    }

    //1=>'ERROR', 2=>'WARNING', 4=>'PARSE', 8=>'NOTICE'
    public function error_function($errno, $errstr, $errfile, $errline, $errcontext){
        /*log*/
        self::log('error_function','error_function',array('errno' => $errno,'errstr' => $errstr, 'errfile' => $errfile, 'errline' => $errline, 'errcontext' => $errcontext),__DIR__.'/../../data/logs');
        require __DIR__ . '/../../var/error-page/404.html';
        exit;
    }

    /**
     * @param $e \Exception
     */
    public function exception_function($e){
        /*log*/
        self::log('exception_function','exception_function',$e->getMessage(),__DIR__.'/../../data/logs');
        switch ($e->getCode()){
            case 404:
                require __DIR__ . '/../../var/error-page/404.html';
                break;
            default:
                require __DIR__ . '/../../var/error-page/500.phtml';
        }
        exit;
    }

    public function shutdown_function(){
        $error = error_get_last();
        if(!empty($error)){
            self::log('shutdown_function','shutdown_function',$error,__DIR__.'/../../data/logs');
        }
        exit;
    }

    public static function log($file,$message,$context,$dir){
        $dir=rtrim($dir,'/');
        $dir=$dir.'/error_exception/';
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