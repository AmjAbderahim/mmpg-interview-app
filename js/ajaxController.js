function call(pathServerFile, method, action_type, params) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {

		if (this.readyState == 4 && this.status == 200) {
			// remove loader after response
			removeLoader(0.8);
			var result = JSON.parse(this.responseText);
			if (action_type == "getAll") {
				addCities(result);
			}

			else if (action_type == "getById" || action_type == "getByName") {
				if (result != false) {
					createInfoSelection(result);
					increaseCityVisits(result[0].id)
				}
			}
			
			else if (action_type == "increaseVisits") {
				if (result != false) {
					setHtml("nbv",result[1]);
				}
			}

		}
	};

	// prepare params
	if (typeof params !== 'undefined' || params !== null) {
		var url = pathServerFile + "?action_type=" + action_type;
		for ( var key in params) {
			url += "&" + key + "=" + params[key];
		}
	}
	addLoader("loading.gif");
	xmlhttp.open(method, url, true);
	xmlhttp.send();

}

function getAllCities() {
	call("/data", "GET", "getAll")

}

function getCity(idc) {
	call("/getCityById", "GET", "getById", {"id" : idc});
}
function getCityByName(name) {
	call("/getCityByName", "GET", "getByName", {"name" : name});
}

function increaseCityVisits(id) {	
	call("/increaseVisits", "GET", "increaseVisits", {"id" : id});	
}

