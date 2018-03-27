<?php
require 'connect.php';
$PPC_fk_EIID=$_POST["EIID"];           //求职者ID
$PPC_fk_PCID=$_POST["PCID"];           //职位评论ID
$praise_type=$_POST["praise_type"];           //  0添加赞    1删除赞

//$PPC_fk_EIID="1";           //求职者ID
//$PPC_fk_PCID="2";           //职位ID
//$praise_type="1";           //  0添加赞    1删除赞


$result=0;

if($praise_type=="0"){
    $result=$database->insert("tblpraisepc",[
        "PPC_fk_EIID"=> $PPC_fk_EIID,
        "PPC_fk_PCID"=> $PPC_fk_PCID
    ]);
}else{
    $result=$database->delete("tblpraisepc",[
        "AND"=>[
            "PPC_fk_EIID"=> $PPC_fk_EIID,
            "PPC_fk_PCID"=> $PPC_fk_PCID
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