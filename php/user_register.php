<?phprequire 'connect.php';$pwd = md5(trim($_POST['register_pwd']));    //注册密码$email = trim($_POST['register_email']);     //注册邮箱$is_employee_or_company = $_POST['register_identity'];    //用户身份：  0求职者   1公司//$pwd = md5(trim("hehehe"));//$email = trim("2045526030@qq.com");//$is_employee_or_company = "1";$email_has_or_not=$database->has("tbluser", [    "UEmail" => $email]);if($email_has_or_not){    $arr['message']="1";   // 该邮箱已注册    echo json_encode($arr, JSON_UNESCAPED_UNICODE);    exit();}else{    $regtime = time();    $token = md5($email.$pwd.$regtime); //创建用于激活识别码    $token_exptime = time()+60*60*24;    $insert_new_user_id = $database->insert("tbluser",[        "UEmail" =>$email,        "UPassword" =>$pwd,        "UToken" =>$token,        "UToken_exptime" =>$token_exptime,        "UIdentity" => $is_employee_or_company    ]);    if($insert_new_user_id){        require_once "email.class.php";        $smtpserver = "smtp.163.com"; //SMTP服务器        $smtpserverport = 25; //SMTP服务器端口        $smtpusermail = "debrahe@163.com"; //SMTP服务器的用户邮箱        $smtpuser = "debrahe@163.com"; //SMTP服务器的用户帐号        $smtppass = "xiaohe123456"; //SMTP服务器的用户密码        $smtpemailto = $email;//发送给谁        $mailtitle = "Offer100-用户帐号激活";//邮件主题        $mailcontent = "亲爱的".$email."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://120.76.120.85:8081/php/user_active.php?verify=".$token."' target='_blank'>http://120.76.120.85:8081/php/user_active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Offer100 敬上</p>";//邮件内容        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件        //************************ 配置信息 ****************************        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.        $smtp->debug = false;//是否显示发送的调试信息        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);        if($state==""){            $database->delete("tbluser",[                "UEmail" =>$email            ]);            $arr['message']="3";   // 邮件发送失败，请重新注册            echo json_encode($arr, JSON_UNESCAPED_UNICODE);        }else{            $arr['message']="4";   // 邮箱注册成功，请激活            echo json_encode($arr, JSON_UNESCAPED_UNICODE);        }    }else{        $arr['message']="2";   // 邮箱注册失败        echo json_encode($arr, JSON_UNESCAPED_UNICODE);        exit();    }}/* * message    1:该邮箱已注册    2:邮箱注册失败，请重新注册    3:邮件发送失败，请重新注册      4:邮箱注册成功，请激活 */