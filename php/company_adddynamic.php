<?php
require 'connect.php';

$CDContent=$_POST["Content"];           //内容
$CD_fk_CIID=$_POST["CIID"];           //公司ID

//$CDContent="CDContent";
//$CD_fk_CIID="2";


$insert_id=$database->insert("tblcompanydynamic",[
    "CDContent"=> $CDContent,
    "CD_fk_CIID"=> $CD_fk_CIID
]);
if($insert_id){
    $arr['message']="1";   // 发送成功
}else{
    $arr['message']="0";   // 发送失败
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);

/*
 * message  1  添加成功    0添加失败
 */
