<?php
require 'connect.php';

$EIID=$_POST["EIID"];  //用户ID
//$EIID="1";
$datas=$database->select("tblemployeeinfo",[
    "EIOrder_City",
    "EIOrder_Position"
],[
    "EIID"=>$EIID
]);

foreach ($datas as $data){

    $City=array_filter(explode ("#", $data['EIOrder_City']));
    $Position=array_filter(explode ("#", $data['EIOrder_Position']));

    foreach($City as $key => $value)
    {
        $data1s=$database->select("tblpositioninfo",[
            "[><]tblcompanyinfo"=>["PI_fk_CIID"=>"CIID"]
        ],[
            "PIName",
            "PIRegTime",
            "PIWage",
            "PIWorkPlace",
            "PILowEdu",
            "PIExperience",
            "CIName",
            "CIIndustry",
            "CIProperty",
            "CIScale"
        ],[
            "AND"=>[
                "PIWorkPlace[~]"=>$value,
                "PIName[~]"=>$Position[$key]
            ]

        ]);
    }
    $arr['list']=$data1s;


    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}


/*
 * 解析list
        "PIName",       职位名称
        "PIRegTime",    职位发布时间
        "PIWage",    工资
        "PIWorkPlace",   工作地
        "PILowEdu",       最低学历
        "PIExperience",    有无经验
        "CIName",     公司名称
        "CIIndustry",   公司行业
        "CIProperty",    公司性质
        "CIScale"    公司规模
 */
