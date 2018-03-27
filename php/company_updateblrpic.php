<?php
require 'connect.php';

$Old_CIBLR_pic  =$_POST["Old_CIBLR_pic"] ;         //营业执照   上一个文件名
//file-name    CIBLR_pic

$uid=$_POST["UID"];



if(assert($_FILES["CIBLR_pic"])) {
    if ((($_FILES["CIBLR_pic"]["type"] == "image/jpg")
            || ($_FILES["CIBLR_pic"]["type"] == "image/jpeg")
            || ($_FILES["CIBLR_pic"]["type"] == "image/png"))
        && ($_FILES["CIBLR_pic"]["size"] < 1048576)   //1M
    ) {
        if ($_FILES["CIBLR_pic"]["error"] > 0) {
            $arr['message'] = "0";   // 头像上传失败
        } else {
            $nowtime = time();
            $randomname = md5($uid . $nowtime ."CIBLR_pic");
            $CIBLR_pic = "http://120.76.120.85:8080/userData/company/" . $randomname . ".jpg";
            $succeed_update_file = move_uploaded_file($_FILES["CIBLR_pic"]["tmp_name"], "/data/wwwroot/default/offer100/homepage/userData/company/" . $randomname . ".jpg");
            if ($succeed_update_file) {
                deleteFile($Old_CIBLR_pic);
                $update_CIBLR_pic=$database->update("tblcompanyinfo",[
                    "CIBLR_pic"=>$CIBLR_pic
                ],[
                    "CI_fk_UID"=>$uid
                ]);
                if($update_CIBLR_pic){
                    $arr['message']="1";   // 更新成功
                    $arr['CIBLR_pic']=$CIBLR_pic;   // 更新成功
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
CIBLR_pic   地址
 */