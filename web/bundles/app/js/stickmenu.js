jQuery(function($) {
	        $(window).scroll(function(){
	            if($(this).scrollTop()>77){
	                $('#stick_menu').addClass('fixed');
	            }
	            else if ($(this).scrollTop()<77){
	                $('#stick_menu').removeClass('fixed');
	            }
	        });
	    });