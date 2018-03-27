<?php
require 'connect.php';

$PSRContent=$_POST["Content"];           //二级回复内容
$PSRPublish_fk_UID=$_POST["UID"];           //用户ID
$PSR_fk_PRID=$_POST["PRID"];           //二级回复ID

//$PSRContent="PRContent";
//$PSRPublish_fk_UID="2";
//$PSR_fk_PRID="3";


$result=$database->insert("tblpositionsecreply",[
    "PSRContent"=> $PSRContent,
    "PSRPublish_fk_UID"=> $PSRPublish_fk_UID,
    "PSR_fk_PRID"=> $PSR_fk_PRID
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
