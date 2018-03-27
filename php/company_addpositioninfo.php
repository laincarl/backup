<?php
require 'connect.php';
$PI_fk_CIID=$_POST["CIID"];           //公司ID
$PIName=$_POST["PIName"];           //职位名称
$PIClass=$_POST["PIClass"];           //职位类别       如银行卡推广
$PIDuty=$_POST["PIDuty"];           //岗位职责
$PIQualification=$_POST["PIQualification"];           //任职资格
$PIWelfare=$_POST["PIWelfare"];           //福利待遇
$PIWage=$_POST["PIWage"];           //预计薪资  200/天
$PILowEdu=$_POST["PILowEdu"];           //最低学历
$PIPacticeorFull=$_POST["PIPacticeorFull"];           //两个复选框，可多选  0实习 1全职 2实习全职都可以
$PIWorkPlace=$_POST["PIWorkPlace"];           //工作地点  省市联动， 如  北京市-北京市
$PINeedNum=$_POST["PINeedNum"];           //岗位需求    3人
$PIExperience=$_POST["PIExperience"];           //经验要求   至少一年
$PIEndTime=$_POST["PIEndTime"];           //  截止日期   2017-08-08





$insert_id=$database->insert("tblpositioninfo",[
    "PI_fk_CIID"=> $PI_fk_CIID,
    "PIName"=> $PIName,
    "PIClass"=> $PIClass,
    "PIDuty"=> $PIDuty,
    "PIQualification"=> $PIQualification,
    "PIWelfare"=> $PIWelfare,
    "PIWage"=> $PIWage,
    "PILowEdu"=> $PILowEdu,
    "PIPacticeorFull"=> $PIPacticeorFull,
    "PIWorkPlace"=> $PIWorkPlace,
    "PINeedNum"=> $PINeedNum,
    "PIExperience"=> $PIExperience,
    "PIEndTime"=> $PIEndTime
]);
if($insert_id){
    $arr['message']="1";   // 发送成功
}else{
    $arr['message']="0";   // 发送失败
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);

/*
 * message  1  添加成功    0添加失败
 */
