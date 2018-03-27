<?php
require 'connect.php';
$CColl_fk_EIID=$_POST["EIID"];           //求职者ID
$CColl_fk_CIID=$_POST["CIID"];           //公司ID
$coll_type=$_POST["coll_type"];           //  0添加收藏    1删除收藏

//$CColl_fk_EIID="1";           //求职者ID
//$CColl_fk_CIID="2";           //公司ID
//$coll_type="1";           //  0添加收藏   1删除收藏


$result=0;

if($coll_type=="0"){
    $result=$database->insert("tblcompanycoll",[
        "CColl_fk_EIID"=> $CColl_fk_EIID,
        "CColl_fk_CIID"=> $CColl_fk_CIID
    ]);
}else{
    $result=$database->delete("tblcompanycoll",[
        "AND"=>[
            "CColl_fk_EIID"=> $CColl_fk_EIID,
            "CColl_fk_CIID"=> $CColl_fk_CIID
        ]

    ]);
}

if($result){
    $arr['message']="1";   // 发送成功
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}else{
    $arr['message']="0";   // 发送失败
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}

/*
 * message  1删除成功     0删除失败
 */