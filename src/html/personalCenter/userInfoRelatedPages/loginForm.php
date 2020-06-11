<!DOCTYPE html>
<html lang="en">
<head>
    <title>中间页面</title>
</head>
<body>
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
$password = $_POST['password'];
function SHA256Hex($str){
    $re=hash('sha256', $str,true);
    return bin2hex($re);
}

function checkPassword($userName, $password)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($link, DB_NAME);
    mysqli_set_charset($link, "utf8");

    $query = "select UserName,Pass from traveluser where UserName = '$userName';";
    $result = mysqli_query($link, $query);
    mysqli_close($link);

    if ($result == null)
        return false;
    else
    {
        $correctHashedPass = mysqli_fetch_assoc($result)['Pass'];
        $inputHashedPass = SHA256Hex(($userName . $password));
        return ($correctHashedPass == $inputHashedPass);
    }
}
$password_sha256=SHA256Hex($password);
$query = "select * from traveluser where UserName='" . $userName . "';";
$result = mysqli_query($link, $query);
if (($userInfoArray = mysqli_fetch_assoc($result)) == null)
{
    mysqli_close($link);
    echo "<script>window.location.href='login.php';alert('用户不存在！请确认用户名是否正确')</script>";
}
else
{
    if (checkPassword($userName,$password))
    {
        mysqli_close($link);
        setcookie("UID",$userInfoArray['UID'],time()+3600,'/');
        setcookie("userName",$userInfoArray['UserName'],time()+3600,'/');
        setcookie("password",$userInfoArray['Pass'],time()+3600,'/');
        echo "<script>window.location.href='../../navItems/browserPage.php';alert('登陆成功！');</script>";
    }
    else
    {
        mysqli_close($link);
        echo "<script>window.location.href='login.php';alert('密码错误！（密码是大小写敏感的）')</script>";
    }
}
?>
</body>
</html>