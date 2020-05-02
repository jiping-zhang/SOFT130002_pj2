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
$link = mysqli_connect("localhost", "xxx41", "asdfg142857");
mysqli_set_charset($link, "utf8");
mysqli_select_db($link, "pj2");
//    $query="insert into userinfo(username,password) values("+($_POST['userName']+"")+","+($_POST['password']+"")+")";
$userName = $_POST['userName'];
$password = $_POST['password'];
$query="select * from traveluser where UserName='".$userName."'";
$result=mysqli_query($link,$query);
if(mysqli_fetch_array($result)==null)
{
    $query="insert into traveluser(UserName,Pass,State) values ('".$userName."','".$password."',1) ;";
//    echo $query;
    mysqli_query($link, $query);
    echo "<script>window.location.href='./login.php';alert('注册成功，请登陆')</script>";
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