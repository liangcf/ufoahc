<?php
namespace app\web\src\service;

use core\src\service\Service;

class IndexService extends Service
{
    public function __construct($mode)
    {
        parent::__construct($mode);
    }
    public function index(){
        return 'testt';
    }

}
