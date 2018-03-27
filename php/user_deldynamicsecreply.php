<?php
require 'connect.php';
$DRID=$_POST["DSRID"];  //回复的ID
//$DSRID="2";

$result=$database->delete("tbldynamicsecreply",[
    "DSRID"=> $DSRID
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
