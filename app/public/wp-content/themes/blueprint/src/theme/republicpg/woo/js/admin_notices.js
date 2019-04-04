jQuery( document ).ready( function() {
	
	jQuery( document ).on( 'click', '.republicpg-dismiss-notice .notice-dismiss', function() {
		var data = {
				action: 'republicpg_dismiss_older_woo_templates_notice',
		};
		
		jQuery.post( notice_params.ajaxurl, data, function() {
		});
    
	})
  
});