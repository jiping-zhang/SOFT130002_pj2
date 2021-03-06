<!DOCTYPE html>
<html lang="en">
<?php
if (!isset($_COOKIE['UID']))
    echo "<script>window.location.href='./userInfoRelatedPages/login.php';alert('登陆超时，请重新登陆')</script>"
?>
<head>
    <meta charset="UTF-8">
    <link href="../../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../../css/main.css" rel="stylesheet" type="text/css">
    <!--    <link href="../../css/pages/cutImage.css" rel="stylesheet" type="text/css">-->
    <link href="../../css/pages/upload.css" rel="stylesheet" type="text/css">
    <link href="../../css/cutImage.css" rel="stylesheet" type="text/css">
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
            <a href="userInfoRelatedPages/login.php"><span class="singleItem"><img src="../../../sources/img/navBox/login.jpg">登陆</span></a>
        </div>
    </div>
    <a href="../welcome.php"><span class="singleItem">首页</span></a>
    <a href="../navItems/browserPage.php"><span class="singleItem">浏览页</span></a>
    <a href="../navItems/searchPage.php"><span class="singleItem">搜索页</span></a>
</header>
<section id="content">
    <form name="uploadForm" id="contentForm" action="uploadForm.php" method="post" enctype="multipart/form-data">
        <div class="contRow title">
            上传
        </div>
        <div class="hidden">
            <input type="text" name="imageID">
        </div>
        <div class="contRow">
            <div class="imgContainer" id="imgContainer0">
                <img src="../../../sources/img/未上传.png" class="contImg" id="img0">
            </div>
            <input type="file" name="file0" id="file0" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" required><br>
        </div>
        <div class="contRow">
            <select name="content">
                <option disabled value="0">-- content --</option>
                <option value="scenery">scenery</option>
                <option value="city">city</option>
                <option value="people">people</option>
                <option value="animal">animal</option>
                <option value="building">building</option>
                <option value="wonder">wonder</option>
            </select>
            <!--<input type="text" name="country" required>
            <input type="text" name="city">-->
            <input type="text" name="country" id="country" list="countryList" required>
            <datalist id="countryList">
                <option value="United States">America</option>
                <option value="United Kingdom">Britain</option>
                <?php
                $dir = dirname(__FILE__);
                $indexOfL = strpos($dir, "src\\html") + 8;
                $dir = substr($dir, 0, $indexOfL) . "\\configPHP.php";
                require $dir;
                $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
                mysqli_select_db($link, DB_NAME);
                mysqli_set_charset($link, "utf8");
                $query="select CountryName,Population from geocountries order by Population desc ;";
                $resultArray=array_column(mysqli_fetch_all(mysqli_query($link,$query)),0);
                for($i=0;$i<count($resultArray);$i++)
                {
                    $countryName=$resultArray[$i];
                    echo "<option value='$countryName'></option>";
                }
                ?>
            </datalist>
            <input type="text" name="city" id="city" list="cityList" required>
            <datalist id="cityList">

            </datalist>
            <script type="text/javascript">
		        function setCity(countryName)
		        {
			        let xmlhttp;
			        if (countryName.length === 0)
			        {
				        document.getElementById("cityList").innerHTML = "";
				        return;
			        }
			        if (window.XMLHttpRequest)
			        {// code for IE7+, Firefox, Chrome, Opera, Safari
				        xmlhttp = new XMLHttpRequest();
			        }
			        else
			        {// code for IE6, IE5
				        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function ()
			        {
				        if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
				        {
					        document.getElementById("cityList").innerHTML = xmlhttp.responseText;
				        }
			        };
			        xmlhttp.open("GET", "setCity.php?countryName=" + countryName, true);
			        xmlhttp.send();
		        }

		        document.getElementById("country").onkeyup=function()
		        {
		        	document.getElementById("city").value=null;
			        setCity(this.value);
		        }
            </script>
        </div>
        <div class="contRow">
            <p>title</p>
            <br>
            <input type="text" name="title" id="uploadTitle" required>
            <br>
            <p>description</p>
            <br>
            <textarea name="description" id="uploadCont"></textarea>
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
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           