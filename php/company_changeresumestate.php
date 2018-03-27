<?php
require 'connect.php';

$RID=$_POST["RID"];  //简历ID
$type=$_POST['type'];     // 1无反应    2已查看      3感兴趣    4不感兴趣


//$RID="1";
//$type="2";      // 1无反应    2已查看      3感兴趣    4不感兴趣
$result=$database->update("tblresume",[
    "RState"=>$type
],[
    "RID"=>$RID
]);

if($result){
    $arr['message']="1";   // 发送成功
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}else{
    $arr['message']="0";   // 发送失败
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}


/*
 * message  1删除成功     0删除失败
 */
