<?php
require 'connect.php';
$EIID=$_POST['EIID'];    //求职者ID
//$EIID="1";    //求职者ID
$datas=$database->select("tblpositioncoll",[
    "[><]tblpositioninfo"=>["PColl_fk_PIID"=>"PIID"],
    "[><]tblcompanyinfo"=>["tblpositioninfo.PI_fk_CIID"=>"CIID"]
],[
    "PCollID",
    "PCollTime",
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
    "PColl_fk_EIID"=>$EIID,
    "ORDER" => ["tblpositioncoll.PCollTime" => "DESC"]
]);
$arr['list']=$datas;
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
/*解析list
"PCollTime"    收藏时间
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