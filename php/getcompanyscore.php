<?php
require 'connect.php';

$CS_fk_EIID=$_POST["EIID"];           //求职者ID
$CS_fk_CIID=$_POST["CIID"];           //公司ID


//$CS_fk_EIID="1";
//$CS_fk_CIID="1";

$avgCSzhiyechengzhang = $database->avg("tblcompanyscore", "CSzhiyechengzhang",  [
    "AND"=>[
        "CS_fk_EIID"=> $CS_fk_EIID,
        "CS_fk_CIID"=> $CS_fk_CIID
    ],
]);

$avgCSjinengchengzhang = $database->avg("tblcompanyscore", "CSjinengchengzhang",  [
    "AND"=>[
        "CS_fk_EIID"=> $CS_fk_EIID,
        "CS_fk_CIID"=> $CS_fk_CIID
    ],
]);
$avgCSgongzuofenzuo = $database->avg("tblcompanyscore", "CSgongzuofenzuo",  [
    "AND"=>[
        "CS_fk_EIID"=> $CS_fk_EIID,
        "CS_fk_CIID"=> $CS_fk_CIID
    ],
]);
$avgCSgongzuoyali = $database->avg("tblcompanyscore", "CSgongzuoyali",  [
    "AND"=>[
        "CS_fk_EIID"=> $CS_fk_EIID,
        "CS_fk_CIID"=> $CS_fk_CIID
    ],
]);
$avgCSgongsiqianjing = $database->avg("tblcompanyscore", "CSgongsiqianjing",  [
    "AND"=>[
        "CS_fk_EIID"=> $CS_fk_EIID,
        "CS_fk_CIID"=> $CS_fk_CIID
    ],
]);
$arr['CSzhiyechengzhang']=round($avgCSzhiyechengzhang,1);
$arr['CSjinengchengzhang']=round($avgCSjinengchengzhang,1);
$arr['CSgongzuofenzuo']=round($avgCSgongzuofenzuo,1);
$arr['CSgongzuoyali']=round($avgCSgongzuoyali,1);
$arr['CSgongsiqianjing']=round($avgCSgongsiqianjing,1);


echo json_encode($arr, JSON_UNESCAPED_UNICODE);

/*
CSzhiyechengzhang
CSjinengchengzhang
CSgongzuofenzuo
CSgongzuoyali
CSgongsiqianjing

各一位小数
 */
