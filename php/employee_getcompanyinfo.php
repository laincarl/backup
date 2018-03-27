<?php
require 'connect.php';

$CIID=$_POST["CIID"];  //用户ID
//$CIID="10";
$datas=$database->select("tblcompanyinfo",[
    "[>]tbluser"=>["CI_fk_UID"=>"UID"]
],[
    "CIID",
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
    "CIID"=>$CIID
]);

foreach ($datas as $data){
    $arr['CIID']=$data['CIID'];
    $arr['CIName']=$data['CIName'];
    $arr['CIOtherName']=$data['CIOtherName'];
    $arr['CILogo']=$data['CILogo'];
    $arr['CIIndustry']=$data['CIIndustry'];
    $arr['CIProperty']=$data['CIProperty'];
    $arr['CIScale']=$data['CIScale'];
    $arr['CIBLR_num']=$data['CIBLR_num'];
    $arr['CIBLR_pic']=$data['CIBLR_pic'];
    $arr['CIIntro']=$data['CIIntro'];
    $arr['CILinkName']=$data['CILinkName'];
    $arr['CILinkPhone']=$data['CILinkPhone'];
    $arr['CIWebsite']=$data['CIWebsite'];
    $arr['CIWelfare']=$data['CIWelfare'];
    $arr['CIEnvirPics']=$data['CIEnvirPics'];
    $arr['CIProCityAddress']=$data['CIProCityAddress'];
    $arr['CISpecificAddress']=$data['CISpecificAddress'];
    $arr['CILongitude']=$data['CILongitude'];
    $arr['CILatitude']=$data['CILatitude'];
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}


/*
UEmail    邮箱
UID           用户ID
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
 */