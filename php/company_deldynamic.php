<?php
require 'connect.php';
$CDID=$_POST["CDID"];   //动态ID
//$CDID="1";   //动态ID
$del_num=$database->delete("tblcompanydynamic",[
    "CDID"=> $CDID
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
