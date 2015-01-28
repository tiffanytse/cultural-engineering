jQuery(document).ready(function($) {
 
	$(function() {
 
		// initiate mmenu
		$("#menu").mmenu({
			offCanvas: {
               position  : "right",
         
            }
		}, {
			// configuration:
			clone : true,
		});

		$('#mm-menu-main-menu').removeClass('genesis-nav-menu');
 
	});
 
});