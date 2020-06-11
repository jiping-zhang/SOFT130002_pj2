<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../../../css/reset.css" rel="stylesheet" type="text/css">
    <link href="../../../css/main.css" rel="stylesheet" type="text/css">
    <link href="../../../css/pages/login&signUpCont.css" rel="stylesheet" type="text/css">
    <title>登陆</title>
</head>
<body>
<header id="navBox">
    <!--    <div class="singleMenu" id="navRight">
            <span>个人中心</span>
            <div class="singleCont">
                <a href="upload.php"><span class="singleItem"><img src="../../../sources/img/navBox/upload.jpg">上传</span></a>
                <br>
                <a href="myPhotos.php"><span class="singleItem"><img src="../../../sources/img/navBox/myPhotos.jpg">我的照片</span></a>
                <br>
                <a href="myFavourite.php"><span class="singleItem"><img src="../../../sources/img/navBox/myFavourite.jpg">我的收藏</span></a>
                <br>
                <a href="login.php"><span class="singleItem" id="selected"><img src="../../../sources/img/navBox/login.jpg">登陆</span></a>
            </div>
        </div>-->
    <?php
    if (isset($_COOKIE['UID']))
        print "<div class=\"singleMenu\" id=\"navRight\">
        <span>个人中心</span>
        <div class=\"singleCont\">
            <a href=\"../upload.php\"><span class=\"singleItem\"><img src=\"../../../../sources/img/navBox/upload.jpg\">上传</span></a>
            <br>
            <a href=\"../myPhotos.php\"><span class=\"singleItem\"><img src=\"../../../../sources/img/navBox/myPhotos.jpg\">我的照片</span></a>
            <br>
            <a href=\"../myFavourite.php\"><span class=\"singleItem\"><img src=\"../../../../sources/img/navBox/myFavourite.jpg\">我的收藏</span></a>
            <br>
            <a href=\"login.php\"><span class=\"singleItem\" id='selected'><img src=\"../../../../sources/img/navBox/login.jpg\">登陆</span></a>
        </div>
    </div>";
    else
        print "    <a href=\"login.php\"><span id=\"selected\" style='float: right' class=\"singleItem\"><img src=\"../../../../sources/img/navBox/login.jpg\">登陆</span></a>"
    ?>
    <a href="../../welcome.php"><span class="singleItem">首页</span></a>
    <a href="../../navItems/browserPage.php"><span class="singleItem">浏览页</span></a>
    <a href="../../navItems/searchPage.php"><span class="singleItem">搜索页</span></a>
</header>
<section id="content">
    <?php
    if (isset($_COOKIE['UID']))
    {
        print "<table>
            <tr>
                <td>您已登录，用户名：</td>
                <td>";
        echo $_COOKIE['userName'];
        print "</td>
            </tr>
            <tr>
                <td><button class=\"submitBt\" onclick=\"window.location.href='logOut.php'\">退出登录</button></td>
            </tr>
        </table>";
    }
    else
        print "<form method=\"post\" action=\"loginForm.php\">
        <table>
            <tr>
                <td><p>用户名</p></td>
                <td><input type=\"text\" name=\"userName\" required=\"required\"
                           pattern=\"\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}\"></td>
            </tr>
            <tr>
                <td><p>密码</p></td>
                <td><input type=\"password\" name=\"password\" id=\"password\" required=\"required\" pattern=\"[0-9a-zA-Z]{8,}\">
                </td>
            </tr>
            <tr>
                <td><input type=\"submit\" class=\"submitBt\" value=\"登陆\"></td>
                <!--                <td><a href=\"signUp.html\"><span class=\"submitBt\">注册</span></a></td>-->
                <td>
                    <button class=\"submitBt\" type=\"button\" onclick=\"window.location.href='signUp.html'\">注册</button>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class=\"otherBt\" type=\"button\" onclick=\"window.location.href='resetPassword.html'\">忘记密码</button>
                </td>
            </tr>
        </table>
    </form>";
    ?>
</section>
<footer id="foot">
    <p>Copy right 19302010022@fudan.edu.cn <img src="../../../../sources/img/2dCode.jpg"></p>
</footer>
</body>
</html>