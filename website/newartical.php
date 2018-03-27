
<?php
include("conn.php");


if(!empty($_POST['con'])){

	$title=$_POST['title'];
	$con=$_POST['con'];
	//$title="你好";
	$html=$_POST['html'];
	$author=$_POST['author'];
	/*$log=fopen("log.txt","w"); 
	fwrite($log,$html); 
	fclose($log);*/
	//echo $con;
	$con=mb_substr($con,0,220,"utf-8");
	$encode = mb_detect_encoding($con, array('UTF-8','GB2312','GBK'));
	$sql="insert into `news` (`id`,`title`,`dates`,`contents`,`author`) values (null,'$title',now(),'$con','$author')";
	//echo $sql;
	if(mysql_query($sql)){
		//开始生成静态页面
		$id=mysql_insert_id();
		$fp=fopen("template.html","r");
		$str=fread($fp,filesize("template.html"));
		$str=str_replace("{id}",$id,$str);
		$str=str_replace("{title}",$title,$str);
		$str=str_replace("{content}",$html,$str);
		
		fclose($fp);
		//开始写
		$filename="p".DIRECTORY_SEPARATOR.$id.".html";
		$dir = dirname($filename);
		if(!is_dir($dir)){
			mkdir($dir);
		}
		$handle=fopen($filename,"w"); 
		fwrite($handle,$str); 
		fclose($handle);

		echo "success";
	}
	else{
		echo mysql_errno() . ": " . mysql_error() . " ";
	}

}

?>