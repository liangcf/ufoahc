<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 输出文件
 */
namespace core\run;

class View
{
    /*返回页面的数据*/
    public $data;
    /*返回页面的全局变量*/
    public $overall;

    /*视图*/
    public function view($whole){
        $this->data=$data=$whole['whole']['data']['data'];
        if(isset($whole['whole']['data']['api'])&&$whole['whole']['data']['api']===true){
            $this->renderAPI($data);
        }
        $transfer['before']=$whole['whole']['before'];
        $transfer['data']=$whole['whole']['data']['data'];
        $transfer['after']=$whole['whole']['after'];
        $this->overall=$overall=$transfer;
        if($whole['whole']['data']['view']!==null){
            $_url='/app/view/indep'.$whole['whole']['data']['view'];
        }else{
            $_url='/app/view/indep'.$whole['wholes']['view_dir'];
        }
        $_layMode=$whole['wholes']['layout'];
        $_tmpDir=__DIR__.'/../..';
        $_content=$_tmpDir.strtolower($_url).'.phtml';
        $_layUrl='/app/view/layout/'.$_layMode.'.phtml';
        $_layOutFile=$_tmpDir.strtolower($_layUrl);
        if(is_file($_content)&&is_file($_layOutFile)){
            require $_layOutFile;
        }else{
            throw new \Exception('View is not found:'.$_content,404);
        }
    }
    /*加载css方法*/
    public function appendCss($var){
        echo '<link type="text/css" rel="stylesheet" href="'.$var.'"/>';
    }
    /*加载js的方法*/
    public function appendJs($var){
        echo '<script type="text/javascript" src="'.$var.'"></script>';
    }
    /*年月日转换*/
    public function getYMD($time){
        if(empty($time)){
            return date("Y-m-d",time());
        }else{
            return date("Y-m-d",strtotime($time));
        }
    }
    /*输出函数*/
    public function _echo($string,$default=null){
        if(empty($string)){
            echo $default;
        }else{
            echo $string;
        }
    }
    /*判断是否存在的值*/
    public function getData($key,$default=null){
        if(empty($key)){
            return $default;
        }
        return isset($this->data[$key])?$this->data[$key]:$default;
    }
    /*获取全局变量的值*/
    public function getAllData($default=null){
        return isset($this->overall)?$this->overall:$default;
    }

    private function apiHeader(){
        header('Content-Type: application/json; charset=UTF-8');
    }
    private function renderAPI($actionResult){
        $this->apiHeader();
        print_r($actionResult);
        exit;
    }
}