<?php
require 'connect.php';
$EIID=$_POST['EIID'];    //求职者ID
//$EIID="1";    //求职者ID
$datas=$database->select("tblcompanycoll",[
    "[><]tblcompanyinfo"=>["CColl_fk_CIID"=>"CIID"]
],[
    "CCollID",
    "CIName",
    "CILogo",
    "CIIndustry",
    "CIProperty",
    "CIProCityAddress"
],[
    "CColl_fk_EIID"=>$EIID,
    "ORDER" => ["tblcompanycoll.CCollTime" => "DESC"]
]);
$arr['list']=$datas;
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
/*解析list
"CCollTime"    收藏时间
        "CIName",     公司名称
        "CIIndustry",   公司行业
        "CILogo",
        "CIProCityAddress"    公司地址
 */