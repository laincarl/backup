<?php
require 'connect.php';
$CIID=$_POST['CIID'];    //公司ID
//$CIID="1";    //公司ID
$datas=$database->select("tblcompanydynamic",[
    "[><]tblcompanyinfo"=>["CD_fk_CIID"=>"CIID"]
],[
    "CIName",
    "CDContent",
    "CDTime(Time)"
],[
    "CD_fk_CIID"=>$CIID,
    "ORDER" => ["tblcompanydynamic.CDTime" => "DESC"]
]);

$datas1=$database->select("tblcompanyinfo",[
    "[><]tblpositioninfo"=>["CIID"=>"PI_fk_CIID"]
],[
    "CIName",
    "PIName",
    "PIClass",
    "PIWorkPlace",
    "PIWage",
    "PIRegTime(Time)"

],[
    "CIID"=>$CIID,
    "ORDER" => ["tblpositioninfo.PIRegTime" => "DESC"]
]);

$list=array_merge($datas,$datas1);

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