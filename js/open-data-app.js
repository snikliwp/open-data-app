// JavaScript Document

function setMarker(lat, long, title, id) {
//	console.log(title);
	var myLatlng = new google.maps.LatLng(lat, long)
	var marker = new google.maps.Marker({
		position: myLatlng,
		'title': title
	});
	// To add the marker to the map, call setMap();
	marker.setMap(map);
	// Add a click event listener for the marker
	google.maps.event.addListener(marker, 'click', function() {window.location='single.php?id=' + id });
} // end setMarker function


function setStars(id, count, response) {
	console.log(id, response, count);
console.log(Math.round(response / count));
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











$(document).ready(function() {
	
//	$('.tab-group img:not(:first-child)').hide();
	var tabToShow;
	$('.tab-buttons a').on('click', function(ev) {
		tabToShow = $(this).attr('href');
	console.log(tabToShow);	   // will return '#tab-1' when you click on an 'a' button
		$('.current').removeClass("current");
		$(tabToShow).addClass('current'); 
		$(this).addClass('current'); 
	}); // end of '.tab-buttons a' function
// end of document ready function


























}); 
/*		
	$("#next").on("click", function() {
		var current = $(".slides .current").index();

		var next = current + 1;
		
		if (next >= $(".slides img").length) {
			next = 0;
		} // end of if
		$('.slides .current').fadeOut(500,function() {
			$('.slides img')// $('.slides img') creates a list of all the images in the specified classes
			.eq(next)	// eq is the index pointer (next is the value of the pointer of all the slides
			.fadeIn(500)
			.addClass('current'); 
			
			$(this).removeClass("current");
		}); // end function fadeout
	}); // end of next click function
	
	
	$("#prev").on("click", function() {
		var current = $(".slides .current").index();
		var next = current - 1;
		if (next >= $(".slides img").length) {
			next = 0;
		} // end of if
		$('.slides .current').fadeOut(500,function() {
			$('.slides img')// $('.slides img') creates a list of all the images in the specified classes
			.eq(next)	// eq is the index pointer (next is the value of the pointer of all the slides
			.fadeIn(500)
			.addClass('current'); 
			
			$(this).removeClass("current");
		}); // end function fadeout
	}); // end of prev click function
	
	
	/* 
	tabs - position absolute again zindex
	buttons or a element
	easiest way is put a click handler on each tab
	one click handler use an a element <a href = '#tab-id
	
*/	
