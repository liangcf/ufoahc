<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/11/15
 * Time: 11:04
 */
namespace core\run;

class MainOperation{
	
    protected $operation = array();

    public function factoryMethod($className,$method){
        try {
            if(!isset($this->operation[$className])){
                $this->operation[$className]=new $className($this);
            }
            $whole['before']=$this->operation[$className]->beforeRequest();
            if(!method_exists($this->operation[$className],$method)){
                throw new \Exception($method.'-- is not found',500);
            }
            $whole['data']=$this->operation[$className]->$method();
            $whole['after']=$this->operation[$className]->afterRequest();
            $whole['layout']=$this->operation[$className]->_getLayOut();
            return $whole;
        } catch (\Exception $e) {
            throw new \Exception($className.'-- is not found',500);
        }
    }
}