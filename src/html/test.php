<?php
$uid = $_COOKIE['UID'];

$link = mysqli_connect("localhost", "xxx41", "asdfg142857");
mysqli_set_charset($link, "utf8");
mysqli_select_db($link, "pj2");

$query = "select ImageID,Title,Description,PATH from travelimage ;";
$resultArray = mysqli_fetch_all(mysqli_query($link, $query), MYSQLI_ASSOC);

if (count($resultArray) == 0)
{
    echo '<li class="onePageInfo"><ul><li class="oneImgInfo"></li></ul></li>';
}
else
{
    for ($i = 0; $i < count($resultArray); $i++)
        echo '<li class="oneImgInfo"><h5>' . $resultArray[$i]['ImageID'] . '</h5><h6>' . $resultArray[$i]['Title'] . '</h6><article>' . $resultArray[$i]['Description'] . '</article><p>' . $resultArray[$i]['PATH'] . '</p></li>';
}

mysqli_close($link);

echo '<script type="text/javascript" src="../js/pageBox/welcomePages.js"></script>';
echo '<script>setPageBox();</script>';
?>
