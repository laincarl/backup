<?php
require 'connect.php';
$CCID=$_POST['CCID'];    //公司评论ID
//$CCID="1";    //公司评论ID
$datas=$database->select("tblcompanyreply",[
    "[>]tblcompanyinfo"=>["CRPublish_fk_UID"=>"CI_fk_UID"],
    "[>]tblemployeeinfo"=>["CRPublish_fk_UID"=>"EI_fk_UID"]
],[
    "CRID",
    "CRContent",
    "CRPublish_fk_UID",
    "CRTime",
    "CIName",
    "CILogo",
    "EIName",
    "EIHeadPic"
],[
    "CR_fk_CCID"=>$CCID,
    "ORDER" => ["tblcompanyreply.CRTime" => "DESC"]
]);


$i=0;
foreach ($datas as $data) {
    $arr['list'][$i]['CRID'] = $data['CRID'];
    $arr['list'][$i]['CRContent'] = $data['CRContent'];
    $arr['list'][$i]['CRPublish_fk_UID'] = $data['CRPublish_fk_UID'];
    $arr['list'][$i]['CRTime'] = $data['CRTime'];
    if ($data['EIName'] == "") {
        $arr['list'][$i]['username'] = $data['CIName'];
        $arr['list'][$i]['headpic'] = $data['CILogo'];
    } else {
        $arr['list'][$i]['username'] = $data['EIName'];
        $arr['list'][$i]['headpic'] = $data['EIHeadPic'];
    }

    $i = $i + 1;
    $data1s=$database->select("tblcompanysecreply",[
        "[>]tblcompanyinfo"=>["CSRPublish_fk_UID"=>"CI_fk_UID"],
        "[>]tblemployeeinfo"=>["CSRPublish_fk_UID"=>"EI_fk_UID"]
    ],[
        "CSRID",
        "CSRContent",
        "CSRPublish_fk_UID",
        "CSRTime",
        "CIName",
        "CILogo",
        "EIName",
        "EIHeadPic"
    ],[
        "CSR_fk_CRID"=>$data['CRID'],
        "ORDER" => ["tblcompanysecreply.CSRTime" => "DESC"]
    ]);
    foreach ($data1s as $data1) {
        $arr['list'][$i]['CSRID'] = $data1['CSRID'];
        $arr['list'][$i]['CSRContent'] = $data1['CSRContent'];
        $arr['list'][$i]['CSRPublish_fk_UID'] = $data1['CSRPublish_fk_UID'];
        $arr['list'][$i]['CSRTime'] = $data1['CSRTime'];
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
    "CRID",            一级回复ID
    "CRContent",         内容
    "CRPublish_fk_UID",   UID
    "CCTime",            评论时间
    "username",          用户名
    "headpic",            头像


        "CSRID",           一级回复ID
        "CSRContent",        内容
        "CSRPublish_fk_UID",    UID
    "CSRTime",            评论时间
    "username",          用户名
    "headpic",            头像

注：混在一起返回的    = =  就是一级回复后面跟着这个一级回复的所有二级回复，但是字段名称不一样
 */

