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
    <script type="text/javascript" src="../../js/browserRecommendBox.js" defer></script>
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
                <form id="searchForm" method="get" action="searchPage.php">
                    <span class="singleItem"><input type="text" name="title"></span>
                    <br>
                    <span class="singleItem"><input type="submit" name="submit" value="搜索"></span>
                </form>
            </div>
        </div>
        <div class="singleMenu">
            <a><h2>hot content</h2></a>
            <div class="singleCont" id="contentRecommendBox">

            </div>
        </div>
        <div class="singleMenu">
            <a><h2>hot countries</h2></a>
            <div class="singleCont" id="countryRecommendBox">

            </div>
        </div>
        <div class="singleMenu">
            <a><h2>hot cities</h2></a>
            <div class="singleCont" id="cityRecommendBox">

            </div>
        </div>
    </aside>
    <section id="content">
        <div class="contRow title">
            筛选
        </div>
<!--        filter-->
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
            <ul id="hotContent">
                <?php
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                mysqli_select_db($link, DB_NAME);
                mysqli_set_charset($link, "utf8");
                $query="select Favor,CountryCodeISO,CityCode,content from travelimage;";
                $favorInfoArray=mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC);

                $contentFavorTimes=array('scenery'=>0,'city'=>0,'people'=>0,'animal'=>0,'building'=>0,'wonder'=>0);
                $countryFavorTimes=array();
                $cityFavorTimes=array();
                for ($i=0;$i<count($favorInfoArray);$i++)
                {
                    $rowInfo=$favorInfoArray[$i];
                    $favorTimes=(int)$rowInfo['Favor'];

                    if ($favorTimes>0)
                    {
                        $content=$rowInfo['content'];
                        $countryISO=$rowInfo['CountryCodeISO'];
                        $cityCode=$rowInfo['CityCode'];

                        $contentFavorTimes[$content]+=$favorTimes;
                        if (!array_key_exists($countryISO,$countryFavorTimes))
                            $countryFavorTimes[$countryISO]=0;
                        $countryFavorTimes[$countryISO]+=$favorTimes;

                        if ($cityCode!=null)
                        {
                            if (!array_key_exists($cityCode,$cityFavorTimes))
                                $cityFavorTimes[$cityCode]=0;
                            $cityFavorTimes[$cityCode]+=$favorTimes;
                        }
                    }
                }
                arsort($contentFavorTimes);
                arsort($countryFavorTimes);
                arsort($cityFavorTimes);
                $hotContents=array_keys($contentFavorTimes);
                $hotCountryISOs=array_keys($countryFavorTimes);
                $hotCityCodes=array_keys($cityFavorTimes);
                $hotCountries=array();
                $hotCities=array();
                $countryOfHotCities=array();
                for ($i=0;$i<count($countryFavorTimes);$i++)
                {
                    $countryISO=$hotCountryISOs[$i];
                    $query="select CountryName from geocountries where ISO='$countryISO';";
                    $hotCountries[$i]=mysqli_fetch_row(mysqli_query($link,$query))[0];
                }
                for ($i=0;$i<count($cityFavorTimes);$i++)
                {
                    $cityCode=$hotCityCodes[$i];
                    $query="select AsciiName,CountryCodeISO from geocities where GeoNameID='$cityCode';";
                    $rowInfo=mysqli_fetch_assoc(mysqli_query($link,$query));
                    $hotCities[$i]=$rowInfo['AsciiName'];
                    $countryISO=$rowInfo['CountryCodeISO'];
                    $query="select CountryName from geocountries where ISO='$countryISO';";
                    $countryOfHotCities[$i]=mysqli_fetch_row(mysqli_query($link,$query))[0];
                }

                mysqli_close($link);

                for ($i=0;$i<3;$i++)
                {
                    echo "<li>".$hotContents[$i]."</li>";
                }
                ?>
            </ul>
            <ul id="hotCountries">
                <?php
                for ($i=0;$i<min(3,count($hotCountries));$i++)
                {
                    echo "<li>".$hotCountries[$i]."</li>";
                }
                ?>
            </ul>
            <ul id="hotCities">
                <?php
                for ($i=0;$i<min(6,count($hotCities));$i++)
                {
                    echo "<li>" ;
                    echo "<h5>".$countryOfHotCities[$i]."</h5>";
                    echo "<p>".$hotCities[$i]."</p>";
                    echo "</li>";
                }
                ?>
            </ul>
<!--            <script defer>
                //let contentSelect=document.getElementById("contentSelect");
                let contentRecommendBox=document.getElementById("contentRecommendBox");
                let hotContentLi=document.getElementById("hotContent").getElementsByTagName('li');
                for (let i = 0; i < hotContentLi.length; i++)
                {
                	if (i>0)
                		contentRecommendBox.appendChild(document.createElement("br"));
                    let singleColumn=document.createElement("span");
                    singleColumn.innerHTML=hotContentLi[i].innerHTML;
                    singleColumn.setAttribute("class","singleItem");
                    let onclickStr="document.getElementById('contentSelect').value='"+hotContentLi[i].innerHTML+"';document.getElementById('contentForm').submit();"
                    singleColumn.setAttribute("onclick",onclickStr);
                    contentRecommendBox.appendChild(singleColumn);
                }
                let countryRecommendBox=document.getElementById("countryRecommendBox");
                let hotCountryLi=document.getElementById("hotCountries").getElementsByTagName("li");
                for (let i = 0; i < hotCountryLi.length; i++)
                {
	                if (i>0)
		                countryRecommendBox.appendChild(document.createElement("br"));
	                let singleColumn=document.createElement("span");
	                singleColumn.innerHTML=hotCountryLi[i].innerHTML;
	                singleColumn.setAttribute("class","singleItem");
	                let onclickStr="document.getElementById('country').value='"+hotCountryLi[i].innerHTML+"';document.getElementById('contentForm').submit();"
	                singleColumn.setAttribute("onclick",onclickStr);
	                countryRecommendBox.appendChild(singleColumn);
                }
                let cityRecommendBox=document.getElementById("cityRecommendBox");
                let hotCityLi=document.getElementById("hotCities").getElementsByTagName("li");
                for (let i = 0; i < hotCountryLi.length; i++)
                {
	                if (i>0)
		                contentRecommendBox.appendChild(document.createElement("br"));
	                let singleColumn=document.createElement("span");
	                let countryName=hotCityLi[i].getElementsByTagName("h5")[0].innerHTML;
	                let cityName=hotCityLi[i].getElementsByTagName("p")[0].innerHTML;
	                singleColumn.innerHTML=cityName;
	                singleColumn.setAttribute("class","singleItem");
	                let onclickStr="document.getElementById('country').value='"+countryName+"';setCity(document.getElementById('country'),document.getElementById('city'));document.getElementById('city').value='"+cityName+"';document.getElementById('contentForm').submit();";
	                singleColumn.setAttribute("onclick",onclickStr);
	                cityRecommendBox.appendChild(singleColumn);
                }
            </script>-->
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