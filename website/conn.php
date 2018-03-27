<?php
@mysql_connect("localhost:3306","root","smartisan")or die("数据库链接失败");
@mysql_select_db("myweb")or die("db连接失败");
//mysql_query("set names 'gbk'");
?>
