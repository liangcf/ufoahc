<?php

/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/4/20
 * Time: 10:14
 * 该方法没测试过
 * @version 1.0.1
 * @function 不参数化查询，拼装sql语句直接查询
 * @link //link http://www.php.net/manual/en/mysqli-result.fetch-array.php
 */
namespace core\rds\db;
abstract class QMysqli
{
    /**
     * @var QMysqliInstance
     */
    private $connect=null;

    /**
     * 获取表名
     * @return mixed
     */
    abstract protected function _getTableName();

    /**
     * 默认id
     * @return mixed
     */
    abstract protected function _getDefaultId();

    /**
     * 初始化数据库连接
     * @param array $config
     * @throws \Exception
     */
    public function setConnectInit($config){
        if(!$this->connect){
            $this->connect=QMysqliInstance::getInstance($config);
        }
    }
    public function insert($data){
        return $this->connect->insert($this->_getTableName(),$data);
    }

    public function updateId($id,$data){
        return $this->connect->updateId($this->_getTableName(),$this->_getDefaultId(),$id,$data);
    }

    public function deleteId($id){
        return $this->connect->deleteId($this->_getTableName(),$this->_getDefaultId(),$id);
    }

    public function selectId($id,$getInfo=array('*')){
        return $this->connect->selectId($this->_getTableName(),$this->_getDefaultId(),$id,$getInfo);
    }

    public function update($data,$where){
        return $this->connect->update($this->_getTableName(),$data,$where);
    }

    public function delete($where){
        return $this->connect->delete($this->_getTableName(),$where);
    }

    public function select($where,$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->select($this->_getTableName(),$where,$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function selectAll($order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->selectAll($this->_getTableName(),$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function selects($where=array(),$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->selects($this->_getTableName(),$where,$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function query($sql){
        return $this->connect->query($sql);
    }

    public function selectNotEqual($whereString,$getInfo=array('*')){
        return $this->connect->selectNotEqual($this->_getTableName(),$whereString,$getInfo);
    }

    public function like($stringName,$content,$where=array(),$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->like($this->_getTableName(),$stringName,$content,$where,$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function count($where=array(),$columnName='*',$orWhere=array()){
        return $this->connect->count($this->_getTableName(),$where,$columnName,$orWhere);
    }

    public function min($columnName,$where=array(),$orWhere=array()){
        return $this->connect->min($this->_getTableName(),$where,$columnName,$orWhere);
    }

    public function max($columnName,$where=array(),$orWhere=array()){
        return $this->connect->max($this->_getTableName(),$where,$columnName,$orWhere);
    }

    public function avg($columnName,$where=array(),$orWhere=array()){
        return $this->connect->avg($this->_getTableName(),$where,$columnName,$orWhere);
    }

    public function sum($columnName,$where=array(),$orWhere=array()){
        return $this->connect->sum($this->_getTableName(),$where,$columnName,$orWhere);
    }

    public function beginTransaction(){
        return $this->connect->beginTransaction();
    }

    public function commitTransaction(){
        return $this->connect->commitTransaction();
    }

    public function rollbackTransaction(){
        return $this->connect->rollbackTransaction();
    }
}