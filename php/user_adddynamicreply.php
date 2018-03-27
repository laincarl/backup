<?php
require 'connect.php';

$DRContent=$_POST["Content"];           //二级回复内容
$DRPublish_fk_UID=$_POST["UID"];           //用户ID
$DR_fk_DCID=$_POST["DCID"];           //一级回复ID

//$DRContent="DRDontent";
//$DRPublish_fk_UID="2";
//$DR_fk_DCID="3";


$result=$database->insert("tbldynamicreply",[
    "DRContent"=> $DRContent,
    "DRPublish_fk_UID"=> $DRPublish_fk_UID,
    "DR_fk_DCID"=> $DR_fk_DCID
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
