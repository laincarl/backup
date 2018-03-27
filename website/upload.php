<?php
if(isset($_FILES["myfile"]))
{
$ret = array();
//DIRECTORY_SEPARATOR代表一个分隔符，在win下是/，在linux下是\
$uploadDir = DIRECTORY_SEPARATOR.'p'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.date("Ymd").DIRECTORY_SEPARATOR;
//dirname(__FILE__)返回当前目录路径
$dir = dirname(__FILE__).DIRECTORY_SEPARATOR.$uploadDir;
//函数检查文件或目录是否存在
file_exists($dir) || (mkdir($dir,0777,true) && chmod($dir,0777));
if(!is_array($_FILES["myfile"]["name"])) //single file
{
$fileName = time().uniqid().'.'.pathinfo($_FILES["myfile"]["name"])['extension'];
//move_uploaded_file
move_uploaded_file($_FILES["myfile"]["tmp_name"],$dir.$fileName);
$ret=$uploadDir.$fileName;
}
echo $ret;
}
?>