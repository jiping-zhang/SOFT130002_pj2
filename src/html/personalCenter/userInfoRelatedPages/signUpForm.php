<!DOCTYPE html>
<html lang="en">
<head>
    <title>中间页面</title>
</head>
<body>
<p>
    请等待，页面马上跳转
</p>
<?php
$dir = dirname(__FILE__);
$indexOfL=strpos($dir,"src\\html")+8;
$dir=substr($dir,0,$indexOfL)."\\configPHP.php";
require $dir;
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($link, DB_NAME);
mysqli_set_charset($link, "utf8");
//    $query="insert into userinfo(username,password) values("+($_POST['userName']+"")+","+($_POST['password']+"")+")";
$userName = $_POST['userName'];
$nickName=$_POST['nickName'];
$password = $_POST['password'];
$captchaNumber=$_POST['captchaNumber'];
function SHA256Hex($str){
    $re=hash('sha256', $str,true);
    return bin2hex($re);
}

function getHashedPassword($userName,$inputPassword)
{
    return SHA256Hex(($userName.$inputPassword));
}
$password_sha256=getHashedPassword($userName,$password);
$query = "select * from traveluser where UserName='" . $userName . "';";
$result = mysqli_query($link, $query);
if (mysqli_fetch_array($result) == null)
{
    session_start();
    if (isset($_SESSION[$userName]))
    {
        $correctCaptchaNumber=$_SESSION[$userName];
        if ((int)$captchaNumber==(int)$correctCaptchaNumber)
        {
            $query = "insert into traveluser(UserName,Pass,State,NickName) values ('" . $userName . "','" . $password_sha256 . "',1,'$nickName') ;";
            mysqli_query($link, $query);
            echo "<script>window.location.href='./login.php';alert('注册成功，请登陆')</script>";
        }
        else
        {
            echo "<p>邮箱验证码错误</p>";
            echo "<a href='signUp.html'>点击此处返回注册页面</a>";
        }
    }
    else
    {
        echo "<p>请先发送验证码到邮箱再注册</p>";
        echo "<a href='signUp.html'>点击此处返回注册页面</a>";
    }


/*    $query = "insert into traveluser(UserName,Pass,State) values ('" . $userName . "','" . $password_sha256 . "',1) ;";
    mysqli_query($link, $query);
    echo "<script>window.location.href='./login.php';alert('注册成功，请登陆')</script>";*/
}
else
{
    echo "<p>抱歉，这个用户名已经被占用了</p>";
    echo "<a href='signUp.html'>点击此处返回注册页面</a>";
}
mysqli_close($link);
?>

</body>
</html>