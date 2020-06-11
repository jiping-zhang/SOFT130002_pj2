<?php
/*require "configPHP.php";
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($link, DB_NAME);
mysqli_set_charset($link, "utf8");

function SHA256Hex($str){
    $re=hash('sha256', $str,true);
    return bin2hex($re);
}

function getHashedPassword($userName,$inputPassword)
{
    return SHA256Hex(($userName.$inputPassword));
}

$query="select * from traveluser;";
for ($i=1;$i<=31; $i++)
{
    $query="select UserName from traveluser where UID = $i ; ";
    $userName=mysqli_fetch_row(mysqli_query($link,$query))[0];
    $password=getHashedPassword($userName,"abcd1234");
    $query="update traveluser set Pass = '$password' where UID = $i" ;
    mysqli_query($link,$query);
}

mysqli_close($link);*/

$uid = $_COOKIE['UID'];

$dir = dirname(__FILE__);
$indexOfL = strpos($dir, "src\\html") + 8;
$dir = substr($dir, 0, $indexOfL) . "\\configPHP.php";
require $dir;
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($link, DB_NAME);
mysqli_set_charset($link, "utf8");

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
echo '<script>refresh();setHottestImg()</script>';

?>