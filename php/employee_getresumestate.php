<?php
require 'connect.php';
$EIID=$_POST['EIID'];    //求职者ID
$type=$_POST['type'];    //0全部    1无反应    2已查看      3感兴趣    4不感兴趣

//
//$EIID="1";    //求职者ID
//$type="1";    //0全部    1无反应    2已查看      3感兴趣    4不感兴趣


if($type=="0"){
    $datas=$database->select("tblresume",[
        "[><]tblpositioninfo"=>["R_fk_PIID"=>"PIID"],
        "[><]tblcompanyinfo"=>["tblpositioninfo.PI_fk_CIID"=>"CIID"]
    ],[
        "RTime",
        "RState",
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
        "R_fk_EIID"=>$EIID,
        "ORDER" => ["tblresume.RTime" => "DESC"]
    ]);
   $arr['list']=$datas;
   echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}else{
    $datas=$database->select("tblresume",[
        "[><]tblpositioninfo"=>["R_fk_PIID"=>"PIID"],
        "[><]tblcompanyinfo"=>["tblpositioninfo.PI_fk_CIID"=>"CIID"]
    ],[
        "RTime",
        "RState",
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
            "R_fk_EIID"=>$EIID,
            "RState"=>$type
        ],
        "ORDER" => ["tblresume.RTime" => "DESC"]
    ]);
    $arr['list']=$datas;
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}

/*解析list
 *        "RTime",      发送简历的时间
        "RState",         简历状态  1无反应    2已查看      3感兴趣    4不感兴趣
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