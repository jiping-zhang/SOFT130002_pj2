<?php
$link = mysqli_connect("localhost", "xxx41", "asdfg142857");
mysqli_set_charset($link, "utf8");
mysqli_select_db($link, "pj2");

if ($_GET['searchMethod']=="title")
{
    $titleStr=$_GET['title'];

    $words=explode(" ",$titleStr);
    $searchStr="%";
    for ($i=0;$i<count($words);$i++)
        $searchStr=($searchStr.$words[$i]."%");
    $query="select ImageID,Title,Description,PATH from travelimage where Title like '$searchStr';";
}
else
{
    $desStr=$_GET['description'];
    $words=explode(" ",$desStr);
    $searchStr="%";
    for ($i=0;$i<count($words);$i++)
        $searchStr=($searchStr.$words[$i]."%");
    $query="select ImageID,Title,Description,PATH from travelimage where Description like '$searchStr';";
}
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
        echo '<li class="oneImgInfo"><h5>' . $resultArray[$i]['ImageID'] . '</h5><h6>' . $resultArray[$i]['Title'] . '</h6><article>' . $resultArray[$i]['Description'] . '</article><p>' . $resultArray[$i]['PATH'] . '</p></li>';
        $imgOnThisPage++;
        if ($imgOnThisPage == 6)
        {
            echo '</ul></li>';
            $imgOnThisPage = 0;
        }
    }
}

mysqli_close($link);
?>
