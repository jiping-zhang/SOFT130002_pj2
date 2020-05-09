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
    <!--    <link href="../../css/pages/cutImage.css" rel="stylesheet" type="text/css">-->
    <link href="../../css/pages/upload.css" rel="stylesheet" type="text/css">
    <link href="../../css/cutImage.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../js/cityCorrelateCountry.js" defer></script>
    <script type="text/javascript" src="../../js/stretchImage.js" defer></script>
    <script type="text/javascript" src="../../js/uploadImg.js" defer></script>
    <title>上传</title>
</head>
<body>
<header id="navBox">
    <div class="singleMenu" id="navRight">
        <span>个人中心</span>
        <div class="singleCont">
            <a href="upload.php"><span class="singleItem" id="selected"><img
                            src="../../../sources/img/navBox/upload.jpg">上传</span></a>
            <br>
            <a href="myPhotos.php"><span class="singleItem"><img
                            src="../../../sources/img/navBox/myPhotos.jpg">我的照片</span></a>
            <br>
            <a href="myFavourite.php"><span class="singleItem"><img src="../../../sources/img/navBox/myFavourite.jpg">我的收藏</span></a>
            <br>
            <a href="login.php"><span class="singleItem"><img src="../../../sources/img/navBox/login.jpg">登陆</span></a>
        </div>
    </div>
    <a href="../welcome.php"><span class="singleItem">首页</span></a>
    <a href="../navItems/browserPage.php"><span class="singleItem">浏览页</span></a>
    <a href="../navItems/searchPage.php"><span class="singleItem">搜索页</span></a>
</header>
<section id="content">
    <form name="uploadForm" id="contentForm" action="editForm.php" method="post" enctype="multipart/form-data">
        <div class="contRow title">
            上传
        </div>
        <div class="hidden">
            <input type="number" name="imageID"
                <?php
                $imageID = (int)$_GET['imageID'];
                echo "value=" . $imageID;

                $dir = dirname(__FILE__);
                $indexOfL=strpos($dir,"src\\html")+8;
                $dir=substr($dir,0,$indexOfL)."\\configPHP.php";
                require $dir;
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                mysqli_select_db($link, DB_NAME);
                mysqli_set_charset($link, "utf8");

                $query = "select * from travelimage where ImageID = $imageID ;";
                $imageInfoArray = mysqli_fetch_assoc(mysqli_query($link, $query));
                $title = $imageInfoArray['Title'];
                $description = $imageInfoArray['Description'];
                $content = $imageInfoArray['content'];

                $countryCodeISO = $imageInfoArray['CountryCodeISO'];
                $query = "select CountryName from geocountries where ISO='$countryCodeISO';";
                $countryName = mysqli_fetch_row(mysqli_query($link, $query))[0];

                $cityCode = $imageInfoArray['CityCode'];
                if ($cityCode != null)
                {
                    $cityID = (int)$cityCode;
                    $query = "select AsciiName from geocities where GeoNameID=$cityID ;";
                    $cityName = mysqli_fetch_row(mysqli_query($link, $query))[0];
                }

                mysqli_close($link)
                ?>
            >
            <input type="number" name="changeTimes" id="changeTimes" value="0">
        </div>
        <div class="contRow">
            <div class="imgContainer" id="imgContainer0">
                <img
                    <?php
                    if (isset($_GET['imagePath']))
                    {
                        echo "src=../../../sources/img/travel-images/normal/medium/" . $_GET['imagePath'];
                    }
                    else
                        echo "src=\"../../../sources/img/未上传.png\""
                    ?>
                        class="contImg" id="img0">
            </div>
            <input type="file" name="file0" id="file0" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg"
                   onchange="document.getElementById('changeTimes').value=1;"><br>
        </div>
        <div class="contRow">
            <select name="content">
                <option disabled value="0">-- content --</option>
                <option value="scenery" <?php
                if (strcmp("scenery", $content) == 0)
                    echo "selected";
                ?>>scenery
                </option>
                <option value="city"<?php
                if (strcmp("city", $content) == 0)
                    echo "selected";
                ?>>city
                </option>
                <option value="people"<?php
                if (strcmp("people", $content) == 0)
                    echo "selected";
                ?>>people
                </option>
                <option value="animal"<?php
                if (strcmp("animal", $content) == 0)
                    echo "selected";
                ?>>animal
                </option>
                <option value="building"<?php
                if (strcmp("building", $content) == 0)
                    echo "selected";
                ?>>building
                </option>
                <option value="wonder"<?php
                if (strcmp("wonder", $content) == 0)
                    echo "selected";
                ?>>wonder
                </option>
            </select>
            <input type="text" name="country" required
                <?php
                echo "value=" . $countryName
                ?>
            >
            <input type="text" name="city"
                <?php
                if (isset($cityName))
                    echo "value=" . $cityName
                ?>
            >
        </div>
        <div class="contRow">
            <p>title</p>
            <br>
            <input type="text" name="title" id="uploadTitle" required
                <?php
                print "value='".$title."'";
                ?>
            >
            <br>
            <p>description</p>
            <br>
            <textarea name="description" id="uploadCont"
             <?php
             if ($description!=null)
                 echo "value=".$description
             ?>
            ></textarea>
        </div>
        <div class="contRow_bottom" id="pageBox">
            <input type="submit" class="submit" value="upload">
        </div>
    </form>
</section>
<div class="hidden">
    <ul id="cityAndCountryInfo">
        <?php

        ?>
    </ul>
</div>
<footer id="foot">
    <p>Copy right 19302010022@fudan.edu.cn <img src="../../../sources/img/2dCode.jpg"></p>
</footer>
</body>
</html>