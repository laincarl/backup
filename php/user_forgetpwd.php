<?php
require 'connect.php';
$email = trim($_POST['email']);     //注册邮箱
//$email = trim("2045526030@qq.com");
$email_has_or_not=$database->has("tbluser", [
    "UEmail" => $email
]);
if(!$email_has_or_not){
    $arr['message']="1";   // 邮箱未注册
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    exit();
}else{
    $code=randCode();
    $token_exptime = time()+60*10;

    require_once "email.class.php";
    $smtpserver = "smtp.163.com"; //SMTP服务器
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "debrahe@163.com"; //SMTP服务器的用户邮箱
    $smtpuser = "debrahe@163.com"; //SMTP服务器的用户帐号
    $smtppass = "xiaohe123456"; //SMTP服务器的用户密码

    $smtpemailto = $email;//发送给谁
    $mailtitle = "Offer100-用户修改密码";//邮件主题
    $mailcontent = "亲爱的".$email."：<br/>感谢您使用我们的网站。<br/>您修改密码请求的验证码为<br/><h1>$code</h1><br/>请将它复制到您的修改密码操作界面，该验证码10分钟内有效。<br/>如果此次修改密码请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Offer100 敬上</p>";//邮件内容
    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = false;//是否显示发送的调试信息
    $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

    if($state==""){
        $arr['message']="2";   // 邮件发送失败，点击按钮重新发送邮件
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        exit();
    }else{
        $result=$database->update("tbluser",[
            "UCode"=>$code,
            "UToken_exptime"=>$token_exptime
        ],[
            "UEmail"=>$email
        ]);
        if($result){
            $arr['message']="3";   // 邮件发送成功，请60秒后再次发送
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        }else{
            $arr['message']="4";   // 邮件发送成功，数据更新失败，请重新发送邮件
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        }

    }
}



function randCode($len=6,$format='NUMBER'){
    $is_abc = $is_numer = 0;
    $code = $tmp ='';
    switch($format){
        case 'ALL':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'CHAR':
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'NUMBER':
            $chars='0123456789';
            break;
        default :
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }
    mt_srand((double)microtime()*1000000*getmypid());
    while(strlen($code)<$len){
        $tmp =substr($chars,(mt_rand()%strlen($chars)),1);
        if(($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 )|| $format == 'CHAR'){
            $is_numer = 1;
        }
        if(($is_abc <> 1 && preg_match('/[a-zA-Z]/',$tmp)) || $format == 'NUMBER'){
            $is_abc = 1;
        }
        $code.= $tmp;
    }
    if($is_numer <> 1 || $is_abc <> 1 || empty($code) ){
        $code = randpw($len,$format);
    }
    return $code;
}


/*
 * message   1:邮箱未注册     2:邮件发送失败，点击按钮重新发送邮件    3:邮件发送成功，请60秒后再次发送          4：邮件发送成功，数据更新失败，请重新发送邮件
 */