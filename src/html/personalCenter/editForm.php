<?php
if (isset($_COOKIE['UID']))
{
    $imageID=(int)$_POST["imageID"];
    $changeTimes=(int)$_POST["changeTimes"];
    $uid = $_COOKIE['UID'];
    $content = $_POST['content'];
    $countryName = $_POST['country'];
    $cityName = $_POST['city'];
    $title = $_POST['title'];
    $description = $_POST['description'];



    $link = mysqli_connect("localhost", "xxx41", "asdfg142857");
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, "pj2");

    /*echo "Upload: " . $_FILES["file0"]["name"] . "<br />";
    echo "Type: " . $_FILES["file0"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file0"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file0"]["tmp_name"] . "<br />";*/
    $query="select * from travelimage where ImageID=$imageID;";
    $initialImgInfo=mysqli_fetch_assoc(mysqli_query($link,$query));

    $query = "select ISO from geocountries where lower(CountryName)=lower('" . $countryName . "');";
    try
    {
        $countryISO = mysqli_fetch_row(mysqli_query($link, $query))[0];
    } catch (Exception $exception)
    {
        $countryISO=$initialImgInfo['CountryCodeISO'];
    }


    $query = "select GeoNameID from geocities where CountryCodeISO='" . $countryISO . "' and lower(AsciiName)=lower('" . $cityName . "');";
    try
    {
        $cityID = mysqli_fetch_row(mysqli_query($link, $query))[0];
    } catch (Exception $exception)
    {
        $cityID=$initialImgInfo['cityCode'];
    }

/*    $initialFileName = $_FILES["file0"]["name"];
    $fileName = getNoneRepeatFileName($link, $initialFileName);
    $dir = dirname(__FILE__);
    $destination = str_replace("src\\html\\personalCenter", "sources\\img\\travel-images\\normal\\medium\\", $dir) . $fileName;
    move_uploaded_file($_FILES['file0']['tmp_name'], $destination);

    $query = "insert into travelimage (Title, Description, CityCode, CountryCodeISO, UID, PATH) values ('$title','$description',$cityID,'$countryISO',$uid,'$fileName')";
    echo $query;
    mysqli_query($link, $query);*/
    if ($changeTimes==1)
    {
        $uploadFileName = $_FILES["file0"]["name"];
        $initialFileName=$initialImgInfo['PATH'];
        $dotPosition = stripos($uploadFileName, ".");
        $suffix = substr($uploadFileName, $dotPosition);
        $dotPosition = stripos($initialFileName, ".");
        $fileNumberString=substr($initialFileName,0,$dotPosition);
        $newFileName=$fileNumberString.$suffix;
        $dir = dirname(__FILE__);
        $destination = str_replace("src\\html\\personalCenter", "sources\\img\\travel-images\\normal\\medium\\", $dir) . $newFileName;
        move_uploaded_file($_FILES['file0']['tmp_name'], $destination);
    }
    $query="update travelimage set Title='$title' , Description='$description' , CityCode=$cityID, CountryCodeISO='$countryISO' where ImageID=$imageID";
    mysqli_query($link,$query);

    echo "<script>window.location.href='myPhotos.php'</script>";

    mysqli_close($link);
}
else
    echo "<script>window.location.href='./login.php';alert('登陆超时，请重新登陆')</script>";