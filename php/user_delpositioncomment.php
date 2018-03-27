<?php
require 'connect.php';
$PCID=$_POST["PCID"];           //职位评论ID
//$PCID="1";
$result=$database->delete("tblpositioncomment",[
    "PCID"=> $PCID
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
