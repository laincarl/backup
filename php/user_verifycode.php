<?php
require "connect.php";
$email = trim($_POST['email']);     //注册邮箱
$input_code=trim($_POST['code']);    //用户输入的验证码
//$email = trim("2045526030@qq.com");
//$input_code="70001";    //用户输入的验证码
//$uid=trim("17");     //用户ID
$datas=$database->select("tbluser",[
    "UToken_exptime",
    "UCode"
],[
    "UEmail"=>$email
]);
if(!$datas){
    $arr['message']="1";   // 该邮箱未注册
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    exit();
}else{
    foreach ($datas as $data){
        if(time()>$data["UToken_exptime"]){
            $arr['message']="2";   // 验证码失效
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            exit();
        }else{
            if($data["UCode"]!=$input_code){
                $arr['message']="3";   // 验证码错误
                echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            }else{
                $arr['message']="4";   // 验证码正确
                echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            }
        }
    }
}

/*
 * message    1: 该邮箱未注册        2: 验证码失效        3:验证码错误           4:验证码正确
 */