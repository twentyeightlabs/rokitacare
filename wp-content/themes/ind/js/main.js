
jQuery(document).ready(function(){	
	
	

	var BillHeight = jQuery('.navbar').height() / 2;

	jQuery(window).scroll(function(){
		if (jQuery(window).scrollTop() < BillHeight) {
	    	jQuery( "header.fixed_nav" ).stop().animate({
	    		marginTop : '-81px'
			 }, 200);

			 
	    } else {
	    	jQuery( "header.fixed_nav" ).stop().animate({
	    		marginTop : 0
			 }, 200);
	    }

	});

 jQuery(".nav li a:not(.lang)").click(function(event){
 	
jQuery('html, body').animate({
        scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
    }, 500);
    return false;
     });


});