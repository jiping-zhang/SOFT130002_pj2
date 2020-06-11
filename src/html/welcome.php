<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/pages/welcome.css" rel="stylesheet" type="text/css">
    <link href="../css/cutImage.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/cutImage.js"></script>
    <script type="text/javascript" src="../js/welcomePage.js" defer></script>
    <title>欢迎（首页）</title>
</head>
<body>
<header id="navBox">
<?php
    if (isset($_COOKIE['UID']))
        print "<div class=\"singleMenu\" id=\"navRight\">
        <span>个人中心</span>
        <div class=\"singleCont\">
            <a href=\"personalCenter/upload.php\"><span class=\"singleItem\"><img src=\"../../sources/img/navBox/upload.jpg\">上传</span></a>
            <br>
            <a href=\"personalCenter/myPhotos.php\"><span class=\"singleItem\"><img src=\"../../sources/img/navBox/myPhotos.jpg\">我的照片</span></a>
            <br>
            <a href=\"personalCenter/myFavourite.php\"><span class=\"singleItem\"><img src=\"../../sources/img/navBox/myFavourite.jpg\">我的收藏</span></a>
            <br>
            <a href=\"personalCenter/userInfoRelatedPages/login.php\"><span class=\"singleItem\"><img src=\"../../sources/img/navBox/login.jpg\">登陆</span></a>
        </div>
    </div>";
    else
        print "    <a href=\"personalCenter/userInfoRelatedPages/login.php\"><span id=\"navRight\" class=\"singleItem\"><img src=\"../../sources/img/navBox/login.jpg\">登陆</span></a>"
    ?>
    <a href="welcome.php"><span class="singleItem" id="selected">首页</span></a>
    <a href="navItems/browserPage.php"><span class="singleItem">浏览页</span></a>
    <a href="navItems/searchPage.php"><span class="singleItem">搜索页</span></a>
</header>
<section id="content">
    <div id="contLeft">
        <div class="imgContainer">
            <img class="contImg">
        </div>
    </div>
    <div id="contRight">
        <div class="imgItem">
            <div class="imgTitle">
                <h3></h3>
            </div>
            <div class="imgContainer">
                <img class="contImg">
            </div>
            <div class="description">
                <p>
                </p>
            </div>
        </div>
        <div class="imgItem">
            <div class="imgTitle">
                <h3></h3>
            </div>
            <div class="imgContainer">
                <img class="contImg">
            </div>
            <div class="description">
                <p>
                </p>
            </div>
        </div>
        <div class="imgItem">
            <div class="imgTitle">
                <h3></h3>
            </div>
            <div class="imgContainer">
                <img class="contImg">
            </div>
            <div class="description">
                <p>
                </p>
            </div>
        </div>
        <div class="imgItem">
            <div class="imgTitle">
                <h3></h3>
            </div>
            <div class="imgContainer">
                <img class="contImg">
            </div>
            <div class="description">
                <p>
                </p>
            </div>
        </div>
        <div class="imgItem">
            <div class="imgTitle">
                <h3></h3>
            </div>
            <div class="imgContainer">
                <img class="contImg">
            </div>
            <div class="description">
                <p>
                </p>
            </div>
        </div>
        <div class="imgItem">
            <div class="imgTitle">
                <h3></h3>
            </div>
            <div class="imgContainer">
                <img class="contImg">
            </div>
            <div class="description">
                <p>
                </p>
            </div>
        </div>
    </div>
</section>
<div class="hidden">
    <form id="imageIDForm" action="navItems/detail.php" method="get">
        <input type="number" name="imageID" id="imageIDInput">
        <input type="text" name="imagePath" id="imagePathInput">
    </form>
    <span id="hottestImgInfo">
        <?php
        $dir = dirname(__FILE__);
        $indexOfL=strpos($dir,"src\\html")+8;
        $dir=substr($dir,0,$indexOfL)."\\configPHP.php";
        require $dir;
        $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);
        mysqli_select_db($link,DB_NAME);
        mysqli_set_charset($link, "utf8");

        $query="select * from travelimage order by Favor desc;";
        $hottestImg=mysqli_fetch_assoc(mysqli_query($link,$query));
        $hottestImgPath=$hottestImg['PATH'];
        $hottestImgID=$hottestImg['ImageID'];

        echo "<h5>$hottestImgID</h5><p>$hottestImgPath</p>";

        mysqli_close($link);
        ?>
    </span>
    <ul id="imgList">
        <?php
        //$uid = $_COOKIE['UID'];

        $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);
        mysqli_select_db($link,DB_NAME);
        mysqli_set_charset($link, "utf8");

        $query = "select ImageID,Title,Description,PATH,Favor from travelimage order by Favor desc ;";
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
        echo '<script>set6HotImg();setHottestImg()</script>';
        ?>
        <script>set6HotImg();setHottestImg()</script>
    </ul>
</div>
<footer id="foot">
    <p>Copy right 19302010022@fudan.edu.cn <img src="../../sources/img/2dCode.jpg"></p>
</footer>
<a href="#">
    <div id="returnTop">
        <span>↑</span>
    </div>
</a>
<div id="refresh" onclick="refresh()" style="cursor: pointer">
    <span>R</span>
</div>
<script>
	let containerList = document.getElementsByClassName('imgContainer');
	for (let i = 0; i < containerList.length; i++)
	{
		containerList[i].getElementsByClassName('contImg')[0].addEventListener('load', cutImage);
	}
</script>
</body>
</html>