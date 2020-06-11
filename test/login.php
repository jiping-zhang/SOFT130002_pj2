<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="login.css">
</head>



<body>
<?php
require("../php/wheel.php");
$userName=get('username');
$result=mysqlDo("SELECT UserName,Pass FROM traveluser WHERE username ='{$userName}'");
if(get('username')==''){
    $nameErr='';
    $passErr='';
}
elseif($result===null) {
    $nameErr="non-exist";
}
else {
    if($result[0]['Pass']!=get('password')){
        $passErr='wrong';
    }
    else{
        setcookie("username",encode($userName),time()+36000);
        header("Location: ../html/HomePage.html");
    }
}?>
    <div class="box">
        <h2>Login</h2>
        <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
            <div class="inputbox">
                <input type="text" name="username" required>
                <label>Username <?php echo $nameErr;?></label>
            </div>
            <div class="inputbox">
                <input type="password" name="password" required>
                <label>Password <?php echo $passErr;?></label>
            </div>
            <input type="button" value="submit" onclick="document.getElementById('login').submit()">
            <input type="button" value="register" id="button2" onclick="window.location.href='register.html'">
        </form>
    </div>
</body>

</html>