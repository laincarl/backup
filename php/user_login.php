<?php
require 'connect.php';
$email=trim($_POST["login_email"]);    //注册邮箱
$pwd= md5(trim($_POST["login_password"]));    //密码
//$email="2045526030@qq.com";
//$pwd= "ffe553694f5096471590343432359e02";

$email_has_or_not=$database->has("tbluser", [
    "UEmail" => $email
]);
if(!$email_has_or_not){
    $arr['message']="1";   // 邮箱未注册过
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    exit();
}else{
    $pwd_right_or_not=$database->has("tbluser",[
        "AND"=>[
            "UEmail" => $email,
            "UPassword"=>$pwd
        ]
    ]);
    if(!$pwd_right_or_not){
        $arr['message']="2";   //密码错误
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        exit();
    }else{
        $user_active_or_not=$database->has("tbluser",[
            "AND"=>[
                "UEmail" => $email,
                "UPassword"=>$pwd,
                "UState"=>"1"
            ]
        ]);
        if(!$user_active_or_not){
            $arr['message']="3";   // 该邮箱未激活，请登陆邮箱激活
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            exit();
        }else{
            $datas=$database->select("tbluser",[
                "UID",
                "UEmail",
                "UIdentity"
            ],[
                "AND"=>[
                    "UEmail" => $email,
                    "UPassword"=>$pwd
                ]
            ]);
            foreach ($datas as $data){
                $arr['UID']=$data["UID"];
                $arr['UEmail']=$data["UEmail"];
                $arr['UIdentity']=$data["UIdentity"];
            }
            if($arr['UIdentity']==0){
                $edatas=$database->select("tblemployeeinfo",[
                    "EIID",
                    "EIName",
                    "EIHeadPic"
                ],[
                   "EI_fk_UID"=>$arr['UID']
                ]);

                foreach ($edatas as $edata) {
                    $arr['EIID']=$edata["EIID"];
                    $arr['EIName']=$edata["EIName"];
                    $arr['EIHeadPic']=$edata["EIHeadPic"];
                }
            }else{
                $cdatas=$database->select("tblcompanyinfo",[
                    "CIID",
                    "CIName",
                    "CILogo"
                ],[
                   "CI_fk_UID"=>$arr['UID']
                ]);

                foreach ($cdatas as $cdata) {
                    $arr['CIID']=$cdata["CIID"];
                    $arr['CIName']=$cdata["CIName"];
                    $arr['CILogo']=$cdata["CILogo"];
                }
            }
            $arr['message']="4"; //登陆成功

            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        }
    }
}

/*
 * message   1:邮箱未注册过   2:密码错误      3:该邮箱未激活，请登陆邮箱激活     4:登陆成功
 * UID   用户ID
 * UEmail   用户邮箱
 * UIdentity   用户身份：  0求职者   1公司
 * 如果是求职者：  EIID   EIName    EIHeadPic
 * 如果是公司：     CIID    CIName    CILogo
 */


