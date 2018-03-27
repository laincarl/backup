<?php
require 'connect.php';
$CIID=$_POST['CIID'];    //公司ID
//$CIID="1";    //公司ID


$datas=$database->select("tblcompanyinfo",[
    "[><]tblpositioninfo"=>["CIID"=>"PI_fk_CIID"]
],[
    "PIID",
    "PI_fk_CIID",
    "PIName",
    "PIClass",
    "PIDuty",
    "PIQualification",
    "PIWelfare",
    "PIWage",
    "PILowEdu",
    "PIPacticeorFull",
    "PIWorkPlace",
    "PINeedNum",
    "PIExperience",
    "PIRegTime",
    "PIEndTime",
],[
    "CIID"=>$CIID,
    "ORDER" => ["tblpositioninfo.PIRegTime" => "DESC"]
]);
$arr['count']=count($datas);
$arr['list']=$datas;
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
/*count  list数目
 * 解析list
PIID                //职位ID
CIID                   //公司ID
PIName                   //职位名称
PIClass                   //职位类别       如银行卡推广
PIDuty                   //岗位职责
PIQualification                   //任职资格
PIWelfare                   //福利待遇
PIWage                   //预计薪资  200/天
PILowEdu                   //最低学历
PIPacticeorFull                   //两个复选框，可多选  0实习 1全职 2实习全职都可以
PIWorkPlace                   //工作地点  省市联动， 如  北京市-北京市
PINeedNum                   //岗位需求    3人
PIExperience                   //经验要求   至少一年
PIEndTime                   //  截止日期   2017-08-08
 */