<?php
namespace app\src\toge\dao;

use app\src\toge\db\DbConnect;

class UsersDao extends DbConnect
{
    protected function _getTableName(){
        return 'users';
    }
    protected function _getDefaultId(){
        return 'id';
    }
}