<?php
require 'connect.php';

$uid=$_POST["UID"];  //用户ID
//EIHeadPic  file-name   头像
$Old_HeadPic=$_POST["Old_HeadPic"];           //求职者旧的头像   如 djvnjfjv.jpg



if(assert($_FILES["EIHeadPic"])){
    if ((($_FILES["EIHeadPic"]["type"] == "image/jpg")
            || ($_FILES["EIHeadPic"]["type"] == "image/jpeg")
            || ($_FILES["EIHeadPic"]["type"] == "image/png"))
        && ($_FILES["EIHeadPic"]["size"] < 1048576)   //1M
    ) {
        if ($_FILES["EIHeadPic"]["error"] > 0) {
            $arr['message'] = "0";   // 头像上传失败
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            $nowtime = time();
            $randomname = md5($uid . $nowtime ."EIHeadPic");
            $EIHeadPic = "http://120.76.120.85:8080/userData/employee/" . $randomname . ".jpg";
            $succeed_update_file = move_uploaded_file($_FILES["EIHeadPic"]["tmp_name"], "/data/wwwroot/default/offer100/homepage/userData/employee/" . $randomname . ".jpg");
            if ($succeed_update_file) {
                deleteFile($Old_HeadPic);
                $update_EIHeadPic=$database->update("tblemployeeinfo",[
                    "EIHeadPic"=> $EIHeadPic
                ],[
                    "EI_fk_UID"=>$uid
                ]);
                if($update_EIHeadPic){
                    $arr['message']="1";   // 更新成功
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }else{
                    $arr['message']="0";   // 更新失败
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }
            }else {
                $arr['message'] = "0";   // 头像上传失败
                echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                exit();
            }
        }
    } else {
        $arr['message'] = "0";   // 头像上传失败
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        exit();
    }
}





function deleteFile($filename){
    $file = "/data/wwwroot/default/offer100/homepage/userData/employee/"+$filename;
    if (!unlink($file)) {
        return 0;   //失败
    }else {
        return 1;   //成功
    }
}
/*
 * message     1:更新成功   0:更新失败
 */