<?php
require 'connect.php';

$RID=$_POST["RID"];  //简历ID
//$RID="1";
$datas=$database->select("tblresume",[
    "[>]tblemployeeinfo"=>["R_fk_EIID"=>"EIID"],
    "[>]tbluser"=>["tblemployeeinfo.EI_fk_UID"=>"UID"]
],[
    "UEmail",
    "EIID",
    "EI_fk_UID",
    "EIName",
    "EIBirthday",
    "EISex",
    "EIHeadPic",
    "EIAddress",
    "EITopEdu",
    "EIGraduateYear",
    "EIGraduateSchool",
    "EIProfession",
    "EIPhoneNum",
    "EIResume"
],[
    "RID"=>$RID
]);


foreach ($datas as $data){
    $arr['UEmail']=$data['UEmail'];
    $arr['EIID']=$data['EIID'];
    $arr['UID']=$data['EI_fk_UID'];
    $arr['EIName']=$data['EIName'];
    $arr['EIBirthday']=$data['EIBirthday'];
    $arr['EISex']=$data['EISex'];
    $arr['EIHeadPic']=$data['EIHeadPic'];
    $arr['EIAddress']=$data['EIAddress'];
    $arr['EITopEdu']=$data['EITopEdu'];
    $arr['EIGraduateYear']=$data['EIGraduateYear'];
    $arr['EIGraduateSchool']=$data['EIGraduateSchool'];
    $arr['EIProfession']=$data['EIProfession'];
    $arr['EIPhoneNum']=$data['EIPhoneNum'];
    $arr['EIResume']=$data['EIResume'];
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}


/*
UEmail    邮箱
UID           用户ID
EIName                   //求职者姓名
EIBirthady                   //求职者出生年月   eg：1996-01
EISex                   //求职者性别  0男   1女
EIHeadPic                   //求职者旧的头像   如 djvnjfjv.jpg
EIAddress                   //求职者地址    如：北京市-北京市   河北省-廊坊市
EITopEdu                   //求职者最高学历   如：本科
EIGraduateYear                   //求职者毕业年份   2018
EIGraduateSchool                   //毕业学校   重庆大学
EIProfession                   //专业   软件工程
EIPhoneNum                   //联系手机   18533670416
EIResume                   //旧的简历名字   如 fkmvkfk.pdf
 */