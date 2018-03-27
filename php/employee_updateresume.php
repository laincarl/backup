<?php
require 'connect.php';

$uid=$_POST["UID"];  //用户ID
//EIResume   file-name   简历的
$Old_Resume=$_POST["Old_Resume"];           //旧的简历名字   如 fkmvkfk.pdf



if(assert($_FILES["EIResume"])) {
    if ((($_FILES["EIResume"]["type"] == "application/pdf")
            || ($_FILES["EIResume"]["type"] == "application/msword")
            || ($_FILES["EIResume"]["type"] == "application/zip"))
        && ($_FILES["EIResume"]["size"] < 5242880)   //5M
    ) {
        if ($_FILES["EIResume"]["error"] > 0) {
            $arr['message'] = "0";   // 简历上传失败
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            $nowtime = time();
            $randomname = md5($uid . $nowtime ."EIResume");
            $EIResume = "http://120.76.120.85:8080/userData/employee/" . $randomname . ".jpg";
            $succeed_update_file = move_uploaded_file($_FILES["EIResume"]["tmp_name"], "/data/wwwroot/default/offer100/homepage/userData/employee/" . $randomname . ".jpg");
            if ($succeed_update_file) {
                deleteFile($Old_Resume);
                $update_EIResume=$database->update("tblemployeeinfo",[
                    "EIResume"=> $EIResume
                ],[
                    "EI_fk_UID"=>$uid
                ]);
                if($update_EIResume){
                    $arr['message']="1";   // 更新成功
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }else{
                    $arr['message']="0";   // 更新失败
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }
            }else {
                $arr['message'] = "0";   // 简历上传失败
                echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                exit();
            }
        }
    } else {
        $arr['message'] = "0";   // 简历上传失败
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
 * message  1:更新成功   0:更新失败
 */