<?php
if (isset($_COOKIE['UID']))
{
    $uid=$_COOKIE['UID'];
    $imageID=$_GET['imageID'];

    $link = mysqli_connect("localhost", "xxx41", "asdfg142857");
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, "pj2");

    $query="insert into travelimagefavor (UID,ImageID) values ($uid,$imageID)";
    mysqli_query($link,$query);

    $query="select Favor from travelimage where ImageID=$imageID;";
    $favourTimes=mysqli_fetch_row(mysqli_query($link,$query))[0];
    $favourTimes+=1;
    $query="update travelimage set Favor=$favourTimes where ImageID=$imageID;";
    mysqli_query($link,$query);

    mysqli_close($link);

    echo "<script>window.location.href='../personalCenter/myFavourite.php'</script>";
}
else
    echo "<script>window.location.href='../personalCenter/login.php';alert('登陆超时，请重新登陆')</script>";
?>
