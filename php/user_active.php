<?php
require 'connect.php';
$verify = stripslashes(trim($_GET['verify']));    //verify码
//$verify="e519ce39ed79218a484080adae37c646";
$nowtime = time();
$datas=$database->select("tbluser",[
    "UID",
    "UEmail",
    "UIdentity",
    "UState",
    "UToken_exptime",
    "UIdentity"
],[
    "UToken" =>$verify
]);
if(!$datas){
    $arr['message']="1";   // 激活码错误
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    exit();
}else{
    foreach ($datas as $data){
        if($data["UState"]==1){
            $arr['message']="2";   // 该邮箱已激活成功，请登录
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            exit();
        }else{
            if($data["UToken_exptime"]< $nowtime){
                $database->delete("tbluser",[
                    "UToken" =>$verify
                ]);
                $arr['message']="3";   // 未在规定时间内激活邮箱，请重新注册！
                echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                exit();
            }else{
                $update_num=$database->update("tbluser",[
                    "UState" =>"1"
                ],[
                    "UToken" =>$verify
                ]);
                $insert_id=0;
                if($data["UIdentity"]==0){
                    $insert_id=$database->insert("tblemployeeinfo",[
                        "EI_fk_UID"=>$data["UID"],
                        "EIName"=>$data["UEmail"]
                    ]);
                }else{
                    $insert_id=$database->insert("tblcompanyinfo",[
                        "CI_fk_UID"=>$data["UID"]
                    ]);
                }
                if($update_num&&$insert_id){
                    $arr['message']="4";   // 邮箱激活成功
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }else{
                    $arr['message']="5";   // 邮箱激活失败
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }
            }
        }
    }
}
/*
 * message  1:激活码错误    2:该邮箱已激活成功，请登录    3:未在规定时间内激活邮箱，请重新注册！    4:邮箱激活成功      5失败
 */