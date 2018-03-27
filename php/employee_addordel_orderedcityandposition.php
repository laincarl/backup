<?php
require 'connect.php';

$EIOrder_City=$_POST["Order_City"];           //订阅的城市
$EIOrder_Position=$_POST["Order_Position"];           //订阅的职位
$EIID=$_POST['EIID'];
$type=$_POST['type'];   //0添加   1删除


//$EIOrder_City="北京";           //订阅的城市
//$EIOrder_Position="前端";           //订阅的职位
//$EIID="1";
//$type="0";   //0添加   1删除

$datas=$database->select("tblemployeeinfo",[
    "EIOrder_City",
    "EIOrder_Position"
],[
    "EIID"=>$EIID
]);
$City="";
$Position="";
foreach ($datas as $data){
    $City=$data['EIOrder_City'];
    $Position=$data['EIOrder_Position'];
}

$result=0;
if($type=="0"){
    $City=$City.$EIOrder_City."#";
    $Position=$Position.$EIOrder_Position."#";
    $result=$database->update("tblemployeeinfo",[
        "EIOrder_City"=> $City,
        "EIOrder_Position"=> $Position
    ],[
        "EIID"=>$EIID
    ]);
}else{
    $City=str_replace($EIOrder_City."#",'',$City);
    $Position=str_replace($EIOrder_Position."#",'',$Position);

    $result=$database->update("tblemployeeinfo",[
        "EIOrder_City"=> $City,
        "EIOrder_Position"=> $Position
    ],[
        "EIID"=>$EIID
    ]);
}

if($result){
    $arr['message']="1";   // 发送成功
}else{
    $arr['message']="0";   // 发送失败
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);

/*
 * message  1  添加成功    0添加失败
 */
