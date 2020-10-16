<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="/stylesheets/style.css"></link>
<script type="text/javascript" src="/js/utils.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/ajaxController.js"></script>
<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function(event) {
    var cityNames = ['Fez', 'Casablanca', 'Rabat'];
    var city = "";
  //LoadData
    getAllCities();
    function success(position) {
        var url = "https://geocode.xyz/" + position.coords.latitude + "," + position.coords.longitude + "?geoit=json";

        getJSON(url, function(err, data) {
            if (err == null) {
                //to avoid getting a sub place(returned in city value) from the location we use the city name just if there is no principal city data
                if (typeof data?.adminareas?.admin8?.name_en === 'undefined')
                    city = data.city;
                else
                    city = data.adminareas.admin8.name_en;
                //check if city is one of the three cities
                var check = arrayCheckValue(cityNames, city);
                if (check == -1)
                    generateAlert("info", "Welcome , Your City is  <b>" + city + "</b> we will think to add it later..!", "icons/icon-info.png", 4);
                else {
                    generateAlert("success", "Great , Your are from  <b>" + cityNames[check] + "</b> we wish that you enjoy a good user experience..!", "icons/icon-valid.png", 5);
                    //go to city page
                    getCityByName(cityNames[check]);
                    activateTab(getElement(cityNames[check] + "Li"));
                }
            } else
                //getting Data error
                generateAlert("error", "Sorry , we couldn't found the city of Your Location, <u onclick='window.location.reload()'><b>Click here to refresh the page..!</b></u>", "icons/icon-error.png", 8);

        });
    }

    function error(error) {
        if (error.code == 1) {
            //alert for Permission Denied
            generateAlert("error", "We respect your privacy, please feel free to activate the location permission when you want..!", "icons/icon-face.png", 5);

        } else
            generateAlert("error", "Sorry , we couldn't found the city of Your Location, <u onclick='window.location.reload()'><b>Click here to refresh the page..!</b></u>", "icons/icon-error.png", 8);

    }
    
    //Ask for Permission	
    navigator.geolocation.getCurrentPosition(success, error);

});

    </script>
</head>

<body>
	<div id="loading"></div>
	<ul id="cities">
		<li id="liHome" onclick="showHome()" class="active">Home</li>
	</ul>
	<div id="nbvisits" class="nbvisits">
		<img class="imagView" src="./images/icons/icon-view.png" /><span
			id="nbv"></span>
	</div>
	<div id="container">
		<div id="home" class="home"></div>

	</div>
	<footer>
		Made with Love <img class="heartIcon "
			src="/images/icons/icon-heart.png"> in Morocco - Amjida Abderrahim @
		2020
	</footer>
</body>

</html>