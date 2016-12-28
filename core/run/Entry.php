<?php
/**
 * Created by PhpStorm.
 * User: AF
 * Date: 2016/12/16
 * Time: 20:22
 */

namespace core\run;

class Entry
{
    public static function run(){
        (new Application())->run();
    }
}