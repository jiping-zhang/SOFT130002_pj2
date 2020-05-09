<?php
$dir = dirname(__FILE__);
$indexOfL=strpos($dir,"src\\html")+8;
$dir=substr($dir,0,$indexOfL)."\\configPHP.php";

require $dir;
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($link, DB_NAME);
mysqli_set_charset($link, "utf8");



mysqli_close($link);
?>
