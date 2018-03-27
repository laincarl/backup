<?php
//插入连接数据库的相关信息
require_once 'connectvars.php';

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "SELECT * FROM news limit 10 offset 0";
$data = mysqli_query($dbc,$query);
        //定义数组
//$arr=array('city'=>array('北京','上海','广州'),'order'=>array(1,2,3));

  //将数组转换为json格式
//echo json_encode($arr);
$id=array();
$title=array();
$dates=array();
$contents=array();
$author=array();
$i=0;
while($row = mysqli_fetch_array($data)){
	$id[$i]=$row['id'];
	$title[$i]=$row['title'];
	$dates[$i]=$row['dates'];
	$contents[$i]=$row['contents'];
	$author[$i]=$row['author'];
	$i++;
}

echo json_encode(array('id'=>$id,'title'=>$title,'dates'=>$dates,'contents'=>$contents,'author'=>$author));
?>