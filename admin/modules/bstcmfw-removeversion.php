<?php
/* Remove version strings from external requests */

add_filter( 'script_loader_src', 'bstcmfw_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'bstcmfw_remove_script_version', 15, 1 );

function bstcmfw_remove_script_version( $src ){
	
	// Skip for Google libraries
	if ( !strpos($src,'google')) {
		$parts = explode( '?', $src );
		return $parts[0];

	} else {
		return $src;

	}
	
}

//bstcmfw_write_log("bstcmfw-removeversion module loaded");

?>