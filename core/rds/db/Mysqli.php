<?php
/**
 * @author 梁朝富 lcf@jionx.com
 */


namespace core\rds\db;


abstract class Mysqli implements MysqliInterface
{
    /**
     * 表名
     * @var
     */
    protected $tableName;
    /**
     * 默认id
     * @var
     */
    protected $tableId;
    /**
     * @var MysqliInstance;
     */
    private $connect=null;
    /**
     * 初始化数据库连接
     * @param array $config
     * @throws \Exception
     */
    public function initConnect($config){
        if(!$this->connect){
            $this->connect=MysqliInstance::getInstance($config);
        }
    }

    public function insert($data){
        return $this->connect->insert($this->tableName,$data);
    }

    public function updateId($id,$data){
        return $this->connect->updateId($this->tableName,$this->tableId,$id,$data);
    }

    public function deleteId($id){
        return $this->connect->deleteId($this->tableName,$this->tableId,$id);
    }

    public function selectId($id,$getInfo=array('*')){
        return $this->connect->selectId($this->tableName,$this->tableId,$id,$getInfo);
    }

    public function update($data,$where){
        return $this->connect->update($this->tableName,$data,$where);
    }

    public function delete($where){
        return $this->connect->delete($this->tableName,$where);
    }

    public function select($where,$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->select($this->tableName,$where,$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function selectAll($order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->selectAll($this->tableName,$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function selects($where=array(),$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->selects($this->tableName,$where,$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function query($sql,$param=array()){
        return $this->connect->query($sql,$param);
    }

    public function selectNotEqual($whereString,$getInfo=array('*')){
        return $this->connect->selectNotEqual($this->tableName,$whereString,$getInfo);
    }

    public function like($stringName,$content,$where=array(),$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array()){
        return $this->connect->like($this->tableName,$stringName,$content,$where,$order,$offset,$fetchNum,$getInfo,$orWhere);
    }

    public function count($where=array(),$columnName='*',$orWhere=array(),$distinct=false){
        return $this->connect->count($this->tableName,$where,$columnName,$orWhere,$distinct);
    }

    public function min($columnName,$where=array(),$orWhere=array()){
        return $this->connect->min($this->tableName,$columnName,$where,$orWhere);
    }

    public function max($columnName,$where=array(),$orWhere=array()){
        return $this->connect->max($this->tableName,$columnName,$where,$orWhere);
    }

    public function avg($columnName,$where=array(),$orWhere=array()){
        return $this->connect->avg($this->tableName,$columnName,$where,$orWhere);
    }

    public function sum($columnName,$where=array(),$orWhere=array()){
        return $this->connect->sum($this->tableName,$columnName,$where,$orWhere);
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