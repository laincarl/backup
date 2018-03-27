<?php
require 'connect.php';

$CSRContent=$_POST["Content"];           //二级回复内容
$CSRPublish_fk_UID=$_POST["UID"];           //用户ID
$CSR_fk_CRID=$_POST["CSRID"];           //二级回复ID


//$CSRContent="CRContent";
//$CSRPublish_fk_UID="2";
//$CSR_fk_CRID="2";


$result=$database->insert("tblcompanysecreply",[
    "CSRContent"=> $CSRContent,
    "CSRPublish_fk_UID"=> $CSRPublish_fk_UID,
    "CSR_fk_CRID"=> $CSR_fk_CRID
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
