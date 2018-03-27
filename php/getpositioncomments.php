<?php
require 'connect.php';
$PIID=$_POST['PIID'];    //职位ID
$EIID=$_POST['EIID'];    //求职者ID
//$PIID="1";    //职位ID
//$EIID="1";    //求职者ID
$datas=$database->select("tblpositioncomment",[
    "[>]tblcompanyinfo"=>["PCPublish_fk_UID"=>"CI_fk_UID"],
    "[>]tblemployeeinfo"=>["PCPublish_fk_UID"=>"EI_fk_UID"]
],[
    "PCID",
    "PCContent",
    "PCPublish_fk_UID",
    "PCTime",
    "CIName",
    "CILogo",
    "EIName",
    "EIHeadPic"
],[
    "PC_fk_PIID"=>$PIID,
    "ORDER" => ["tblpositioncomment.PCTime" => "DESC"]
]);
$i=0;
foreach ($datas as $data){
    $arr['list'][$i]['PCID']=$data['PCID'];
    $arr['list'][$i]['PCContent']=$data['PCContent'];
    $arr['list'][$i]['PCPublish_fk_UID']=$data['PCPublish_fk_UID'];
    $arr['list'][$i]['PCTime']=$data['PCTime'];
    if($data['EIName']==""){
        $arr['list'][$i]['username']=$data['CIName'];
        $arr['list'][$i]['headpic']=$data['CILogo'];
    }else{
        $arr['list'][$i]['username']=$data['EIName'];
        $arr['list'][$i]['headpic']=$data['EIHeadPic'];
    }


    $datas1=$database->has("tblpraisepc",[
        "AND"=>[
            "PPC_fk_PCID"=>$data['PCID'],
            "PPC_fk_EIID"=>$EIID

        ]
    ]);

    $arr['list'][$i]['haspraiseornot']=$datas1;


    $datas2=$database->count("tblpraisepc",[
        "PPC_fk_PCID"=>$data['PCID']
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
    "PCID",      职位评论ID
    "PCContent",    内容
    "PCPublish_fk_UID",   评论者UID
    "PCTime",            评论时间
    "username",          用户名
    "headpic",            头像
haspraiseornot    该条评论该求职者是否点赞   true 点赞了    false 未点赞

praisenum         该条评论点赞数目
 */

