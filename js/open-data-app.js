// JavaScript Document
/**
 * This file contains the functions executed by the application
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/
var userLoc = false;

function setMarker(lat, long, title, id) {
//	console.log(title);
	var myLatlng = new google.maps.LatLng(lat, long);
	var marker = new google.maps.Marker({
		position: myLatlng,
		'title': title
	});
	// To add the marker to the map, call setMap();
	marker.setMap(map);
	// Add a click event listener for the marker
	google.maps.event.addListener(marker, 'click', function() {window.location='single.php?id=' + id; });
} // end setMarker function


function setStars(id, count, response) {
	console.log("this is id response count", id, response, count);
	if (Math.round(response / count) >= 1 ){
		$('.star1', $('#garden-' + id)).addClass('rated');
	}
	
	if (Math.round(response / count) >= 2 ){
		$('.star2', $('#garden-' + id)).addClass('rated');
	}
	
	if (Math.round(response / count) >= 3 ){
		$('.star3', $('#garden-' + id)).addClass('rated');
	}
	
	if (Math.round(response / count) >= 4 ){
		$('.star4', $('#garden-' + id)).addClass('rated');
	}
	
	if (Math.round(response / count) >= 5 ){
		$('.star5', $('#garden-' + id)).addClass('rated');
	}
} // end setStars function

function sortData(ev) {
	ev.preventDefault(); // This stops the form submit from sending the data to the server
	//get the information again in the right order
	console.log('in sort data');
	var Index = document.getElementById("sortFormID").selectedIndex;
		console.log('Index:' , Index);
//	document.getElementById("Text").value = 
	var sortName = document.getElementById("sortFormID").options[Index].text;
//	document.getElementById("Value").value = 
	var sortValue = document.getElementById("sortFormID").options[Index].value;
		console.log('sortName:' , sortName);
		console.log('sortValue:' , sortValue);
	
	if (sortValue == 'alpha'){
		$('.main').load('dataSortAlpha.php');
	}
	if (sortValue == 'rate'){
		$('.main').load('dataSortRate.php');
	}
} // end sortData function


//	var myLatlng = new google.maps.LatLng(lat, long);
//	var marker = new google.maps.Marker({
//		position: myLatlng,
//		'title': title
//	});
	// To add the marker to the map, call setMap();
//	marker.setMap(map);
	// Add a click event listener for the marker
//google.maps.event.addListener(marker, 'click', function() {window.location='single.php?id=' + id; });


$(document).ready (function () {
document.getElementById("sortForm").addEventListener("submit", sortData, false);
});