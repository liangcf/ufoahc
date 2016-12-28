<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2016/6/17
 * Time: 11:39
 */

namespace app\src\toge\db;

use core\run\GetConfigs;
use core\rds\db\Mysqli;

abstract class TestDb extends Mysqli
{
    /**
     * @throws \Exception
     */
    function __construct(){
        $defaultDb=GetConfigs::getRunConfigs();
        $config=$defaultDb['db_2'];
        $this->setConnectInit($config);
    }
}