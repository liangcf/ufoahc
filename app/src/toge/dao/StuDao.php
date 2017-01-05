<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/11/29
 * Time: 17:24
 */

namespace app\src\toge\dao;

use app\src\toge\db\TwoConnect;

class StuDao extends TwoConnect
{
    function __construct(){
        parent::__construct('stu','id');
    }
}