<?php
/* Disable notifications for non-admins */

add_action('init', 'bstcmfw_admin_updates_only');

function bstcmfw_admin_updates_only() {
	global $user_login;
	wp_get_current_user();
	if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins 
		add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
		add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
	}
}

//bstcmfw_write_log("bstcmfw-updatenotifications module loaded");

?>