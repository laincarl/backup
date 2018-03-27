<?php
require 'connect.php';
$CIName=$_POST["CIName"];           //公司名称
$CIOtherName=$_POST["CIOtherName"];           //公司别称
$CIIndustry=$_POST["CIIndustry"];           //所属行业
$CIProperty=$_POST["CIProperty"];           //公司性质
$CIScale=$_POST["CIScale"];           //公司规模
$CIBLR_num=$_POST["CIBLR_num"];           //营业执照注册号
$CIIntro=$_POST["CIIntro"];           //公司简介
$CILinkName=$_POST["CILinkName"];           //联系人
$CILinkPhone=$_POST["CILinkPhone"];           //招聘电话
$CIWebsite=$_POST["CIWebsite"];           //公司网址
$CIWelfare=$_POST["CIWelfare"];           //公司福利
$CIProCityAddress=$_POST["CIProCityAddress"];           //公司省市地址   如：北京市-北京市   河北省-廊坊市
$CISpecificAddress=$_POST["CISpecificAddress"];           //公司具体地址
$CILongitude=$_POST["CILongitude"];           //经度
$CILatitude=$_POST["CILatitude"];           //纬度

$uid=$_POST["UID"];

$update_text=$database->update("tblcompanyinfo",[
    "CIName"=> $CIName,
    "CIOtherName"=> $CIOtherName,
    "CIIndustry"=> $CIIndustry,
    "CIProperty"=> $CIProperty,
    "CIScale"=> $CIScale,
    "CIBLR_num"=> $CIBLR_num,
    "CIIntro"=> $CIIntro,
    "CILinkName"=> $CILinkName,
    "CILinkPhone"=> $CILinkPhone,
    "CIWebsite"=> $CIWebsite,
    "CIWelfare"=> $CIWelfare,
    "CIProCityAddress"=> $CIProCityAddress,
    "CISpecificAddress"=> $CISpecificAddress,
    "CILongitude"=> $CILongitude,
    "CILatitude"=> $CILatitude,
],[
    "CI_fk_UID"=>$uid
]);



if($update_text){
    $arr['message']="1";   // 更新成功
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}else{
    $arr['message']="0";   // 更新失败
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}



/*
 * message 1:更新成功    0更新失败
 */