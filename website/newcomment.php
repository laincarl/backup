
<?php
include "conn.php";
//开启一个会话
session_start();
if (!empty($_POST['parent_id'])) {

    $parent_id = $_POST['parent_id'];
    /*if($parent_id=="null"){

    }
    else{

    }*/
    //$reply=$_POST['reply'];
    $content   = $_POST['content'];
    $articalid = $_POST['articalid'];
    $sql1      = "select `floor` from `news` where `id`='$articalid'";
    $result    = mysql_query($sql1);
    $row       = mysql_fetch_row($result);
    $floor     = $row[0]+1;

    $children_count = 0;
    $username       = $_SESSION['username'];

    $sql  = "insert into `comments` (`content`,`articalid`,`floor`,`dates`,`username`,`children_count`) values ('$content','$articalid','$floor',now(),'$username','$children_count')";
    $sql2 = "update news set `floor`=`floor`+1,`comment_num`=`comment_num`+1 where `id`='$articalid'";
    
    //echo $sql;
    if (mysql_query($sql)) {
        mysql_query($sql2);
        echo "评论成功";
    } else {
        echo mysql_errno() . ": " . mysql_error() . " ";
    }

}

?>