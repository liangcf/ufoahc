<?php
/**
 * @author 梁朝富 lcf@jionx.com
 */

namespace core\src\service;

use core\src\tool\Factory;

abstract class Service
{
    protected $mode=null;
    public function __construct($mode)
    {
        $this->mode=$mode;
    }

    /**
     * @param $dao
     * @param null $module
     * @return \core\src\db\Mysqli
     * @throws \Exception
     */
    protected function dbDao($dao,$module=null){
        if(empty($module)){
            $module=$this->mode;
        }
        return Factory::getDaoObj($dao,$module);
    }
}