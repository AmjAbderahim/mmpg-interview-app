function addCities(data) {
	var ul = getElement("cities");
	var container = getElement("container");

	for (var i = 0; i < data.length; i++) {
		var li = appendNewElementToParent(ul, "li");
		li.setAttribute("id",data[i].name+"Li");
		li.setAttribute("onclick", "getCity(" + data[i].id + ");activateTab(this)");
 		// set CityName on the navBar
		setElementHtml(li, data[i].name);
 		// create div for each city (to show Infos)
		var div = appendNewElementToParent(container, "div");
		div.setAttribute("id", data[i].name + "-" + data[i].id)
	}
}



function createInfoSelection(result) {
	 
	showElement(getElement("nbvisits"));
	// info_city rows are stored in info param
	if (typeof result["info"] !== 'undefined' && result["info"] !== null
			&& result["info"].length > 0) {
		var html = createInfoSelect(result["info"]);
		var div = getElement(result[0].name + "-" + result[0].id);
		setElementHtml(div, html)
		var el = getElement("container");
		//hide all divs except the created one
		HideChildsExcept(el, div, "div");
	}
	else             
		generateAlert("info", "There is no informations for this City..!", "icons/icon-info.png", 5);
}


function selectFunction(a) {
	var storedInfos = JSON.parse(localStorage.getItem("infos"));
	a.nextSibling.innerHTML=storedInfos[parseInt(a.value)].details;
		}

 
 