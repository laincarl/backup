<?php
require 'connect.php';


$R_fk_EIID=$_POST["EIID"];           //求职者ID
$R_fk_PIID=$_POST["PIID"];           //职位ID


//$R_fk_EIID="1";
//$R_fk_PIID="1";

$result=$database->insert("tblresume",[
    "R_fk_EIID"=> $R_fk_EIID,
    "R_fk_PIID"=> $R_fk_PIID
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
