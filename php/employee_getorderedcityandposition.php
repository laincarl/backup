<?php
require 'connect.php';

$EIID=$_POST["EIID"];  //用户ID
//$EIID="1";
$datas=$database->select("tblemployeeinfo",[
    "EIOrder_City",
    "EIOrder_Position"
],[
    "EIID"=>$EIID
]);

foreach ($datas as $data){

    $City=array_filter(explode ("#", $data['EIOrder_City']));
    $Position=array_filter(explode ("#", $data['EIOrder_Position']));

    $count = count($City);
    for ($i = 0; $i < $count; $i++) {
        $arr['list'][$i]['City']=$City[$i];
        $arr['list'][$i]['Position']=$Position[$i];
    }

    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}


/*
 * 解析list
City                   //订阅的城市   如：北京市
Position                   //订阅的职位   前端工程师
 */