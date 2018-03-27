<?php
//插入连接数据库的相关信息
require_once 'connectvars.php';

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query = "SELECT * FROM comments";
$data  = mysqli_query($dbc, $query);

//定义数组
//$arr=array('city'=>array('北京','上海','广州'),'order'=>array(1,2,3));

//将数组转换为json格式
//echo json_encode($arr);
//$articalid = $_GET['articalid'];

$i             = 0;
$page          = 1;
$total_pages   = 1;
$comment_exits = true;

$comments = array();

while ($row = mysqli_fetch_array($data)) {
    $children       = array();
    $child          = array();
    $id             = $row['id'];
    $username       = $row['username'];
    $floor          = $row['floor'];
    $dates          = $row['dates'];
    $content        = $row['content'];
    $children_count = $row['children_count'];
    $selec          = "select * from `comments_child` where `parent_id`='$id'";
    $data2          = mysqli_query($dbc, $selec);
    if ($children_count > 0) {
        $j = 0;
        while ($row2 = mysqli_fetch_array($data2)) {
            $child['id']        = $row2['id'];
            $child['parent_id'] = $row2['parent_id'];
            $child['content']   = $row2['content'];
            $child['dates']     = $row2['dates'];
            $child['username']  = $row2['username'];
            $children[$j]       = $child;
            unset($child);
            $j++;
        }

    }


$comments[$i] = array('id' => $id, 'username' => $username, 'floor' => $floor, 'dates' => $dates, 'content' => $content, 'children_count' => $children_count, 'children' => $children);
unset($children);
$i++;
}

//$sql1   = "select `comment_num` from `news` where `id`='$articalid'";
    //$result = mysql_query($sql1);
    //$row    = mysql_fetch_row($result);

    echo json_encode(array('page' => $page, 'total_pages' => $total_pages, 'comment_exits' => $comment_exits, 'comments' => $comments));
