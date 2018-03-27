<?php
require 'connect.php';
$DRID=$_POST["DRID"];  //回复的ID
//$DRID="2";

$result=$database->delete("tbldynamicreply",[
    "DRID"=> $DRID
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
