<?php
require 'connect.php';
$PRID=$_POST["PRID"];  //回复的ID
//$PRID="5";

$result=$database->delete("tblpositionreply",[
    "PRID"=> $PRID
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
