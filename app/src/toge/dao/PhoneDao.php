<?php
namespace app\src\toge\dao;

use app\src\toge\db\DbConnect;

class PhoneDao extends DbConnect
{
    protected function _getTableName(){
        return 'phone';
    }
    protected function _getDefaultId(){
        return 'id';
    }
}