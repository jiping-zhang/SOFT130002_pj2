<html>
<body>
<div style="display: none">
<p>
    <?php

    $emailAddress=$_POST['emailAddress'];

    $dir=dirname(__FILE__);
    $mailFolderDir=$dir."\\PHPMailer";
    $classMailerDir=$mailFolderDir."\\class.phpmailer.php";
    $classSmtpDir=$mailFolderDir."\\class.smtp.php";

    require $classMailerDir;
    require $classSmtpDir;

    $dir = dirname(__FILE__);
    $indexOfL=strpos($dir,"src\\html")+8;
    $dir=substr($dir,0,$indexOfL)."\\configPHP.php";
    require $dir;
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($link, DB_NAME);
    mysqli_set_charset($link, "utf8");

    $query = "select * from traveluser where UserName='" . $emailAddress . "';";
    $result = mysqli_query($link, $query);
    if (mysqli_fetch_array($result) == null)
    {
        echo "<script>window.close();alert('该用户名（".$emailAddress."）不存在')</script>";
    }
    else
    {
        $captchaNumber=rand(100000,999999);

        session_start();
        $_SESSION[$emailAddress]=$captchaNumber;
// 实例化PHPMailer核心类
        $mail = new PHPMailer();

// 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 1;

// 使用smtp鉴权方式发送邮件
        $mail->isSMTP();

// smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;

// 链接qq域名邮箱的服务器地址
        $mail->Host = EMAIL_HOST;

// 设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure = EMAIL_SMTPSECURE;

// 设置ssl连接smtp服务器的远程服务器端口号
        $mail->Port = SMTP_PORT;

// 设置发送的邮件的编码
        $mail->CharSet = 'UTF-8';

// 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = EMAIL_FORMNAME;

// smtp登录的账号 QQ邮箱即可
        $mail->Username = EMAIL_USERNAME;

// smtp登录的密码 使用生成的授权码
        $mail->Password = EMAIL_PASSWORD;

// 设置发件人邮箱地址 同登录账号
        $mail->From = EMAIL_USERNAME;

// 邮件正文是否为html编码 注意此处是一个方法
        $mail->isHTML(true);

// 设置收件人邮箱地址
        $mail->addAddress($emailAddress);

// 添加该邮件的主题
        $mail->Subject = '验证码';

// 添加邮件正文
        $mail->Body = '<p>'.$captchaNumber.'</p>';

// 为该邮件添加附件
//$mail->addAttachment('./example.pdf');

// 发送邮件 返回状态
        $status = $mail->send();
        echo "<script>window.close();alert('邮件发送成功，请查收验证邮件并返回重设密码')</script>";
    }

    //var_dump($_SESSION);
    ?>
</p>
</div>
</body>
</html>

