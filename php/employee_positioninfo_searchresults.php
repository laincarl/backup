<?php
require 'connect.php';
$CIProperty=$_POST["CIProperty"];  //公司性质
$CIIndustry=$_POST["CIIndustry"];  //公司行业
$PIClass=$_POST["PIClass"];  //职位类别
$PIWorkPlace=$_POST["PIWorkPlace"];  //工作地点
$PIWage=$_POST["PIWage"];  //月薪
$PIExperience=$_POST["PIExperience"];  //工作年限
$PILowEdu=$_POST["PILowEdu"];  //学历要求
$PIEndTime=$_POST["PIEndTime"];  //截止时间


$datas=$database->select("tblpositioninfo",[
    "[><]tblcompanyinfo"=>["PI_fk_CIID"=>"CIID"]
],[
    "PIName",
    "PIRegTime",
    "PIWage",
    "PIWorkPlace",
    "PILowEdu",
    "PIExperience",
    "CIName",
    "CIIndustry",
    "CIProperty",
    "CIScale"
],[
    "AND"=>[
        "CIProperty["=>$CIProperty,
        "CIIndustry"=>$CIIndustry,
        "PIClass"=>$PIClass,
        "PIWorkPlace"=>$PIWorkPlace,
        "PIWage"=>$PIWage,
        "PIExperience"=>$PIExperience,
        "PILowEdu"=>$PILowEdu,
        "PIEndTime"=>$PIEndTime
    ]

]);
$arr['list']=$datas;


echo json_encode($arr, JSON_UNESCAPED_UNICODE);


/*
 * 解析list
        "PIName",       职位名称
        "PIRegTime",    职位发布时间
        "PIWage",    工资
        "PIWorkPlace",   工作地
        "PILowEdu",       最低学历
        "PIExperience",    有无经验
        "CIName",     公司名称
        "CIIndustry",   公司行业
        "CIProperty",    公司性质
        "CIScale"    公司规模
 */
