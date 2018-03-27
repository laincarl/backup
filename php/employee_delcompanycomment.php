<?php
require 'connect.php';
$CCID=$_POST["CCID"];           //公司评论ID
//$CCID="1";
$result=$database->delete("tblcompanycomment",[
    "CCID"=> $CCID
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
