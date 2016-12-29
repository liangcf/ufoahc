<?php
namespace core\rds\service;

use core\rds\tool\Factory;

class Service
{
    /**
     * @param $dao
     * @return \core\rds\db\MysqliInterface
     */
    public function dbService($dao){
        return Factory::getDaoModel($dao);
    }
}