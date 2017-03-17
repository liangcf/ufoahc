<?php
header("Content-Type: text/html; charset=UTF-8");
include '../initial/init_list.php';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**********开始之处*****************************************************************************************************************************/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$runTime=$_SERVER['REQUEST_TIME'];
try{
    $test=\shell\lib\db\MysqliStmt::getInstance();
//    $res=$test->insert('users',array('id'=>'000','name'=>'test','sex'=>0));
//    $res=$test->insert('users',array());
//    $res=$test->updateId('users','000',array('name'=>'kddding'));
//
//    $res=$test->update('users',array('name'=>'sdfssa'),array('id'=>'000'));
//
//    $res=$test->update('users',array('name'=>'liang'),array('id'=>'king'));
//    $res=$test->delete('users',array('name'=>'sdfssaddd','id'=>'000'));
//    $res=$test->select('users',array('name'=>'sdfssa'),array('id'=>'desc','name'=>'asc'),0,20,array(),array('id'=>'000'));
//    $res=$test->selectAll('users',array('id'=>'desc','name'=>'asc'),0,10,array(),array('id'=>'000','name'=>'liang'));
//    $res=$test->selectAll('users');
//    $res=$test->selectId('users','000',array('name'));
//    $res=$test->selectAll('users',array('id'=>'desc'),0,0,array('id','name'));
//    $sql="select *from users where id='000'";
//    $sql="select *from users where id=?";
//    $param=array('id'=>'000');
//    $res=$test->query($sql);
//    $res=$test->query($sql,$param);
//    $res=$test->count('users'/*,array('id'=>'000')*/);
//    $res=$test->selectNotEqual('users','sort_order>=3208 and sort_order<=18233');
//    $res=$test->selects('users',array('sex'=>'0'),array(),0,0,array('name'));
//    $res=$test->like('users','name','正',array('sex'=>'0'),array('sort_order'=>'desc'),0,0,array('name','sort_order'));
//    $res=$test->max('users','sort_order');
//    $res=$test->min('users','sort_order');
//    $res=$test->avg('users','sort_order');
    $res=$test->sum('users','sort_order');
    p($res);
}catch (Exception $e){
    echo '异常:^^^^^';
    echo $e->getMessage();
}