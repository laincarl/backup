
<?php
include("conn.php");
if(!empty($_POST['password'])){

	//$title=$_POST['title'];
	//$con=$_POST['con'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="insert into `user` (`username`,`password`) values ('$username','$password')";
	//echo $sql;
	mysql_query($sql);
	echo "注册成功";
}
?>