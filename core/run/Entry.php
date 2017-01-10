<?php

namespace core\run;

class Entry
{
    public static function run(){
        (new Application())->run();
    }
}