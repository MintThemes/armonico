jQuery(document).ready(function($){
	
	//flexslider
	 $('.gallery-box').flexslider({

		animation: 'slide',
		selector: '.gallery > li'
		
	  });
	
	//woocommerce
	$(".thumbnails").appendTo(".summary");
	$(".summary").prepend($(".woocommerce_message"));
	
	//fancybox:
	$( '.variations select' ).selectBox();
	$( '.isotopenav' ).selectBox();

})

