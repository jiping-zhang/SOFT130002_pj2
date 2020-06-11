<?php
require "../configPHP.php";
$query = "select * from travelimage where ImageID=30 and UID=20;";
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($link, DB_NAME);
mysqli_set_charset($link, "utf8");
try
{
    $initialImgInfo = mysqli_fetch_assoc(mysqli_query($link, $query));
}
catch (Exception $e)
{
    echo "111";
}
?>