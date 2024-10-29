<?php
/* Disable header manifest */

	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );


//bstcmfw_write_log("bstcmfw-manifest module loaded");

?>
