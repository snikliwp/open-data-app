// JavaScript Document
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
}); // end of document ready function
