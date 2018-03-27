<?php
require 'connect.php';
$CIID=$_POST['CIID'];    //公司ID
$EIID=$_POST['EIID'];    //求职者ID
//$CIID="1";    //公司ID
//$EIID="1";    //公司ID
$datas=$database->select("tblcompanycomment",[
    "[>]tblcompanyinfo"=>["CCPublish_fk_UID"=>"CI_fk_UID"],
    "[>]tblemployeeinfo"=>["CCPublish_fk_UID"=>"EI_fk_UID"]
],[
    "CCID",
    "CCContent",
    "CCPublish_fk_UID",
    "CCTime",
    "CIName",
    "CILogo",
    "EIName",
    "EIHeadPic"
],[
    "CC_fk_CIID"=>$CIID,
    "ORDER" => ["tblcompanycomment.CCTime" => "DESC"]
]);
$i=0;
foreach ($datas as $data){
    $arr['list'][$i]['CCID']=$data['CCID'];
    $arr['list'][$i]['CCContent']=$data['CCContent'];
    $arr['list'][$i]['CCPublish_fk_UID']=$data['CCPublish_fk_UID'];
    $arr['list'][$i]['CCTime']=$data['CCTime'];
    if($data['EIName']==""){
        $arr['list'][$i]['username']=$data['CIName'];
        $arr['list'][$i]['headpic']=$data['CILogo'];
    }else{
        $arr['list'][$i]['username']=$data['EIName'];
        $arr['list'][$i]['headpic']=$data['EIHeadPic'];
    }


    $datas1=$database->has("tblpraisecc",[
        "AND"=>[
            "PCC_fk_CCID"=>$data['CCID'],
            "PCC_fk_EIID"=>$EIID

        ]
    ]);

    $arr['list'][$i]['haspraiseornot']=$datas1;


    $datas2=$database->count("tblpraisecc",[
            "PCC_fk_CCID"=>$data['CCID']
    ]);

    $arr['list'][$i]['praisenum']=$datas2;

    $i=$i+1;




//    $datas1=$database->select("tblcompanyreply",[
//        "[><]tblcompanysecreply"=>["CRID"=>"CSR_fk_CRID"],
//        "[>]tblcompanyinfo"=>["CRPublish_fk_UID"=>"CI_fk_UID"],
//        "[>]tblemployeeinfo"=>["CRPublish_fk_UID"=>"EI_fk_UID"]
//    ],[
//        "CIName",
//        "CILogo",
//        "EIName",
//        "EIHeadPic"
//    ],[
//        "CC_fk_CIID"=>$data['CCID'],
//        "ORDER" => ["tblcompanycomment.CCTime" => "DESC"]
//    ]);
//
//    $arr['list'][$data['CCID']]=$datas1;
}
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
/*解析list
    "CCID",      公司评论ID
    "CCContent",    内容
    "CCPublish_fk_UID",   评论者UID
    "CCTime",            评论时间
    "username",          用户名
    "headpic",            头像
haspraiseornot    该条评论该求职者是否点赞   true 点赞了    false 未点赞

praisenum         该条评论点赞数目
 */

