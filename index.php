<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>中间页面</title>
</head>
<body>
<p>
    即将自动跳转到登陆页面
</p>
</body>
<script>
	window.onload=function ()
	{
		document.getElementsByTagName("p")[0].innerHTML="<?php session_start(); $_SESSION['isLogin']=false; ?>";
		window.location.href='src/html/personalCenter/login.php';
	}
</script>
</html>


