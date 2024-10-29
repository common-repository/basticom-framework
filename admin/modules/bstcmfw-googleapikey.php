<?php
/* Add ACF Google maps API key */

add_action('acf/init', 'bstcmfw_acf_maps_api');

function bstcmfw_acf_maps_api() {
	
	if ( get_option( 'bstcmfw-googleapikey', false, 0 ) ) {
		acf_update_setting( 'google_api_key', get_option( 'bstcmfw-googleapikey', false, 0 ) );
	}
}

//bstcmfw_write_log("bstcmfw-googleapikey module loaded");

?>