<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../../css/main.css" rel="stylesheet" type="text/css">
    <link href="../../css/cutImage.css" rel="stylesheet" type="text/css">
    <link href="../../css/pages/search.css" rel="stylesheet" type="text/css">
    <script src="../../js/cutImage.js" type="text/javascript" defer></script>
    <title>搜索</title>
</head>
<body>
<header id="navBox">
    <?php
    if (isset($_COOKIE['UID']))
        print "<div class=\"singleMenu\" id=\"navRight\">
        <span>个人中心</span>
        <div class=\"singleCont\">
            <a href=\"../personalCenter/upload.php\"><span class=\"singleItem\"><img src=\"../../../sources/img/navBox/upload.jpg\">上传</span></a>
            <br>
            <a href=\"../personalCenter/myPhotos.php\"><span class=\"singleItem\"><img src=\"../../../sources/img/navBox/myPhotos.jpg\">我的照片</span></a>
            <br>
            <a href=\"../personalCenter/myFavourite.php\"><span class=\"singleItem\"><img src=\"../../../sources/img/navBox/myFavourite.jpg\">我的收藏</span></a>
            <br>
            <a href=\"../personalCenter/login.php\"><span class=\"singleItem\"><img src=\"../../../sources/img/navBox/login.jpg\">登陆</span></a>
        </div>
    </div>";
    else
        print "    <a href=\"../personalCenter/login.php\"><span id=\"navRight\" class=\"singleItem\"><img src=\"../../../sources/img/navBox/login.jpg\">登陆</span></a>"
    ?>
    <a href="../welcome.php"><span class="singleItem">首页</span></a>
    <a href="browserPage.php"><span class="singleItem">浏览页</span></a>
    <a href="searchPage.php"><span class="singleItem" id="selected">搜索页</span></a>
</header>
<section id="content">
    <div class="contRow title">
        搜索
    </div>
    <div class="contRow">
        <div>
            <form name="contentForm" id="contentForm" action="searchPage.php" method="get">
                <input type="radio" name="searchMethod" value="title" checked> by title
                <br>
                <input type="text" name="title" id="searchTitle">
                <br>
                <input type="radio" name="searchMethod" value="content"> by content
                <br>
                <textarea name="description" id="searchCont"></textarea>
                <br>
                <input type="submit" class="submit" value="search">
            </form>
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
        </div>
    </div>
    <div class="contRow_bottom" id="pageBox">
        <ul>
            <li><a href="#"><span class="singleItem">首页</span></a></li>
            <li><a href="#"><span class="singleItem">上一页</span></a></li>
            <li><a href="#"><span class="singleItem">1</span></a></li>
            <li><a href="#"><span class="singleItem">2</span></a></li>
            <li><a href="#"><span class="singleItem">3</span></a></li>
            <li><a href="#"><span class="singleItem">4</span></a></li>
            <li><a href="#"><span class="singleItem">5</span></a></li>
            <li><a href="#"><span class="singleItem">下一页</span></a></li>
            <li><a href="#"><span class="singleItem">末页</span></a></li>
        </ul>
    </div>
    <div class="hidden">
        <form id="imageIDForm" action="../navItems/detail.php" method="get">
            <input type="number" name="imageID" id="imageIDInput">
            <input type="text" name="imagePath" id="imagePathInput">
        </form>
        <ul id="imgList">
            <?php
            $link = mysqli_connect("localhost", "xxx41", "asdfg142857");
            mysqli_set_charset($link, "utf8");
            mysqli_select_db($link, "pj2");

            if ($_GET['searchMethod'] == "title")
            {
                $titleStr = $_GET['title'];

                $words = explode(" ", $titleStr);
                $searchStr = "%";
                for ($i = 0; $i < count($words); $i++)
                    $searchStr = ($searchStr . $words[$i] . "%");
                $query = "select ImageID,Title,Description,PATH from travelimage where Title like '$searchStr';";
            }
            else
            {
                $desStr = $_GET['description'];
                $words = explode(" ", $desStr);
                $searchStr = "%";
                for ($i = 0; $i < count($words); $i++)
                    $searchStr = ($searchStr . $words[$i] . "%");
                $query = "select ImageID,Title,Description,PATH from travelimage where Description like '$searchStr';";
            }
            $resultArray = mysqli_fetch_all(mysqli_query($link, $query), MYSQLI_ASSOC);
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

            echo '<script type="text/javascript" src="../../js/pageBox/searchPages.js"></script>';
            echo '<script>setPageBox();</script>';
            ?>
        </ul>
    </div>
</section>
<footer id="foot">
    <p>Copy right 19302010022@fudan.edu.cn <img src="../../../sources/img/2dCode.jpg"></p>
</footer>
</body>
</html>