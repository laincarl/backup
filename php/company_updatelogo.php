<?php
require 'connect.php';
$Old_CILogo =$_POST["Old_CILogo"] ;         //公司logo  上一个文件名
// file-name   CILogo

$uid=$_POST["UID"];

if(assert($_FILES["CILogo"])) {
    if ((($_FILES["CILogo"]["type"] == "image/jpg")
            || ($_FILES["CILogo"]["type"] == "image/jpeg")
            || ($_FILES["CILogo"]["type"] == "image/png"))
        && ($_FILES["CILogo"]["size"] < 1048576)   //1M
    ) {
        if ($_FILES["CILogo"]["error"] > 0) {
            $arr['message'] = "0";   // 头像上传失败
        } else {
            $nowtime = time();
            $randomname = md5($uid . $nowtime ."CILogo");
            $CILogo = "http://120.76.120.85:8080/userData/company/" . $randomname . ".jpg";
            $succeed_update_file = move_uploaded_file($_FILES["CILogo"]["tmp_name"], "/data/wwwroot/default/offer100/homepage/userData/company/" . $randomname . ".jpg");
            if ($succeed_update_file) {
                deleteFile($Old_CILogo);
                $update_CILogo=$database->update("tblcompanyinfo",[
                    "CILogo"=>$CILogo
                ],[
                    "CI_fk_UID"=>$uid
                ]);
                if($update_CILogo){
                    $arr['message']="1";   // 更新成功
                    $arr['CILogo']=$CILogo;   // 更新成功
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }else{
                    $arr['message']="0";   // 更新失败
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }
            }else {
                $arr['message'] = "0";   // 头像上传失败
            }
        }
    } else {
        $arr['message'] = "0";   // 头像上传失败
    }
}




function deleteFile($filename){
    $file = "/data/wwwroot/default/offer100/homepage/userData/company/"+$filename;
    if (!unlink($file)) {
        return 0;   //失败
    }else {
        return 1;   //成功
    }
}


/*
 * message 1:更新成功    0更新失败
CILogo    地址
 */