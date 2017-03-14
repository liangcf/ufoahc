<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/17
 * Time: 11:39
 */
namespace app\admin\src\utils;

use core\run\GetConfigs;
use core\src\db\Mysqli;

abstract class DbUtils extends Mysqli
{
    /**
     * DbConnect constructor.
     * @param $tableName
     * @param string $id
     */
    function __construct($tableName,$id='id'){
        $this->tableName=$tableName;
        $this->tableId=$id;
        parent::initConnect(GetConfigs::getRunConfigs()['db']);
    }
}