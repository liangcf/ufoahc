<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/11/29
 * Time: 17:24
 */

namespace app\src\toge\dao;

use app\src\toge\db\TestDb;

class StuDao extends TestDb
{
    protected function _getTableName(){
        return 'stu';
    }
    protected function _getDefaultId(){
        return 'id';
    }
}