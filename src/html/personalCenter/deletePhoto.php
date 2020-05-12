<?php
if (isset($_COOKIE['UID']))
{
    $dir = dirname(__FILE__);
    $folderPath = str_replace("src\\html\\personalCenter", "sources\\img\\travel-images\\normal\\medium\\", $dir);
    $deleteImgID = $_GET['imageID'];

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
        echo "<script>window.location.href='userInfoRelatedPages/login.php';alert('登陆信息错误，请重新登陆')</script>";
    }
    else
    {
        $query = "select PATH from travelimage where ImageID=$deleteImgID ;";
        $fileName = mysqli_fetch_row(mysqli_query($link, $query))[0];

        unlink($folderPath . $fileName);

        $query = "delete from travelimage where ImageID=$deleteImgID ;";
        mysqli_query($link, $query);

        $query = "delete from travelimagefavor where ImageID= $deleteImgID ;";
        mysqli_query($link,$query);

        mysqli_close($link);

        echo "<script>window.location.href='myPhotos.php'</script>";
    }
}
else
    echo "<script>window.location.href='./userInfoRelatedPages/login.php';alert('登陆超时，请重新登陆')</script>"
?>