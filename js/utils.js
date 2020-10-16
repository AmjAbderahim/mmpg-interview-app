//Dom functions
function getElement(id) {
	return document.getElementById(id);
}

function getValue(id) {
	return document.getElementById(id).value;
}
function setValue(id, val) {
	document.getElementById(id).value = val;
}

function getHtml(id) {
	return document.getElementById(id).innerHTML;
}

function setHtml(id, value) {
	document.getElementById(id).innerHTML = value;
}

function setElementHtml(element, value) {
	element.innerHTML = value;
}

function appendNewElementToParent(Parent, tagName) {
	var node = document.createElement(tagName);
	Parent.appendChild(node);
	return node;
}

function appendHtml(element, html) {
	element.innerHTML += html
}

// Hide-Show Functions
function reverseDisplay(element) {
	if (element.style["display"] == "none") {
		element.style["display"] = "block";
	} else {
		element.style["display"] = "none";
	}
}

function HideChildsExcept(Parent, excludedEl, ChildsTagName) {
	var subs = Parent.getElementsByTagName(ChildsTagName);
	for (var i = 0; i < subs.length; i++) {
		hideElement(subs[i]);
	}
	showElement(excludedEl);

}

function hideElement(element) {
	element.style["display"] = "none";
}
function showElement(element) {
	element.style["display"] = "block";
}

function showHome() {
	var el = getElement("container");
	HideChildsExcept(el, getElement("home"), "div");
	hideElement(getElement("nbvisits"));
	activateTab(getElement("liHome"));
}

function createInfoSelect(infoArray) {

	var html = "<select class='myselect' onchange='selectFunction(this)' >";
	for (var i = 0; i < infoArray.length; i++) {
		html += "<option value='" + i + "'>" + infoArray[i].info_title
				+ "</button>"
	}
	html += "</select><p class='myparagraph'>" + infoArray[0].details + "</p>";
	localStorage.setItem("infos", JSON.stringify(infoArray));
	return html;
}

// loader functions
function addLoader(imageName) {
	getElement("container").style.opacity = 0.1;
	getElement("loading").style.display = "block";
	getElement("loading").innerHTML = "<img src=/images/" + imageName + " />'";
}

function removeLoader(secondes) {
	setTimeout(function() {
		getElement("container").style.opacity = 1;
		getElement("loading").innerHTML = '';
	}, secondes * 1000);

}

var getJSON = function(url, callback) {

	var xhr = new XMLHttpRequest();
	xhr.open('GET', url, true);
	xhr.responseType = 'json';

	xhr.onload = function() {

		var status = xhr.status;

		if (status == 200) {
			callback(null, xhr.response);
		} else {
			callback(status);
		}
	};

	xhr.send();
};

function generateAlert(type, text, imgSrc, secondes) {

	var al = document.createElement("div");
	al.setAttribute("class", type);
	appendHtml(al, "<img class='alertImg' src='/images/" + imgSrc + "'/>  "
			+ text)
	document.body.insertBefore(al, document.body.firstChild);
	setTimeout(function() {
		// remove the alert
		al.remove();
	}, secondes * 1000);
}

function arrayCheckValue(array,value){
	return array.indexOf(value)
}


function activateTab(el){
	//desactivate old tab
	document.getElementsByClassName("active")[0].classList.remove("active");
	el.classList.add("active");	
}