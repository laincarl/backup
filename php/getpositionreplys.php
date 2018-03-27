<?php
require 'connect.php';
$PCID=$_POST['PCID'];    //职位评论ID
//$PCID="1";    //职位评论ID
$datas=$database->select("tblpositionreply",[
    "[>]tblcompanyinfo"=>["PRPublish_fk_UID"=>"CI_fk_UID"],
    "[>]tblemployeeinfo"=>["PRPublish_fk_UID"=>"EI_fk_UID"]
],[
    "PRID",
    "PRContent",
    "PRPublish_fk_UID",
    "PRTime",
    "CIName",
    "CILogo",
    "EIName",
    "EIHeadPic"
],[
    "PR_fk_PCID"=>$PCID,
    "ORDER" => ["tblpositionreply.PRTime" => "DESC"]
]);


$i=0;
foreach ($datas as $data) {
    $arr['list'][$i]['PRID'] = $data['PRID'];
    $arr['list'][$i]['PRContent'] = $data['PRContent'];
    $arr['list'][$i]['PRPublish_fk_UID'] = $data['PRPublish_fk_UID'];
    $arr['list'][$i]['PRTime'] = $data['PRTime'];
    if ($data['EIName'] == "") {
        $arr['list'][$i]['username'] = $data['CIName'];
        $arr['list'][$i]['headpic'] = $data['CILogo'];
    } else {
        $arr['list'][$i]['username'] = $data['EIName'];
        $arr['list'][$i]['headpic'] = $data['EIHeadPic'];
    }

    $i = $i + 1;
    $data1s=$database->select("tblpositionsecreply",[
        "[>]tblcompanyinfo"=>["PSRPublish_fk_UID"=>"CI_fk_UID"],
        "[>]tblemployeeinfo"=>["PSRPublish_fk_UID"=>"EI_fk_UID"]
    ],[
        "PSRID",
        "PSRContent",
        "PSRPublish_fk_UID",
        "PSRTime",
        "CIName",
        "CILogo",
        "EIName",
        "EIHeadPic"
    ],[
        "PSR_fk_PRID"=>$data['PRID'],
        "ORDER" => ["tblpositionsecreply.PSRTime" => "DESC"]
    ]);

    foreach ($data1s as $data1) {
        $arr['list'][$i]['PSRID'] = $data1['PSRID'];
        $arr['list'][$i]['PSRContent'] = $data1['PSRContent'];
        $arr['list'][$i]['PSRPublish_fk_UID'] = $data1['PSRPublish_fk_UID'];
        $arr['list'][$i]['PSRTime'] = $data1['PSRTime'];
        if ($data1['EIName'] == "") {
            $arr['list'][$i]['username'] = $data1['CIName'];
            $arr['list'][$i]['headpic'] = $data1['CILogo'];
        } else {
            $arr['list'][$i]['username'] = $data1['EIName'];
            $arr['list'][$i]['headpic'] = $data1['EIHeadPic'];
        }



        $i = $i + 1;
    }


}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);

/*解析list
    "PRID",            一级回复ID
    "PRContent",         内容
    "PRPublish_fk_UID",   UID
    "PCTime",            评论时间
    "username",          用户名
    "headpic",            头像


        "PSRID",           一级回复ID
        "PSRContent",        内容
        "PSRPublish_fk_UID",    UID
    "PSRTime",            评论时间
    "username",          用户名
    "headpic",            头像

注：混在一起返回的    = =  就是一级回复后面跟着这个一级回复的所有二级回复，但是字段名称不一样
 */

