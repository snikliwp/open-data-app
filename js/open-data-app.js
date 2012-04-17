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
	var Index = document.getElementById("sortFormID").selectedIndex;
//	document.getElementById("Text").value = 
	var sortName = document.getElementById("sortFormID").options[Index].text;
//	document.getElementById("Value").value = 
	var sortValue = document.getElementById("sortFormID").options[Index].value;
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
		// since the user didn't fill out an address he must want us to find him so 
		// Request access for the current position and wait for the user to grant it
		navigator.geolocation.getCurrentPosition(function (pos) {
			set_user_location(pos.coords.latitude, pos.coords.longitude);
			var date = new Date();
			date.setTime(date.getTime()+(365*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
			document.cookie = 'location'+"="+pos.coords.latitude+':'+pos.coords.longitude+expires+"; path=/";
			}); // end function pos
	} else { // no, he filled something in the field
		// Google Maps Geo-coder will take an address and convert it to lat/lng
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
		// Append 'Ottawa, ON' so our users don't have to
			address : $('#adr').val() + ', Ottawa, ON'
			, region : 'CA'
			} // end geocode curly
			, function (results, status) { // the geocoder returns a results and status 
				// check that the status is OK
				if (status == google.maps.GeocoderStatus.OK) { 
					var date = new Date();
					date.setTime(date.getTime()+(365*24*60*60*1000));
					var expires = "; expires="+date.toGMTString();
					document.cookie = 'location'+"="+results[0].geometry.location.lat()+':'+results[0].geometry.location.lng()+"; path=/";
					
					set_user_location(results[0].geometry.location.lat(), results[0].geometry.location.lng());
					
					} else {
						// put some info in the error div using inner.html
						var elmA = document.getElementById('error');
						var input = 'That does not seem to be a valid address. Either re-enter the address or take it out completely and let the system identify your location.';
						elmA.innerHTML = input; // Either re-enter the address or take it out completely and let the system identify your location.';
					} //end else
				} // end function
		) //end geo code bracket
	}; // end else
	$('.main').load('dataSortClose.php');
} // end save_cookie function


var userMarker;
var userLoc;
// A function to display the user on the Google Map
function set_user_location () {
	var nameEQ = 'location='; // name of cookie we are looking for
	var ca = document.cookie.split(';');// get all the cookies and split them with a ';'
	for(var i=0;i < ca.length;i++) {
		var c = ca[i]; // split all the cookies into seperate cookie
		while (c.charAt(0)==' ') c = c.substring(1,c.length);// get rid of any leading spaces
			if (c.substring(0,9) == nameEQ) { //find the one we are looking for
				var equal = c.indexOf('=');
				var colon = c.indexOf(':');
				var lat = c.substr(equal + 1, colon - equal - 1);
				var long = c.substr(colon + 1);
				userLoc = new google.maps.LatLng(lat, long); // set a new map location
				// Create a new marker on the Google Map for the user
				//  or just reposition the already existent one
				if (userMarker) {
					userMarker.setPosition(userLoc);
				} else {
					userMarker = new google.maps.Marker({
						position : userLoc
						, map : map
						, title : 'You are here.'
						, icon : 'images/home.png'
						, animation: google.maps.Animation.DROP
					});
					userMarker.setMap(map);
				} // end else
				// Center the map on the user's location
					map.setCenter(userLoc);
			} // end if
		} // end while
	return null;
} //end function set_user_location



$(document).ready (function () {
	document.getElementById("sortForm").addEventListener("submit", sortData, false);
	
	if (navigator.geolocation) { // does browser support geolocation put an else statement that hides the button
		$('body').on('click','#geo', function(ev) {
//			navigator.geolocation.getCurrentPosition(function (pos) {
				save_cookie(25, -25); 
				}); // end function pos
//			});
	} // end if navigator.geolocation
}); // end document ready function
//		}
//	}}


//});