<?php
require 'connect.php';
$DCContent=$_POST["Content"];           //评论内容
$DCPublish_fk_UID=$_POST["UID"];           //评论的UID
$DC_fk_CDID=$_POST["CDID"];           //动态ID


//$DCContent="DCContent";
//$DCPublish_fk_UID="1";
//$DC_fk_CDID="2";


$result=$database->insert("tbldynamiccomment",[
    "DCContent"=> $DCContent,
    "DCPublish_fk_UID"=> $DCPublish_fk_UID,
    "DC_fk_CDID"=> $DC_fk_CDID
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
