function sdubris_start_process(sdubris_pre_clean, sdubris_debug, sdubris_limit_list, sdubris_quality) {
	'use strict';
	
	var progressbar = 0;
	var total_files = 0;
	var current_file = 0;
	
	jQuery(".sdubris-progressbar .inner").removeClass( 'complete' );
	
	if ( 1 == sdubris_pre_clean ) {
		console.log("Cleaning existing files");
	}
	
	if ( 1 == sdubris_debug ) {
		console.log("Verbose output enabled");
	}
	
	/* Get list with images */
	jQuery.ajax({
	    type: "POST",
	    url: ajaxurl,
	    cache: false,
	    dataType: 'json',
	    data: ({
		    action:'sdubris_get_images_hook',
		}),
	    success: function(files) {
		    			console.log(files);    
			if ( 'success' == files.result) {
				total_files = files.files.length;
				jQuery(files.files).each(function(key,file) {
					sdubris_resize_image(file, sdubris_limit_list, sdubris_quality);
				});
			}
		},
	});
	
	function sdubris_resize_image(image_file, sdubris_limit_list, sdubris_quality) {
		
		console.log("Processing " + image_file + " / " + sdubris_limit_list + " / " + sdubris_quality);
		
		jQuery.ajax({
		    type: "POST",
		    url: ajaxurl,
		    cache: false,
		    dataType: 'json',
		    data: ({
			    action:'sdubris_resize_image_hook',
			    image_file: image_file,
			    clean: sdubris_pre_clean,
			    quality: sdubris_quality,
			    sizes: sdubris_limit_list,
			}),
		    success: function(data) {
			    console.log("SUCCESS");
				console.log(data);  
			},
		});

	}

	setInterval( function() {
		if ( current_file < total_files ) {
			current_file++;
			progressbar = ( (current_file/total_files) * 100 );
			jQuery(".sdubris-progressbar .inner").animate({'right':100-progressbar+'%'}, 150 );
			jQuery(".sdubris-progressbar .percentage").html(progressbar+'%');
			if ( 100 == progressbar ) { 
				jQuery(".sdubris-progressbar .inner").addClass( 'complete' );
			}
		}
	}, 100 );
		
	return false;
}