<?php
if (isset($_COOKIE['UID']))
{
    $uid = $_COOKIE['UID'];
    $imageID = $_GET['imageID'];

    $dir = dirname(__FILE__);
    $indexOfL=strpos($dir,"src\\html")+8;
    $dir=substr($dir,0,$indexOfL)."\\configPHP.php";
    require $dir;
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($link, DB_NAME);
    mysqli_set_charset($link, "utf8");
    $uid=$_COOKIE['UID'];
    $password_sha256=$_COOKIE['password'];
    $query = "select * from traveluser where UID= $uid and Pass = '$password_sha256' ;";
    $result = mysqli_query($link, $query);
    if (mysqli_fetch_array($result) == null)
    {
        mysqli_close($link);
        echo "<script>window.location.href='login.php';alert('登陆信息错误，请重新登陆')</script>";
    }
    else
    {
        $query = "insert into travelimagefavor (UID,ImageID) values ($uid,$imageID)";
        mysqli_query($link, $query);

        $query = "select Favor from travelimage where ImageID=$imageID;";
        $favourTimes = mysqli_fetch_row(mysqli_query($link, $query))[0];
        $favourTimes += 1;
        $query = "update travelimage set Favor=$favourTimes where ImageID=$imageID;";
        mysqli_query($link, $query);

        mysqli_close($link);

        echo "<script>window.location.href='../personalCenter/myFavourite.php'</script>";
    }
}
else
    echo "<script>window.location.href='../personalCenter/login.php';alert('登陆超时，请重新登陆')</script>";
?>
