<?php
require 'connect.php';
$EIID=$_POST['EIID'];    //求职者ID
//$EIID="1";    //求职者ID
$datas=$database->select("tblcompanycoll",[
    "[><]tblcompanyinfo"=>["CColl_fk_CIID"=>"CIID"],
    "[><]tblcompanydynamic"=>["CColl_fk_CIID"=>"CD_fk_CIID"]
],[
    "CIName",
    "CDContent",
    "CDTime(Time)"
],[
    "CColl_fk_EIID"=>$EIID,
    "ORDER" => ["tblcompanydynamic.CDTime" => "DESC"]
]);
//$arr['list_dynamic']=$datas;

$datas1=$database->select("tblcompanycoll",[
    "[><]tblcompanyinfo"=>["CColl_fk_CIID"=>"CIID"],
    "[><]tblpositioninfo"=>["tblcompanyinfo.CIID"=>"PI_fk_CIID"]
],[
    "CIName",
    "PIName",
    "PIClass",
    "PIWorkPlace",
    "PIWage",
    "PIRegTime(Time)"

],[
    "CColl_fk_EIID"=>$EIID,
    "ORDER" => ["tblpositioninfo.PIRegTime" => "DESC"]
]);
//$arr['list_position']=$datas1;
$list=array_merge($datas,$datas1);
//var_dump($list);
$sort = array(
    'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
    'field'     => 'Time',       //排序字段
);
$arrSort = array();
foreach($list AS $uniqid => $row){
    foreach($row AS $key=>$value){
        $arrSort[$key][$uniqid] = $value;
    }
}
if($sort['direction']){
    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $list);
}

$arr['list']=$list;
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
/*解析list
第一种：动态
    "CIName",
    "CDContent",
    "Time"

第二种：职位
    "CIName",
    "PIName",
    "PIClass",
    "PIWorkPlace",
    "PIWage",
    "Time"

 */