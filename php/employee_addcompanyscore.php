<?php
require 'connect.php';

$CS_fk_EIID=$_POST["EIID"];           //求职者ID
$CS_fk_CIID=$_POST["CIID"];           //公司ID
$CSzhiyechengzhang=$_POST["CSzhiyechengzhang"];           //
$CSjinengchengzhang=$_POST["CSjinengchengzhang"];           //
$CSgongzuofenzuo=$_POST["CSgongzuofenzuo"];           //
$CSgongzuoyali=$_POST["CSgongzuoyali"];           //
$CSgongsiqianjing=$_POST["CSgongsiqianjing"];           //


//$CS_fk_EIID="1";
//$CS_fk_CIID="1";
//$CSzhiyechengzhang="1";
//$CSjinengchengzhang="1";
//$CSgongzuofenzuo="1";
//$CSgongzuoyali="1";
//$CSgongsiqianjing="1";


$insert_id=$database->insert("tblcompanyscore",[
    "CS_fk_EIID"=> $CS_fk_EIID,
    "CS_fk_CIID"=> $CS_fk_CIID,
    "CSzhiyechengzhang"=> $CSzhiyechengzhang,
    "CSjinengchengzhang"=> $CSjinengchengzhang,
    "CSgongzuofenzuo"=> $CSgongzuofenzuo,
    "CSgongzuoyali"=> $CSgongzuoyali,
    "CSgongsiqianjing"=> $CSgongsiqianjing,
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
