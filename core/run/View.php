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
        $this->data=$whole['whole']['data']['data'];
        if(isset($whole['whole']['data']['api'])&&$whole['whole']['data']['api']===true){
            $this->renderAPI($this->data);
        }
        $transfer['before']=$whole['whole']['before'];
        $transfer['data']=$whole['whole']['data']['data'];
        $transfer['after']=$whole['whole']['after'];
        $this->overall=$transfer;
        if($whole['whole']['data']['view']!==null){
            $_url=$whole['wholes']['view_diy'].$whole['whole']['data']['view'];
        }else{
            $_url=$whole['wholes']['view_dir'];
        }
        $tmpDir=__DIR__.'/../..';
        $content=$tmpDir.strtolower($_url).'.phtml';
        $layUrl=$whole['wholes']['layout'].'.phtml';
        $layOutFile=$tmpDir.strtolower($layUrl);
        if(is_file($content)&&is_file($layOutFile)){
            $this->views($layOutFile,$content);
        }else{
            throw new \Exception('View is not found:'.$content,404);
        }
    }
    private function views($_layOutFile,$_content){
        $data=$this->data;
        $overall=$this->overall;
        require $_layOutFile;
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