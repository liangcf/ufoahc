<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/6/17
 * Time: 10:41
 * @version 1.1.1
 * @function 参数化查询的类
 * 部分代码重复率有点高，还需优化
 */

namespace core\rds\db;


interface MysqliInterface
{
    public function insert($data);

    public function updateId($id,$data);

    public function deleteId($id);

    public function selectId($id,$getInfo=array('*'));

    public function update($data,$where);

    public function delete($where);

    public function select($where,$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array());

    public function selectAll($order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array());

    public function selects($where=array(),$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array());

    public function query($sql,$param=array());

    public function selectNotEqual($whereString,$getInfo=array('*'));

    public function like($stringName,$content,$where=array(),$order=array(),$offset=0,$fetchNum=0,$getInfo=array('*'),$orWhere=array());

    public function count($where=array(),$columnName='*',$orWhere=array());

    public function min($columnName,$where=array(),$orWhere=array());

    public function max($columnName,$where=array(),$orWhere=array());

    public function avg($columnName,$where=array(),$orWhere=array());

    public function sum($columnName,$where=array(),$orWhere=array());

    public function beginTransaction();

    public function commitTransaction();

    public function rollbackTransaction();
}