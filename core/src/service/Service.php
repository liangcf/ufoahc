<?php
/**
 * @author 梁朝富 lcf@jionx.com
 */

namespace core\src\service;

use core\src\tool\Factory;

abstract class Service
{
    /**
     * @param $dao
     * @param $module
     * @return \core\src\db\Mysqli
     * @throws \Exception
     */
    public function dbDao($dao,$module){
        return Factory::getDaoObj($dao,$module);
    }
}