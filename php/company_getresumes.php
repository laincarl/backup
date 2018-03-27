<?php
require 'connect.php';
$CIID=$_POST['CIID'];    //公司ID
//$CIID="1";    //公司ID
$datas=$database->select("tblresume",[
    "[><]tblpositioninfo"=>["R_fk_PIID"=>"PIID"],
    "[><]tblemployeeinfo"=>["R_fk_EIID"=>"EIID"]
],[
    "RID",
    "EIName",
    "RTime",
    "RState",
    "PIName"
],[
    "tblpositioninfo.PI_fk_CIID"=>$CIID,
    "ORDER" => ["tblresume.RTime" => "DESC"]
]);
$arr['list']=$datas;
echo json_encode($arr, JSON_UNESCAPED_UNICODE);

/*解析list
 *        "RTime",      发送简历的时间
        "RState",         简历状态  1无反应    2已查看      3感兴趣    4不感兴趣
        "PIName",       职位名称
        "EIName",    求职者姓名
        "RID",    简历ID
 */