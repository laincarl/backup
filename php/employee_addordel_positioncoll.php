<?php
require 'connect.php';
$PColl_fk_EIID=$_POST["EIID"];           //求职者ID
$PColl_fk_PIID=$_POST["PIID"];           //职位ID
$coll_type=$_POST["coll_type"];           //  0添加收藏    1删除收藏

//$PColl_fk_EIID="1";           //求职者ID
//$PColl_fk_PIID="2";           //职位ID
//$coll_type="1";           //  0添加赞    1删除赞


$result=0;

if($coll_type=="0"){
    $result=$database->insert("tblpositioncoll",[
        "PColl_fk_EIID"=> $PColl_fk_EIID,
        "PColl_fk_PIID"=> $PColl_fk_PIID
    ]);
}else{
    $result=$database->delete("tblpositioncoll",[
        "AND"=>[
            "PColl_fk_EIID"=> $PColl_fk_EIID,
            "PColl_fk_PIID"=> $PColl_fk_PIID
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