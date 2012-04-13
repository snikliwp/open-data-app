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

function setMarker(lat, long, title, id) {
//	console.log(title);
	var myLatlng = new google.maps.LatLng(lat, long);
	var marker = new google.maps.Marker({
		position: myLatlng,
		icon : 'images/farm-2.png',
		animation: google.maps.Animation.DROP,
		'title': title
	});
	// To add the marker to the map, call setMap();
	marker.setMap(map);
	// Add a click event listener for the marker
	google.maps.event.addListener(marker, 'click', function() {window.location='single.php?id=' + id; });
} // end setMarker function


function setStars(id, count, response) {
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
	if (sortValue == 'close'){
		$('.main').load('dataSortClose.php');
	}
} // end sortData function

function save_cookie(lat, long) {
//	function createCookie(name,value,days) {
	if(!$('#adr').val()) {
	console.log('in save cookie, !#adr = ');
		var date = new Date();
		date.setTime(date.getTime()+(365*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
		document.cookie = 'location'+"="+lat+':'+long+expires+"; path=/";
	} else {
	console.log('in save cookie, #adr = ');
		// Google Maps Geo-coder will take an address and convert it to lat/lng
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
		// Append 'Ottawa, ON' so our users don't have to
			address : $('#adr').val() + ', Ottawa, ON'
			, region : 'CA'
			} // end geocode curly
			, function (results, status) { // tthe geocoder returns a results and status 
				if (status == google.maps.GeocoderStatus.OK) { // check that the status is OK
					save_cookie(results[0].geometry.location.lat(), results[0].geometry.location.lng()); // if so put them on the map
					} //end if
				} // end function
		) //end geo code bracket
	}; // end else
} // end save_cookie function
//)
//	);




$(document).ready (function () {
	document.getElementById("sortForm").addEventListener("submit", sortData, false);
	
	if (navigator.geolocation) { // does browser support geolocation put an else statement that hides the button
		$('body').on('click','#geo', function(ev) {
			// Request access for the current position and wait for the user to grant it
			navigator.geolocation.getCurrentPosition(function (pos) {
				save_cookie(pos.coords.latitude, pos.coords.longitude); 
				}); // end function pos
			});
	} // end if navigator.geolocation
}); // end document ready function
//		}
//	}}


//});