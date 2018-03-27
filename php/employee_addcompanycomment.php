<?php
require 'connect.php';
$CCContent=$_POST["Content"];           //评论内容
$CCPublish_fk_UID=$_POST["UID"];           //评论的UID
$CC_fk_CIID=$_POST["CIID"];           //公司ID


//$CCContent="CCContent";
//$CCPublish_fk_UID="1";
//$CC_fk_CIID="2";


$result=$database->insert("tblcompanycomment",[
    "CCContent"=> $CCContent,
    "CCPublish_fk_UID"=> $CCPublish_fk_UID,
    "CC_fk_CIID"=> $CC_fk_CIID
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
