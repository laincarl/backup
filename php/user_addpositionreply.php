<?php
require 'connect.php';

$PRContent=$_POST["Content"];           //二级回复内容
$PRPublish_fk_UID=$_POST["UID"];           //用户ID
$PR_fk_PCID=$_POST["PCID"];           //一级回复ID
//$PRContent="PRContent";
//$PRPublish_fk_UID="2";
//$PR_fk_PCID="2";


$result=$database->insert("tblpositionreply",[
    "PRContent"=> $PRContent,
    "PRPublish_fk_UID"=> $PRPublish_fk_UID,
    "PR_fk_PCID"=> $PR_fk_PCID
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
