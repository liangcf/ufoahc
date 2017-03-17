<?php
/**
 * @author 梁朝富 lcf@jionx.com
 * @function 控制器常用的方法
 */
namespace core\src\control;

use core\src\tool\Factory;
use core\run\ErrorHandle;
use core\run\GetConfigs;

abstract class Controller
{
	use TraitController;

	public $_layOut='layout';
	public $module='web';
//	public $_root=null;

	/**
	 * 获取application.config.php配置文件中的配置项
	 * @param $configKey
	 * @return null
	 */
	protected function getConfigValue($configKey){
		$config=GetConfigs::getAppConfigs();
		if(isset($config[$configKey])){
			return $config[$configKey];
		}else{
			return null;
		}
	}

	/**
	 * 获取db.config.php配置文件中的配置项
	 * @param $configKey
	 * @return null
	 */
	protected function getRunConfigValue($configKey){
		$config=GetConfigs::getRunConfigs();
		if(isset($config[$configKey])){
			return $config[$configKey];
		}else{
			return null;
		}
	}

	/**
	 * 获取get参数
	 * @param string $key
	 * @param null $default
	 * @return null|string
	 */
	protected function getParameter($key,$default=null){
		if(isset($_GET[$key])){
			return trim($_GET[$key]);
		}else{
			return $default;
		}
	}

	/**
	 * 获取post参数
	 * @param string $key
	 * @param null $default
	 * @return null|string
	 */
	protected function postParameter($key,$default=null){
		if(isset($_POST[$key])){
			return trim($_POST[$key]);
		}else{
			return $default;
		}
	}

	/**
	 * 判断是否是post请求
	 * @return bool
	 */
	protected function isPost() {
		if ($_SERVER['REQUEST_METHOD'] != "POST") {
			return false;
		}
		return true;
	}

	/**
	 * 设置session节点
	 * @param $key
	 * @param $value
	 */
	protected function setSessionValue($key, $value) {
		if(!isset($_SESSION)){
			session_start();
		}
		$_SESSION[$key] = $value;
	}

	/**
	 * 获取session节点下存储的值
	 * @param $key
	 * @param null $default
	 * @return null string
	 */
	protected function getSessionValue($key, $default=null) {
		if(!isset($_SESSION)){
			session_start();
		}
		return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
	}

	/**
	 * 删除某个session节点的值
	 * @param $key
	 */
	protected function unsetSession($key) {
		if(!isset($_SESSION)){
			session_start();
		}
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}

	/**
	 * 设置某个session节点的时间
	 * @param $key
	 * @param $value
	 * @param $expire
	 */
	protected function setValAndExpire($key, $value, $expire) {
		ini_set('session.gc_maxlifetime', $expire);
		session_set_cookie_params($expire);
		if(!isset($_SESSION)){
			session_start();
		}
		$_SESSION[$key] = $value;
	}
	/**
	 * 简单密码处理
	 * @param $pwd
	 * @return string
	 */
	protected function passwordProcessing($pwd){
		return strtolower(md5(md5(substr(md5(substr(md5($pwd),0,-3)),3))));
	}
	/**
	 * 获取当前时间
	 * @return bool|string
	 */
	protected function getTime(){
		return date('Y-m-d H:i:s');
	}
    /**
     * @param null $prefix
     * @return string
     */
	protected function uuid($prefix=null){
		return strtolower(md5(uniqid($prefix.md5(mt_rand()),true)));
	}

	/*抛出错误异常信息*/
	protected function errorInfo($info){
		throw new \Exception($info,404);
	}
	/*报错页面，含带错误提示*/
	protected function errorPage($errorInfo,$errorMsg=null){
		ErrorHandle::errorPage($errorInfo,$errorMsg);
	}
	/*重定向到错误页面*/
	protected function redirectError(){
		ErrorHandle::redirect();
	}

    protected function dbDao($className,$module=null){
		if(empty($module)){
			$module=$this->module;
		}
        return Factory::getDaoObj($className,$module);
    }
    protected function serviceObject($className,$module=null){
        if(empty($module)){
            $module=$this->module;
        }
        return Factory::getServiceObj($className,$module);
    }

    /**
     * 获取根目录
     * @return null
     */
//    protected function basePath(){
//        return $this->_root;
//    }
    /**
     * 利用对象的方式给layout设置页面 set
     * @param string $_layMode
     */
    protected function _setLayOut($_layMode='layout'){
        $this->_layOut=$_layMode;
    }
    /****************************************************************************************************************/
    /**
     * 调用请求的Action前需要执行的动作
     */
    public function beforeRequest(){
    }

    /**
     * 调用请求的Action后需要执行的动作
     */
    public function afterRequest(){
    }
    public function _getLayOut(){
        return $this->_layOut;
    }
    public function initModule($module){
        $this->module=$module;
    }
//    public function initPath($root){
//        $this->_root=$root;
//    }
    /****************************************************************************************************************/
}