<?php
require 'connect.php';
$PIID=$_POST["PIID"];   //职位ID
//$PIID="12";   //职位ID
$del_num=$database->delete("tblpositioninfo",[
    "PIID"=> $PIID
]);
if($del_num){
    $arr['message']="1";   // 发送成功
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}else{
    $arr['message']="0";   // 发送失败
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}


/*
 * message  1删除成功     0删除失败
 */
