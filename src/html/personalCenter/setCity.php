<?php
$dir = dirname(__FILE__);
$indexOfL=strpos($dir,"src\\html")+8;
$dir=substr($dir,0,$indexOfL)."\\configPHP.php";
require $dir;
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($link, DB_NAME);
mysqli_set_charset($link, "utf8");

$response='';

$countryName=$_GET['countryName'];
$query="select ISO from geocountries where CountryName='$countryName';";
try
{
    $countryISO=mysqli_fetch_row(mysqli_query($link,$query))[0];

    $query="select distinct AsciiName,Population from geocities where CountryCodeISO='$countryISO' order by Population desc ;";
    //$query="select distinct AsciiName from geocities where CountryCodeISO='$countryISO' order by AsciiName asc ;";
    $allCitiesInThisCountry=array_column(mysqli_fetch_all(mysqli_query($link,$query)),0);
    for ($i=0;$i<count($allCitiesInThisCountry);$i++)
    {
        $cityName=$allCitiesInThisCountry[$i];
        $response=$response."<option value='$cityName'></option>";
    }
}
catch (Exception $e)
{

}


echo $response;
