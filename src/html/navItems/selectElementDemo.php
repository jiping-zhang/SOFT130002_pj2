<html lang="en">
<body>
<div style="display: none">
    <ul id="cityAndCountryInfo">
        <?php
        $link = mysqli_connect("localhost", "xxx41", "asdfg142857");
        mysqli_set_charset($link, "utf8");
        mysqli_select_db($link, "pj2");

        $query = "select distinct CountryCodeISO from travelimage ;";
        $countryISOArray = array_column(mysqli_fetch_all(mysqli_query($link, $query)), 0);
        $countryNameArray = array();
        for ($i = 0; $i < count($countryISOArray); $i++)
        {
            $query = "select CountryName from geocountries where ISO='" . $countryISOArray[$i] . "';";
            $countryNameArray[$i] = mysqli_fetch_array(mysqli_query($link, $query))[0];
        }
        $cityNameArray = array();
        $cityIDArray = array();
        for ($i = 0; $i < count($countryISOArray); $i++)
        {
            $query = "select distinct CityCode from travelimage where CountryCodeISO='" . $countryISOArray[$i] . "' order by CityCode desc;";
            $cityInThisCountryArray_ID = array_column(mysqli_fetch_all(mysqli_query($link, $query)), 0);
            $cityIDArray[$i] = $cityInThisCountryArray_ID;
            $cityInThisCountryArray_name = array();
            for ($j = 0; $j < count($cityInThisCountryArray_ID); $j++)
            {
                if ($cityInThisCountryArray_ID[$j] != null)
                {
                    $query = "select AsciiName from geocities where GeoNameID=" . $cityInThisCountryArray_ID[$j] . ";";
                    $cityInThisCountryArray_name[$j] = mysqli_fetch_array(mysqli_query($link, $query))[0];
                }
            }
            $cityNameArray[$i] = $cityInThisCountryArray_name;
        }
        for ($i = 0; $i < count($countryISOArray); $i++)
        {
            echo "<li class='countryInfo'>";
            echo "<p class='countryName'>" . $countryNameArray[$i] . "</p>";
            echo "<ul class='allCities'>";
            for ($j = 0; $j < count($cityNameArray[$i]); $j++)
            {
                echo "<li class='cityName'>";
                echo $cityNameArray[$i][$j];
                echo "</li>";
            }
            echo "</ul>";
            echo "</li>";
        }
        mysqli_close($link);
        ?>
    </ul>
</div>
<form>
    <select name="country" id="country" onblur="setCity(this, this.form.city);">
        <option value="0">-- country --</option>
    </select>
    <select name="city" id="city" style="min-width: 160px">
        <option value="0">-- city --</option>
    </select>
</form>
<script>
	const setCity = (function ()
	{
		let cityAndCountryInfo = document.getElementById("cityAndCountryInfo");
		let countryNameArray = [];
		let city = {};
		let countryNameElements = cityAndCountryInfo.getElementsByClassName('countryName');
		for (let i = 0; i < countryNameElements.length; i++)
		{
			countryNameArray.push(countryNameElements[i].innerHTML);
			let cityNameElements = cityAndCountryInfo.getElementsByClassName('countryInfo')[i].getElementsByClassName('cityName');
			let citiesInThisCountry = [];
			for (let j = 0; j < cityNameElements.length; j++)
				citiesInThisCountry.push(cityNameElements[j].innerHTML);
			city[countryNameArray[i]] = citiesInThisCountry;
		}
		countrySelect = document.getElementById("country");
		citySelect = document.getElementById("city");
		for (i = 0; i < countryNameArray.length; i++)
		{
			j = i + 1;
			countrySelect.options[j] = new Option();
			countrySelect.options[j].text = countryNameArray[i];
			countrySelect.options[j].value = countryNameArray[i];
		}
		return function (countrySelect, citySelect)
		{
			var countryValue = countrySelect.value;
			var i, j;
			citySelect.length = 1;
			if (countryValue === '0') return;
			if (typeof (city[countryValue]) == 'undefined') return;
			for (i = 0; i < city[countryValue].length; i++)
			{
				j = i + 1;
				citySelect.options[j] = new Option();
				citySelect.options[j].text = city[countryValue][i];
				citySelect.options[j].value = city[countryValue][i];
			}
		}
	})();
</script>
</body>
</html>