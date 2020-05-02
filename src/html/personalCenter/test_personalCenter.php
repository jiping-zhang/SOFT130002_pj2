<html>
<body>
<ul id="imgList">
<?php
$uid=$_COOKIE['UID'];

$link = mysqli_connect("localhost", "xxx41", "asdfg142857");
mysqli_set_charset($link, "utf8");
mysqli_select_db($link, "pj2");

/*$query="select ImageID from travelimagefavor where UID = $uid order by FavorID asc ";
$favourImageIDArray=array_column(mysqli_fetch_all(mysqli_query($link,$query)),0);

$resultArray=array();
for ($i = 0; $i < count($favourImageIDArray); $i++)
{
    $query="select ImageID,Title,Description,PATH from travelimage where ImageID=".$favourImageIDArray[$i].";";
    $thisImgInfo=mysqli_fetch_assoc(mysqli_query($link,$query));
    array_push($resultArray,$thisImgInfo);
}*/

$query="select ImageID,Title,Description,PATH from travelimage where UID=$uid ;";
$resultArray=mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC);

if (count($resultArray) == 0)
{
    echo '<li class="onePageInfo"><ul><li class="oneImgInfo"></li></ul></li>';
}
else
{
    $imgOnThisPage = 0;
    for ($i = 0; $i < count($resultArray); $i++)
    {
        if ($imgOnThisPage == 0)
            echo '<li class="onePageInfo"><ul>';
        echo '<li class="oneImgInfo"><h5>'.$resultArray[$i]['ImageID'].'</h5><h6>' . $resultArray[$i]['Title'] . '</h6><article>'.$resultArray[$i]['Description'].'</article><p>' . $resultArray[$i]['PATH'] . '</p></li>';
        $imgOnThisPage++;
        if ($imgOnThisPage == 6)
        {
            echo '</ul></li>';
            $imgOnThisPage = 0;
        }
    }
}

mysqli_close($link);

//echo '<script type="text/javascript" src="../../js/browserImgPages.js"></script>';
//echo '<script>setPageBox();</script>';
?>
</ul>
</body>
</html>
