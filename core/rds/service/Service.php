<?php
/**
 * @author 梁朝富 lcf@jionx.com
 */

namespace core\rds\service;

use core\rds\tool\Factory;

abstract class Service
{
    /**
     * @param $dao
     * @return \core\rds\db\Mysqli
     */
    public function dbDao($dao){
        return Factory::getDaoObj($dao);
    }
}