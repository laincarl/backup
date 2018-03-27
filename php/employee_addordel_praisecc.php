<?php
require 'connect.php';
$PCC_fk_EIID=$_POST["EIID"];           //求职者ID
$PCC_fk_CCID=$_POST["CCID"];           //职位评论ID
$praise_type=$_POST["praise_type"];           //  0添加赞    1删除赞

//$PCC_fk_EIID="1";           //求职者ID
//$PCC_fk_CCID="2";           //职位ID
//$praise_type="1";           //  0添加赞    1删除赞


$result=0;

if($praise_type=="0"){
    $result=$database->insert("tblpraisecc",[
        "PCC_fk_EIID"=> $PCC_fk_EIID,
        "PCC_fk_CCID"=> $PCC_fk_CCID
    ]);
}else{
    $result=$database->delete("tblpraisecc",[
        "AND"=>[
            "PCC_fk_EIID"=> $PCC_fk_EIID,
            "PCC_fk_CCID"=> $PCC_fk_CCID
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