<?php
require 'connect.php';
$Old_CIEnvirPics=$_POST["Old_CIEnvirPics"] ;          //公司图片   上一个文件名
// file-name        CIEnvirPics
$uid=$_POST["UID"];


if(assert($_FILES["CIEnvirPics"])) {
    if ((($_FILES["CIEnvirPics"]["type"] == "image/jpg")
            || ($_FILES["CIEnvirPics"]["type"] == "image/jpeg")
            || ($_FILES["CIEnvirPics"]["type"] == "image/png"))
        && ($_FILES["CIEnvirPics"]["size"] < 1048576)   //1M
    ) {
        if ($_FILES["CIEnvirPics"]["error"] > 0) {
            $arr['message'] = "0";   // 头像上传失败
        } else {
            $nowtime = time();
            $randomname = md5($uid . $nowtime ."CIEnvirPics");
            $CIEnvirPics = "http://120.76.120.85:8080/userData/company/" . $randomname . ".jpg";
            $succeed_update_file = move_uploaded_file($_FILES["CIEnvirPics"]["tmp_name"], "/data/wwwroot/default/offer100/homepage/userData/company/" . $randomname . ".jpg");
            if ($succeed_update_file) {
                deleteFile($Old_CIEnvirPics);
                $update_CIEnvirPics=$database->update("tblcompanyinfo",[
                    "CIEnvirPics"=>$CIEnvirPics
                ],[
                    "CI_fk_UID"=>$uid
                ]);
                if($update_CIEnvirPics){
                    $arr['message']="1";   // 更新成功
                    $arr['CIEnvirPics']=$CIEnvirPics;   // 更新成功
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
CIEnvirPics    地址
 */