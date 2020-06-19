<?php


class imgcompress
{
    private $src;
    private $image;
    private $imageinfo;
    private $percent = 0.5;

    public function __construct($src, $percent = 1)
    {
        $this->src = $src;
        $this->percent = $percent;
    }

    public function compressImg($saveName = '')
    {
        $this->_openImage();
        if (!empty($saveName)) $this->_saveImage($saveName);  //保存
        else $this->_showImage();
    }

    private function _openImage()
    {
        list($width, $height, $type, $attr) = getimagesize($this->src);
        $this->imageinfo = array(
            'width' => $width,
            'height' => $height,
            'type' => image_type_to_extension($type, false),
            'attr' => $attr
        );
        $fun = "imagecreatefrom" . $this->imageinfo['type'];
        $this->image = $fun($this->src);
        $this->_thumpImage();
    }

    private function _thumpImage()
    {
        $new_width = $this->imageinfo['width'] * $this->percent;
        $new_height = $this->imageinfo['height'] * $this->percent;
        $image_thump = imagecreatetruecolor($new_width, $new_height);
        //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度
        imagecopyresampled($image_thump, $this->image, 0, 0, 0, 0, $new_width, $new_height, $this->imageinfo['width'], $this->imageinfo['height']);
        imagedestroy($this->image);
        $this->image = $image_thump;
    }

    private function _showImage()
    {
        header('Content-Type: image/' . $this->imageinfo['type']);
        $funcs = "image" . $this->imageinfo['type'];
        $funcs($this->image);
    }

    private function _saveImage($dstImgName)
    {
        if (empty($dstImgName)) return false;
        $allowImgs = ['.jpg', '.jpeg', '.png', '.bmp', '.wbmp', '.gif'];   //如果目标图片名有后缀就用目标图片扩展名 后缀，如果没有，则用源图的扩展名
        $dstExt = strrchr($dstImgName, ".");
        $sourseExt = strrchr($this->src, ".");
        if (!empty($dstExt)) $dstExt = strtolower($dstExt);
        if (!empty($sourseExt)) $sourseExt = strtolower($sourseExt);

        //有指定目标名扩展名
        if (!empty($dstExt) && in_array($dstExt, $allowImgs))
        {
            $dstName = $dstImgName;
        }
        elseif (!empty($sourseExt) && in_array($sourseExt, $allowImgs))
        {
            $dstName = $dstImgName . $sourseExt;
        }
        else
        {
            $dstName = $dstImgName . $this->imageinfo['type'];
        }
        $funcs = "image" . $this->imageinfo['type'];
        $funcs($this->image, $dstName);
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }
}

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
    function safe_replace($string) {
        $string = str_replace('%20','',$string);
        $string = str_replace('%27','',$string);
        $string = str_replace('%2527','',$string);
        $string = str_replace('*','',$string);
        $string = str_replace('"','&quot;',$string);
        $string = str_replace("'",'',$string);
        $string = str_replace('"','',$string);
        $string = str_replace(';','',$string);
        $string = str_replace('<','&lt;',$string);
        $string = str_replace('>','&gt;',$string);
        $string = str_replace("{",'',$string);
        $string = str_replace('}','',$string);
        $string = str_replace('\\','',$string);
        return $string;
    }
    $description=safe_replace($description);

    //echo $content . $countryName . $cityName . $title . $description . '<br/>';

    $dir = dirname(__FILE__);
    $indexOfL = strpos($dir, "src\\html") + 8;
    $dir = substr($dir, 0, $indexOfL) . "\\configPHP.php";
    require $dir;
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($link, DB_NAME);
    mysqli_set_charset($link, "utf8");
    $uid = $_COOKIE['UID'];
    $password_sha256 = $_COOKIE['password'];
    $query = "select * from traveluser where UID= $uid and Pass = '$password_sha256' ;";
    //echo $query;
    $result = mysqli_query($link, $query);
    if (mysqli_fetch_array($result) == null)
    {
        mysqli_close($link);
        echo "<script>window.location.href='userInfoRelatedPages/login.php';alert('登陆信息错误，请重新登陆')</script>";
    }
    else
    {
        /*echo "Upload: " . $_FILES["file0"]["name"] . "<br />";
        echo "Type: " . $_FILES["file0"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file0"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file0"]["tmp_name"] . "<br />";*/

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
        $initialFileName = $_FILES["file0"]["name"];
        $fileName = getNoneRepeatFileName($link, $initialFileName);
        $dir = dirname(__FILE__);
        $destination = str_replace("src\\html\\personalCenter", "sources\\img\\travel-images\\normal\\medium\\", $dir) . $fileName;
        $size_MB = $_FILES["file0"]["size"] / 1048576.0;
        if ($size_MB < 1)
            move_uploaded_file($_FILES['file0']['tmp_name'], $destination);
        else
            (new imgcompress($_FILES['file0']['tmp_name'],(1.0/sqrt($size_MB))))->compressImg($destination);



        if ($_FILES["file"]["error"] > 0)
        {
            $error = $_FILES["file"]["error"];
            echo '<script>alert("Error: ' . $error . '")</script>';
        }
        else
        {
            echo "<script>alert('上传成功')</script>";
        }


        $query = "insert into travelimage (Title, Description, CityCode, CountryCodeISO, UID, PATH,content) values ('$title','$description',$cityID,'$countryISO',$uid,'$fileName','$content');";
        //echo $query;
        mysqli_query($link, $query);

        mysqli_close($link);

        //$query = "insert into travelimage (Title, Description, CityCode, CountryCodeISO, UID, PATH) values ('$title','$description',$cityID,'$countryISO',$uid,'$fileName')";



        echo "<script>window.location.href='myPhotos.php'</script>";
    }
}
else
    echo "<script>window.location.href='./userInfoRelatedPages/login.php';alert('登陆超时，请重新登陆')</script>"
?>