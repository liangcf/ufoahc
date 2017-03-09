<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/17
 * Time: 11:39
 */
namespace app\web\src\db;

use core\run\GetConfigs;
use core\src\db\Mysqli;

abstract class DbConnect extends Mysqli
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