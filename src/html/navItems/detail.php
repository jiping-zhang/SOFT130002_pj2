<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../../css/main.css" rel="stylesheet" type="text/css">
    <link href="../../css/pages/detail.css" rel="stylesheet" type="text/css">
    <link href="../../css/self-definedTable.css" rel="stylesheet" type="text/css">
    <!--    <script sources="../../js/stretchImage.js" type="text/javascript" defer></script>-->
    <script src="../../js/stretchImage.js" type="text/javascript" defer></script>
    <script src="../../js/changeTableWidth.js" type="text/javascript" defer></script>
    <title>详情</title>
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
            <a href=\"../personalCenter/userInfoRelatedPages/login.php\"><span class=\"singleItem\"><img src=\"../../../sources/img/navBox/login.jpg\">登陆</span></a>
        </div>
    </div>";
    else
        print "    <a href=\"../personalCenter/userInfoRelatedPages/login.php\"><span id=\"navRight\" class=\"singleItem\"><img src=\"../../../sources/img/navBox/login.jpg\">登陆</span></a>"
    ?>
    <a href="../welcome.php"><span class="singleItem">首页</span></a>
    <a href="browserPage.php"><span class="singleItem">浏览页</span></a>
    <a href="searchPage.php"><span class="singleItem">搜索页</span></a>
</header>
<section id="content">
    <?php
    $imageID = $_GET['imageID'];
    $dir = dirname(__FILE__);
    $indexOfL=strpos($dir,"src\\html")+8;
    $dir=substr($dir,0,$indexOfL)."\\configPHP.php";
    require $dir;
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($link, DB_NAME);
    mysqli_select_db($link, "pj2");

    $query = "select * from travelimage where ImageID=" . $imageID . ";";
    $result = mysqli_query($link, $query);
    $imgInfoArray = mysqli_fetch_assoc($result);

    $upLoadUserID = $imgInfoArray['UID'];
    $query = "select UserName from traveluser where UID=" . $upLoadUserID . ";";
    $upLoadUser = mysqli_fetch_row(mysqli_query($link, $query))[0];

    $cityCode = $imgInfoArray['CityCode'];
    if ($cityCode == null)
        $cityName = '';
    else
    {
        $query = "select AsciiName from geocities where GeoNameID=" . $cityCode . ";";
        $cityName = mysqli_fetch_row(mysqli_query($link, $query))[0];
    }

    $countryCodeISO = $imgInfoArray['CountryCodeISO'];
    $query = "select CountryName from geocountries where ISO='" . $countryCodeISO . "';";
    $countryName = mysqli_fetch_row(mysqli_query($link, $query))[0];

    mysqli_close($link);
    ?>
    <div class="hidden">
        <form method="get" id="hiddenForm"
            <?php
            if (isset($_COOKIE['UID']))
            {
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                mysqli_select_db($link, DB_NAME);
                mysqli_set_charset($link, "utf8");
                $query = "select * from travelimagefavor where UID= " . $_COOKIE['UID'] . " and ImageID = " . $imageID . ";";
                if (mysqli_fetch_row(mysqli_query($link, $query)) != null)
                    echo "action='deleteFavour.php'";
                else
                    echo "action='iFavour.php'";
                mysqli_close($link);
            }
            else
                echo "action='../personalCenter/login.php'";
            ?>
        >
        <input type="number" name="imageID" <?php echo "value=".$imageID ?>>
        </form>
    </div>
    <div id="contHead">
        <p></p>
        <h2> <?php echo $imgInfoArray['Title'] ?> </h2>
        <sub> by <?php echo $upLoadUser ?> </sub>
        <p></p>
    </div>
    <div id="middle">
        <div class="imgContainer" id="imgContainer">
            <img class="contImg" src="<?php echo $_GET['imagePath'] ?>">
        </div>
        <div class="infoBox" id="infoBox">
            <table class="contTable">
                <tr>
                    <th>like number</th>
                </tr>
                <tr>
                    <td><?php echo $imgInfoArray['Favor'] ?></td>
                </tr>
            </table>
            <table class="contTable">
                <tr>
                    <th>details</th>
                </tr>
                <tr>
                    <td>Content: <?php echo $imgInfoArray['content'] ?></td>
                </tr>
                <tr>
                    <td>Country: <?php echo $countryName ?></td>
                </tr>
                <tr>
                    <td>City: <?php echo $cityName ?></td>
                </tr>
            </table>
            <button onclick="document.getElementById('hiddenForm').submit()">
                <?php
                if (isset($_COOKIE['UID']))
                {
                    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                    mysqli_select_db($link, DB_NAME);
                    mysqli_set_charset($link, "utf8");
                    $query = "select * from travelimagefavor where UID= " . $_COOKIE['UID'] . " and ImageID = " . $imageID . ";";
                    if (mysqli_fetch_row(mysqli_query($link, $query)) != null)
                        echo "取消收藏";
                    else
                        echo "收藏";
                    mysqli_close($link);
                }
                else
                    echo "请先登陆";
                ?>
            </button>
        </div>
    </div>
    <div id="description">
        <p>
            <?php
            print $imgInfoArray['Description'];
            ?>
        </p>
    </div>
</section>
<footer id="foot">
    <p>Copy right 19302010022@fudan.edu.cn <img src="../../../sources/img/2dCode.jpg"></p>
</footer>
</body>
</html>