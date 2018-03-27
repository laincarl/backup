<?php
//插入连接数据库的相关信息
require_once 'connectvars.php';
//开启一个会话
session_start();

//为了长时间保存PHPSESSID的cookie
isset($PHPSESSID) ? session_id($PHPSESSID) : $PHPSESSID = session_id();
// 如果设置了$PHPSESSID，就将SessionID赋值为$PHPSESSID，否则生成SessionID
setcookie('PHPSESSID', $PHPSESSID, time() + 3156000); // 储存SessionID到Cookie中

//echo session_id();
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['password'])) {
//用户提交登录表单时执行如下代码
        $dbc           = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        if (!empty($user_username) && !empty($user_password)) {
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT id, username FROM user WHERE username = '$user_username' AND " . "password = '$user_password'";
            $data  = mysqli_query($dbc, $query);
            //用用户名和密码进行查询，若查到的记录正好为一条，则设置SESSION和COOKIE，同时进行页面重定向
            if (mysqli_num_rows($data) == 1) {
                $row                  = mysqli_fetch_array($data);
                $_SESSION['user_id']  = $row['id'];
                $_SESSION['username'] = $row['username'];
                setcookie('user_id', $row['id'], time() + (60 * 60 * 24 * 30));
                setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));
                echo json_encode(array('status' => 200, 'msg' => "登录成功"));
            } else {
//若查到的记录不对，则设置错误信息
                echo json_encode(array('status' => 300, 'msg' => "用户名或密码错误"));
            }
        } else {
            echo ('Sorry, you must enter a valid username and password to log in.');
        }
    } else {
            echo json_encode(array('status' => 301, 'msg' => "自动登录失败"));
    }
} else {
//如果用户已经登录，则直接跳转到已经登录页面
    echo json_encode(array('id' => $_SESSION['user_id'], 'username' => $_SESSION['username'], 'status' => 400, 'msg' => "已经登录"));
    //$home_url = 'loged.php';
    //header('Location: '.$home_url);
}
