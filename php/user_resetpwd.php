<?php
require "connect.php";
$pwd = md5(trim($_POST['password']));    //新密码
$email = trim($_POST['email']);     //邮箱
//$pwd = md5(trim("hehehe"));
//$email = trim("2045526030@qq.com");
//$uid=trim("17");     //用户ID

$result=$database->update("tbluser",[
    "UPassword"=>$pwd,
    "UCode"=>Null
],[
    "UEmail"=>$email
]);
if($result){
    $arr['message']="1";   // 修改成功
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}else{
    $arr['message']="0";   // 修改失败
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}

/*
 * message    1:修改成功    0：修改失败
 */