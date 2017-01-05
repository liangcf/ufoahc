<?php
namespace app\src\toge\dao;

use app\src\toge\db\DbConnect;

class PhoneDao extends DbConnect
{
    /**
     * 继承父类构造函数，第一个为表名，第二个为默认主键id，用于id查询
     * UserDao constructor.
     */
    function __construct(){
        parent::__construct('phone','id');
    }
}