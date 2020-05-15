<?php
$dir = dirname(__FILE__);
$indexOfL=strpos($dir,"src\\html")+8;
$dir=substr($dir,0,$indexOfL)."\\configPHP.php";

require $dir;
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

//var_dump($contentFavorTimes);
//echo array_keys($contentFavorTimes)[0];
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

var_dump($hotCities);
var_dump($countryOfHotCities);

mysqli_close($link);
?>
