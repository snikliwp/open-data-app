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
		'title': title
	});
	// To add the marker to the map, call setMap();
	marker.setMap(map);
	// Add a click event listener for the marker
	google.maps.event.addListener(marker, 'click', function() {window.location='single.php?id=' + id; });
} // end setMarker function


function setStars(id, count, response) {
	console.log("this is id response count", id, response, count);
console.log("this is math round response/count", Math.round(response / count));
	if (Math.round(response / count) >= 1 ){
console.log("this is the phrase to modify the star", $('.star1', $('#garden-' + id)).addClass('rated'));
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

