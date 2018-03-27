<?php
require 'connect.php';

$PIID=$_POST["PIID"];  //职位ID
$EIID=$_POST["EIID"];  //求职者ID


//$PIID="1";
//$EIID="1";

$datas=$database->select("tblpositioninfo",[
    "[><]tblcompanyinfo"=>["PI_fk_CIID"=>"CIID"]
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
    "CIName",
    "CIOtherName",
    "CILogo",
    "CIIndustry",
    "CIProperty",
    "CIScale",
    "CIBLR_num",
    "CIBLR_pic",
    "CIIntro",
    "CILinkName",
    "CILinkPhone",
    "CIWebsite",
    "CIWelfare",
    "CIEnvirPics",
    "CIProCityAddress",
    "CISpecificAddress",
    "CILongitude",
    "CILatitude"
],[
    "PIID"=>$PIID
]);

$arr['list_info']=$datas;

$arr['commitornot']=$database->has("tblresume",[
    "AND"=>[
        "R_fk_EIID"=>$EIID,
        "R_fk_PIID"=>$PIID
    ]

]);


$datas2=$database->select("tblpositioninfo",[
    "[><]tblcompanyinfo"=>["PI_fk_CIID"=>"CIID"]
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
    "CIName",
    "CIOtherName",
    "CILogo",
    "CIIndustry",
    "CIProperty",
    "CIScale",
    "CIBLR_num",
    "CIBLR_pic",
    "CIIntro",
    "CILinkName",
    "CILinkPhone",
    "CIWebsite",
    "CIWelfare",
    "CIEnvirPics",
    "CIProCityAddress",
    "CISpecificAddress",
    "CILongitude",
    "CILatitude"
],[
    "AND"=>[
        "PIClass[~]"=>$arr['PIClass'],
        "PIWorkPlace[~]"=>$arr['PIWorkPlace']
    ]

]);
$arr['list_recommondposition']=$datas2;



$datas1=$database->select("tblpositioninfo",[
    "[><]tblcompanyinfo"=>["PI_fk_CIID"=>"CIID"]
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
    "PIEndTime"
],[
    "PI_fk_CIID"=>$arr['CIID']
]);
$arr['list_companyposition']=$datas1;


echo json_encode($arr, JSON_UNESCAPED_UNICODE);
/*
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

CIName                   //公司名称
CIOtherName                   //公司别称
Old_CILogo                    //公司logo  上一个文件名
CIIndustry                   //所属行业
CIProperty                   //公司性质
CIScale                   //公司规模
CIBLR_num                   //营业执照注册号
Old_CIBLR_pic                     //营业执照   上一个文件名
CIIntro                   //公司简介
CILinkName                   //联系人
CILinkPhone                   //招聘电话
CIWebsite                   //公司网址
CIWelfare                   //公司福利
Old_CIEnvirPics                   //公司图片   上一个文件名
CIProCityAddress                   //公司省市地址   如：北京市-北京市   河北省-廊坊市
CISpecificAddress                   //公司具体地址
CILongitude                   //经度
CILatitude                   //纬度

commitornot        true  申请了    false  未申请

list_info    公司职位所有信息
list_companyposition   公司的所有职位， 属性在上面，随便挑
list_recommondposition   推荐的职位，属性在上面，随便挑
 */