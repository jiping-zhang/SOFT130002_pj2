<?php
$dir = dirname(__FILE__);
$mailFolderDir = $dir . "\\PHPMailer";
$classMailerDir = $mailFolderDir . "\\class.phpmailer.php";
$classSmtpDir = $mailFolderDir . "\\class.smtp.php";

require $classMailerDir;
require $classSmtpDir;
require "../../configPHP.php";

session_start();
$_SESSION[$emailAddress] = $captchaNumber;
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
$mail->addAddress("19302010022@fudan.edu.cn");

// 添加该邮件的主题
$mail->Subject = '对大佬的问候';

// 添加邮件正文
$mail->Body = '<h1>' . 'hcsnb!' . '</h1>';

// 为该邮件添加附件
//$mail->addAttachment('./example.pdf');

// 发送邮件 返回状态
for ($i = 0; $i < 5; $i++)
    $status = $mail->send();


//var_dump($_SESSION);
?>
