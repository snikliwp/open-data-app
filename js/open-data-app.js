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
// end of document ready function


function switchTab() {
	
	console.log(tabToShow);	   // will return '#tab-1' when you click on an 'a' button
			

	
}
























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
