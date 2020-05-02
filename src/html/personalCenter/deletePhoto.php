<?php
if (isset($_COOKIE['UID']))
{
    $dir = dirname(__FILE__);
    $folderPath = str_replace("src\\html\\personalCenter", "sources\\img\\travel-images\\normal\\medium\\", $dir);
    $deleteImgID = $_GET['imageID'];

    $link = mysqli_connect("localhost", "xxx41", "asdfg142857");
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, "pj2");

    $query="select PATH from travelimage where ImageID=$deleteImgID ;";
    $fileName=mysqli_fetch_row(mysqli_query($link,$query))[0];

    unlink($folderPath.$fileName);

    $query="delete from travelimage where ImageID=$deleteImgID ;";
    mysqli_query($link,$query);

    $query="delete from travelimagefavor where ImageID= $deleteImgID ;";
    mysqli_query($link,$query);

    mysqli_close($link);

    echo "<script>window.location.href='myPhotos.php'</script>";
}
else
    echo "<script>window.location.href='./login.php';alert('登陆超时，请重新登陆')</script>"
?>