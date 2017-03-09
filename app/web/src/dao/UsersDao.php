<?php
namespace app\web\src\dao;

use app\web\src\db\DbConnect;

class UsersDao extends DbConnect
{
    /**
     * 继承父类构造函数，第一个参数为表名，第二个参数为默认主键id，用于id查询
     * ($tableName,$id='id')
     * UserDao constructor.
     */
    function __construct(){
        //TODO 默认的 类名必须与数据库表名相同切后有Dao 例如: 表名'users',类名'UsersDao'
        //////////////////////开始//////////////////////////
        $tmp=explode('\\',__CLASS__);
        $count=count($tmp);
        $_name=$tmp[$count-1];
        parent::__construct(substr(strtolower($_name),0,-3));
        ///////////////////////结束/////////////////////////

        //TODO 直接继承 修改构造函数参数
        /********************开始***********************/
        //parent::__construct('users','id');
        /********************结束***********************/
    }
}