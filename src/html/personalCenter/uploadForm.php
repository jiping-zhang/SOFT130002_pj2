<?php
function getNoneRepeatFileName($link, $initialFileName)
{
    $query = "select PATH from travelimage";
    $result = mysqli_query($link, $query);
    $array = array_column(mysqli_fetch_all($result), 0);
    $numberArray = array();
    for ($i = 0; $i < count($array); $i++)
    {
        $dotPosition = stripos($array[$i], ".");
        $numSubString = substr($array[$i], 0, $dotPosition);
        array_push($numberArray, (int)$numSubString);
    }
    $dotPosition = stripos($initialFileName, ".");
    $suffix = substr($initialFileName, $dotPosition);
    do
    {
        $finalNum = rand(1000000000, 10000000000);
    } while (in_array($finalNum, $numberArray));
    return $finalNum . $suffix;
}

if (isset($_COOKIE['UID']))
{
    $uid = $_COOKIE['UID'];
    $content = $_POST['content'];
    $countryName = $_POST['country'];
    $cityName = $_POST['city'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    echo $content . $countryName . $cityName . $title . $description . '<br/>';

    $link = mysqli_connect("localhost", "xxx41", "asdfg142857");
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, "pj2");

    /*echo "Upload: " . $_FILES["file0"]["name"] . "<br />";
    echo "Type: " . $_FILES["file0"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file0"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file0"]["tmp_name"] . "<br />";*/

    $initialFileName = $_FILES["file0"]["name"];
    $fileName = getNoneRepeatFileName($link, $initialFileName);
    $dir = dirname(__FILE__);
    $destination = str_replace("src\\html\\personalCenter", "sources\\img\\travel-images\\normal\\medium\\", $dir) . $fileName;
    move_uploaded_file($_FILES['file0']['tmp_name'], $destination);


    $query = "select ISO from geocountries where lower(CountryName)=lower('" . $countryName . "');";
    try
    {
        $countryISO = mysqli_fetch_row(mysqli_query($link, $query))[0];
    } catch (Exception $exception)
    {
        echo "<script>window.location.href='upload.php';alert('please enter right country name!')</script>";
    }


    $query = "select GeoNameID from geocities where CountryCodeISO='" . $countryISO . "' and lower(AsciiName)=lower('" . $cityName . "');";
    try
    {
        $cityID = mysqli_fetch_row(mysqli_query($link, $query))[0];
    } catch (Exception $exception)
    {
        echo "<script>window.location.href='upload.php';alert('please enter right city name!')</script>";
    }

    $query = "insert into travelimage (Title, Description, CityCode, CountryCodeISO, UID, PATH) values ('$title','$description',$cityID,'$countryISO',$uid,'$fileName')";
    echo $query;
    mysqli_query($link, $query);

    echo "<script>window.location.href='myPhotos.php'</script>";

    mysqli_close($link);
}
else
    echo "<script>window.location.href='./login.php';alert('登陆超时，请重新登陆')</script>"
?>