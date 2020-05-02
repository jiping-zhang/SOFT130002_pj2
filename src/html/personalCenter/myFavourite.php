<!DOCTYPE html>
<html lang="en">
<?php
    if (!isset($_COOKIE['UID']))
        echo "<script>window.location.href='./login.php';alert('登陆超时，请重新登陆')</script>"
?>
<head>
    <meta charset="UTF-8">
    <link href="../../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../../css/main.css" rel="stylesheet" type="text/css">
    <link href="../../css/pageBox.css" rel="stylesheet" type="text/css">
    <link href="../../css/cutImage.css" rel="stylesheet" type="text/css">
    <link href="../../css/pages/search.css" rel="stylesheet" type="text/css">
    <script src="../../js/cutImage.js" type="text/javascript"></script>
    <title>我的收藏</title>
</head>
<body>
<header id="navBox">
    <div class="singleMenu" id="navRight">
        <span>个人中心</span>
        <div class="singleCont">
            <a href="upload.php"><span class="singleItem"><img
                            src="../../../sources/img/navBox/upload.jpg">上传</span></a>
            <br>
            <a href="myPhotos.php"><span class="singleItem"><img
                            src="../../../sources/img/navBox/myPhotos.jpg">我的照片</span></a>
            <br>
            <a href="myFavourite.php"><span class="singleItem" id="selected"><img
                            src="../../../sources/img/navBox/myFavourite.jpg">我的收藏</span></a>
            <br>
            <a href="login.php"><span class="singleItem"><img src="../../../sources/img/navBox/login.jpg">登陆</span></a>
        </div>
    </div>
    <a href="../welcome.php"><span class="singleItem">首页</span></a>
    <a href="../navItems/browserPage.php"><span class="singleItem">浏览页</span></a>
    <a href="../navItems/searchPage.php"><span class="singleItem">搜索页</span></a>
</header>
<section id="content">
    <div class="contRow title">
        我的收藏
    </div>
    <div class="contRow">
        <div class="singleItem">
            <div class="imgContainer">
                <img class="contImg" src="../../../sources/img/1.jpg">
            </div>
            <div class="description">
                <h3></h3>
                <p></p>
            </div>
            <button class="deleteFavorBt" onclick="alert('功能缺陷')">
                取消收藏
            </button>
        </div>
    </div>
    <div class="contRow">
        <div class="singleItem">
            <div class="imgContainer">
                <img class="contImg" src="../../../sources/img/2.jpg">
            </div>
            <div class="description">
                <h3></h3>
                <p></p>
            </div>
            <button class="deleteFavorBt" onclick="alert('功能缺陷')">
                取消收藏
            </button>
        </div>
    </div>
    <div class="contRow">
        <div class="singleItem">
            <div class="imgContainer">
                <img class="contImg" src="../../../sources/img/3.jpg">
            </div>
            <div class="description">
                <h3></h3>
                <p></p>
            </div>
            <button class="deleteFavorBt" onclick="alert('功能缺陷')">
                取消收藏
            </button>
        </div>
    </div>
    <div class="contRow">
        <div class="singleItem">
            <div class="imgContainer">
                <img class="contImg" src="../../../sources/img/2.jpg">
            </div>
            <div class="description">
                <h3></h3>
                <p></p>
            </div>
            <button class="deleteFavorBt" onclick="alert('功能缺陷')">
                取消收藏
            </button>
        </div>
    </div>
    <div class="contRow">
        <div class="singleItem">
            <div class="imgContainer">
                <img class="contImg" src="../../../sources/img/2.jpg">
            </div>
            <div class="description">
                <h3></h3>
                <p></p>
            </div>
            <button class="deleteFavorBt" onclick="alert('功能缺陷')">
                取消收藏
            </button>
        </div>
    </div>
    <div class="contRow">
        <div class="singleItem">
            <div class="imgContainer">
                <img class="contImg" src="../../../sources/img/2.jpg">
            </div>
            <div class="description">
                <h3></h3>
                <p></p>
            </div>
            <button class="deleteFavorBt" onclick="alert('功能缺陷')">
                取消收藏
            </button>
        </div>
    </div>
    <div class="contRow_bottom" id="pageBox">
        <ul>
            <li><span class="singleItem">首页</span></li>
            <li><span class="singleItem">上一页</span></li>
            <li><span class="singleItem">1</span></li>
            <li><span class="singleItem">2</span></li>
            <li><span class="singleItem">3</span></li>
            <li><span class="singleItem">4</span></li>
            <li><span class="singleItem">5</span></li>
            <li><span class="singleItem">下一页</span></li>
            <li><span class="singleItem">末页</span></li>
        </ul>
    </div>
    <div class="hidden">
        <form method="get" id="deleteFavorForm" action="../navItems/deleteFavour.php">
            <input type="number" name="imageID" id="imgToBeDeletedID">
        </form>
        <form id="imageIDForm" action="../navItems/detail.php" method="get">
            <input type="number" name="imageID" id="imageIDInput">
            <input type="text" name="imagePath" id="imagePathInput">
        </form>
        <ul id="imgList">
            <?php
            $uid = $_COOKIE['UID'];

            $link = mysqli_connect("localhost", "xxx41", "asdfg142857");
            mysqli_set_charset($link, "utf8");
            mysqli_select_db($link, "pj2");

            $query = "select ImageID from travelimagefavor where UID = $uid order by FavorID asc ";
            $favourImageIDArray = array_column(mysqli_fetch_all(mysqli_query($link, $query)), 0);

            $resultArray = array();
            for ($i = 0; $i < count($favourImageIDArray); $i++)
            {
                $query = "select ImageID,Title,Description,PATH from travelimage where ImageID=" . $favourImageIDArray[$i] . ";";
                $thisImgInfo = mysqli_fetch_assoc(mysqli_query($link, $query));
                array_push($resultArray, $thisImgInfo);
            }

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

            echo '<script type="text/javascript" src="../../js/pageBox/myFavouritePages.js"></script>';
            echo '<script>setPageBox();</script>';
            ?>
        </ul>
    </div>
</section>
<footer id="foot">
    <p>Copy right 19302010022@fudan.edu.cn <img src="../../../sources/img/2dCode.jpg"></p>
</footer>
<script>
	let containerList = document.getElementsByClassName('imgContainer');
	for (let i = 0; i < containerList.length; i++)
	{
		containerList[i].getElementsByClassName('contImg')[0].addEventListener('load', cutImage);
	}
</script>
</body>
</html>