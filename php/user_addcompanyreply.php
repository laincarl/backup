<?php
require 'connect.php';

$CRContent=$_POST["Content"];           //二级回复内容
$CRPublish_fk_UID=$_POST["UID"];           //用户ID
$CR_fk_CCID=$_POST["CCID"];           //一级回复ID

//$CRContent="CRContent";
//$CRPublish_fk_UID="2";
//$CR_fk_CCID="3";


$result=$database->insert("tblcompanyreply",[
    "CRContent"=> $CRContent,
    "CRPublish_fk_UID"=> $CRPublish_fk_UID,
    "CR_fk_CCID"=> $CR_fk_CCID
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
