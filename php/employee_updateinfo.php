<?php
require 'connect.php';

$EIName=$_POST["EIName"];           //求职者姓名
$EIBirthday=$_POST["EIBirthday"];           //求职者出生年月   eg：1996-01
$EISex=$_POST["EISex"];           //求职者性别  0男   1女
$EIAddress=$_POST["EIAddress"];           //求职者地址    如：北京市-北京市   河北省-廊坊市
$EITopEdu=$_POST["EITopEdu"];           //求职者最高学历   如：本科
$EIGraduateYear=$_POST["EIGraduateYear"];           //求职者毕业年份   2018
$EIGraduateSchool=$_POST["EIGraduateSchool"];           //毕业学校   重庆大学
$EIProfession=$_POST["EIProfession"];           //专业   软件工程
$EIPhoneNum=$_POST["EIPhoneNum"];           //联系手机   18533670416

$uid=$_POST["UID"];  //用户ID



$update_text=$database->update("tblemployeeinfo",[
    "EIName"=> $EIName,
    "EIBirthday"=> $EIBirthday,
    "EISex"=> $EISex,
    "EIAddress"=> $EIAddress,
    "EITopEdu"=> $EITopEdu,
    "EIGraduateYear"=> $EIGraduateYear,
    "EIGraduateSchool"=> $EIGraduateSchool,
    "EIProfession"=> $EIProfession,
    "EIPhoneNum"=> $EIPhoneNum
],[
    "EI_fk_UID"=>$uid
]);


if($update_text){
    $arr['message']="1";   // 更新成功
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}else{
    $arr['message']="0";   // 更新失败
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}


/*
 * message 1:更新成功
 */