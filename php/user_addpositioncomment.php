<?php
require 'connect.php';
$PCContent=$_POST["Content"];           //评论内容
$PCPublish_fk_UID=$_POST["UID"];           //评论的UID
$PC_fk_PIID=$_POST["PIID"];           //职位ID


//$PCContent="PCContent";
//$PCPublish_fk_UID="1";
//$PC_fk_PIID="2";


$result=$database->insert("tblpositioncomment",[
    "PCContent"=> $PCContent,
    "PCPublish_fk_UID"=> $PCPublish_fk_UID,
    "PC_fk_PIID"=> $PC_fk_PIID
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
