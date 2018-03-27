<?php
require 'connect.php';
$DSRContent=$_POST["Content"];           //二级回复内容
$DRPublish_fk_UID=$_POST["UID"];           //用户ID
$DR_fk_DRID=$_POST["DRID"];           //二级回复ID

//$DSRContent="DSRDontent";
//$DSRPublish_fk_UID="2";
//$DSR_fk_DRID="2";


$result=$database->insert("tbldynamicsecreply",[
    "DSRContent"=> $DSRContent,
    "DSRPublish_fk_UID"=> $DSRPublish_fk_UID,
    "DSR_fk_DRID"=> $DSR_fk_DRID
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
