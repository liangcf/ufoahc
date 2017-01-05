<?php
namespace core\rds\service;

use core\rds\tool\Factory;

abstract class Service
{
    /**
     * @param $dao
     * @return \core\rds\db\MysqliInterface
     */
    public function dbDao($dao){
        return Factory::getDaoObj($dao);
    }
}