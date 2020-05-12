<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../../css/main.css" rel="stylesheet" type="text/css">
    <link href="../../css/pageBox.css" rel="stylesheet" type="text/css">
    <link href="../../css/pages/browser.css" rel="stylesheet" type="text/css">
    <link href="../../css/cutImage.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../js/setCity.js" defer></script>
    <script type="text/javascript" src="../../js/cutImage.js"></script>
    <title>浏览</title>
</head>
<body>
<div id="container">
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
        <a href="browserPage.php"><span class="singleItem" id="selected">浏览页</span></a>
        <a href="searchPage.php"><span class="singleItem">搜索页</span></a>
    </header>
    <aside id="leftNavBox">
        <div class="singleMenu">
            <a><h2>search</h2></a>
            <div class="singleCont">
                <form id="searchForm" method="get">
                    <span class="singleItem"><input type="text" name="keyWord"></span>
                    <br>
                    <span class="singleItem"><input type="submit" name="submit" value="搜索"></span>
                </form>
            </div>
        </div>
        <div class="singleMenu">
            <a><h2>hot content</h2></a>
            <div class="singleCont">
                <a><span class="singleItem"
                         onclick="document.getElementById('contentSelect').value='scenery';document.getElementById('contentForm').submit();"> scenery </span></a>
                <br>
                <a><span class="singleItem"
                         onclick="document.getElementById('contentSelect').value='city';document.getElementById('contentForm').submit();"> city </span></a>
                <br>
                <a><span class="singleItem"
                         onclick="document.getElementById('contentSelect').value='people';document.getElementById('contentForm').submit();"> people </span></a>
                <br>
                <a><span class="singleItem"
                         onclick="document.getElementById('contentSelect').value='animal';document.getElementById('contentForm').submit();"> animal </span></a>
                <br>
                <a><span class="singleItem"
                         onclick="document.getElementById('contentSelect').value='building';document.getElementById('contentForm').submit();"> building </span></a>
                <br>
                <a><span class="singleItem"
                         onclick="document.getElementById('contentSelect').value='wonder';document.getElementById('contentForm').submit();"> wonder </span></a>
            </div>
        </div>
        <div class="singleMenu">
            <a><h2>hot countries</h2></a>
            <div class="singleCont">
                <!--<a><span class="singleItem"
                         onclick="document.getElementById('country').value='China';document.getElementById('contentForm').submit();"> China </span></a>
                <br>-->
                <a><span class="singleItem"
                         onclick="document.getElementById('country').value='United States';document.getElementById('contentForm').submit();"> United States </span></a>
                <br>
                <!--                <a><span class="singleItem"
                                         onclick="document.getElementById('country').value='Japan';document.getElementById('contentForm').submit();"> Japan </span></a>
                                         <br>-->
                <a><span class="singleItem"
                         onclick="document.getElementById('country').value='Italy';document.getElementById('contentForm').submit();"> Italy </span></a>
            </div>
        </div>
        <div class="singleMenu">
            <a><h2>hot cities</h2></a>
            <div class="singleCont">
                <!--                <a><span class="singleItem"
                                         onclick="document.getElementById('country').value='China';setCity(document.getElementById('country'),document.getElementById('city'));document.getElementById('city').value='Shanghai';document.getElementById('contentForm').submit();"> Shanghai </span></a>
                                         <br>-->

                <a><span class="singleItem"
                         onclick="document.getElementById('country').value='United States';setCity(document.getElementById('country'),document.getElementById('city'));document.getElementById('city').value='New York';document.getElementById('contentForm').submit();"> New York </span></a>
                <br>
                <!--<a><span class="singleItem"
                         onclick="document.getElementById('country').value='Japan';setCity(document.getElementById('country'),document.getElementById('city'));document.getElementById('city').value='Tokyo';document.getElementById('contentForm').submit();"> Tokyo </span></a>
                <br>-->
                <!--<a><span class="singleItem"
                         onclick="document.getElementById('country').value='China';setCity(document.getElementById('country'),document.getElementById('city'));document.getElementById('city').value='Beijing';document.getElementById('contentForm').submit();"> Beijing </span></a>
                <br>-->
                <a><span class="singleItem"
                         onclick="document.getElementById('country').value='Italy';setCity(document.getElementById('country'),document.getElementById('city'));document.getElementById('city').value='Roma';document.getElementById('contentForm').submit();"> Roma </span></a>
                <br>
                <a><span class="singleItem"
                         onclick="document.getElementById('country').value='United States';setCity(document.getElementById('country'),document.getElementById('city'));document.getElementById('city').value='San Francisco';document.getElementById('contentForm').submit();"> San Francisco </span></a>
            </div>
        </div>
    </aside>
    <section id="content">
        <div class="contRow title">
            筛选
        </div>
        <div class="contRow">
            <div>
                <form name="contentForm" id="contentForm" action="browserPage.php" method="get">
                    <select name="content" id="contentSelect">
                        <option value="0">All contents</option>
                        <option value="scenery">scenery</option>
                        <option value="city">city</option>
                        <option value="people">people</option>
                        <option value="animal">animal</option>
                        <option value="building">building</option>
                        <option value="wonder">wonder</option>
                    </select>
                    <select name="country" id="country" onblur="setCity(this, this.form.city);">
                        <option value="0">All countries</option>
                    </select>
                    <select name="city" id="city" style="min-width: 160px">
                        <option value="0">All cities</option>
                    </select>
                    <input type="submit" class="submit" value="filter">
                </form>
            </div>
        </div>
        <div class="contRow">
            <div class="imgContainer">
                <img class="contImg" src="">
            </div>
            <div class="imgContainer">
                <img class="contImg" src="">
            </div>
            <div class="imgContainer">
                <img class="contImg" src="">
            </div>
            <div class="imgContainer">
                <img class="contImg" src="">
            </div>
            <div class="imgContainer">
                <img class="contImg" src="">
            </div>
            <div class="imgContainer">
                <img class="contImg" src="">
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
            <form id="imageIDForm" action="detail.php" method="get">
                <input type="number" name="imageID" id="imageIDInput">
                <input type="text" name="imagePath" id="imagePathInput">
            </form>
            <ul id="cityAndCountryInfo">
                <?php
                $dir = dirname(__FILE__);
                $indexOfL = strpos($dir, "src\\html") + 8;
                $dir = substr($dir, 0, $indexOfL) . "\\configPHP.php";
                require $dir;
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                mysqli_select_db($link, DB_NAME);
                mysqli_set_charset($link, "utf8");


                $query = "select distinct CountryCodeISO from travelimage ;";
                $countryISOArray = array_column(mysqli_fetch_all(mysqli_query($link, $query)), 0);
                $countryNameArray = array();
                for ($i = 0; $i < count($countryISOArray); $i++)
                {
                    $query = "select CountryName from geocountries where ISO='" . $countryISOArray[$i] . "';";
                    $countryNameArray[$i] = mysqli_fetch_array(mysqli_query($link, $query))[0];
                }
                $cityNameArray = array();
                $cityIDArray = array();
                for ($i = 0; $i < count($countryISOArray); $i++)
                {
                    $query = "select distinct CityCode from travelimage where CountryCodeISO='" . $countryISOArray[$i] . "' order by CityCode desc;";
                    $cityInThisCountryArray_ID = array_column(mysqli_fetch_all(mysqli_query($link, $query)), 0);
                    $cityIDArray[$i] = $cityInThisCountryArray_ID;
                    $cityInThisCountryArray_name = array();
                    for ($j = 0; $j < count($cityInThisCountryArray_ID); $j++)
                    {
                        if ($cityInThisCountryArray_ID[$j] != null)
                        {
                            $query = "select AsciiName from geocities where GeoNameID=" . $cityInThisCountryArray_ID[$j] . ";";
                            $cityInThisCountryArray_name[$j] = mysqli_fetch_array(mysqli_query($link, $query))[0];
                        }
                    }
                    $cityNameArray[$i] = $cityInThisCountryArray_name;
                }
                for ($i = 0; $i < count($countryISOArray); $i++)
                {
                    echo "<li class='countryInfo'>";
                    echo "<p class='countryName'>" . $countryNameArray[$i] . "</p>";
                    echo "<ul class='allCities'>";
                    for ($j = 0; $j < count($cityNameArray[$i]); $j++)
                    {
                        echo "<li class='cityName'>";
                        echo $cityNameArray[$i][$j];
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo "</li>";
                }
                mysqli_close($link);
                ?>
            </ul>
            <ul id="imgList">
                <?php
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                mysqli_select_db($link, DB_NAME);
                mysqli_set_charset($link, "utf8");

                $cityName = $_GET['city'];
                $countryName = $_GET['country'];
                $content = $_GET['content'];

                if ($cityName == null && $countryName == null)
                    $resultArray = getImgList($link, '', '', '');
                else
                {
                    if ($content == '0')
                        if ($cityName == '0')
                            $resultArray = getImgList($link, '', getCountryCodeISO($link, $countryName), '');
                        else
                            if ($countryName == '0')
                                $resultArray = getImgList($link, '', '', '');
                            else
                                $resultArray = getImgList($link, '', '', getCityCode($link, $cityName,getCountryCodeISO($link,$countryName)));
                    else
                        if ($cityName == '0')
                            if ($countryName != '0')
                                $resultArray = getImgList($link, $content, getCountryCodeISO($link, $countryName), '');
                            else
                                $resultArray = getImgList($link, $content, '', '');
                        else
                            $resultArray = getImgList($link, $content, '', getCityCode($link, $cityName,getCountryCodeISO($link,$countryName)));
                }

                function getCityCode($link, $cityName,$countryCodeISO)
                {
                    $query = "select GeoNameID from geocities where AsciiName = '" . $cityName . "' and CountryCodeISO = '".$countryCodeISO."';";
                    $finalResult = mysqli_fetch_assoc(mysqli_query($link, $query));
                    return $finalResult['GeoNameID'];
                }

                function getCountryCodeISO($link, $countryName)
                {
                    $query = "select ISO from geocountries where CountryName='" . $countryName . "';";
                    $finalResult = mysqli_fetch_assoc(mysqli_query($link, $query));
                    return $finalResult['ISO'];
                }

                function getImgList($link, $content, $countryCodeISO, $cityCode)
                {
                    if ($content != '')
                        if ($cityCode != '')
                            $query = "select ImageID,PATH from travelimage where CityCode=" . $cityCode . " and content='" . $content . "' order by Favor desc ;";
                        else
                            if ($countryCodeISO != '')
                                $query = "select ImageID,PATH from travelimage where CountryCodeISO='" . $countryCodeISO . "' and content='" . $content . "' order by Favor desc ;";
                            else
                                $query = "select ImageID,PATH from travelimage where content='" . $content . "' order by Favor desc;";
                    else
                        if ($cityCode != '')
                            $query = "select ImageID,PATH from travelimage where CityCode=" . $cityCode . " order by Favor desc ;";
                        else
                            if ($countryCodeISO != '')
                                $query = "select ImageID,PATH from travelimage where CountryCodeISO='" . $countryCodeISO . "' order by Favor desc ;";
                            else
                                $query = "select ImageID,PATH from travelimage order by Favor desc ;";
                    $result = mysqli_query($link, $query);
                    $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    return $resultArray;
                }

                mysqli_close($link);
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
                        echo '<li class="oneImgInfo"><h5>' . $resultArray[$i]['ImageID'] . '</h5><p>' . $resultArray[$i]['PATH'] . '</p></li>';
                        $imgOnThisPage++;
                        if ($imgOnThisPage == 6)
                        {
                            echo '</ul></li>';
                            $imgOnThisPage = 0;
                        }
                    }
                }
                echo '<script type="text/javascript" src="../../js/pageBox/browserImgPages.js"></script>';
                echo '<script>setPageBox();</script>';
                ?>
            </ul>
        </div>
    </section>
    <a href="#">
        <div id="returnTop">
            <span>↑</span>
        </div>
    </a>
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
</div>
</body>
</html>