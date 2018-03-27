<?php
require 'connect.php';
$CSRID=$_POST["CSRID"];  //回复的ID
//$CSRID="2";

$result=$database->delete("tblcompanysecreply",[
    "CSRID"=> $CSRID
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
