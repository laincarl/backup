<?php
require 'connect.php';
$datas=$database->select("tblcampusemployer","*");
$arr['list']=$datas;
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
/*解析list
CEID          //校园招聘ID
CEName          //公司名称
CELogo          //公司logo
CECity          //公司所在城市    北京，上海
CETimeStart          //校招开始时间
CETimeEnd          //校招截止时间   可为空
CECompanyUrl          //公司校招url

 */