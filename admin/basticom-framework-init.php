<?php
/*
Load framework modules based on settings
*/

// Write log
require( plugin_dir_path(__FILE__).'/modules/bstcmfw-writelog.php' );

// Services
if ( 1 == get_option( 'bstcmfw-xmlrpc', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-xmlrpc.php' );
}

if ( 1 == get_option( 'bstcmfw-pingbacks', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-pingbacks.php' );
}

if ( 1 == get_option( 'bstcmfw-atom', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-atom.php' );
}

if ( 1 == get_option( 'bstcmfw-emojis', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-emojis.php' );
}

if ( 1 == get_option( 'bstcmfw-manifest', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-manifest.php' );
}

if ( 1 == get_option( 'bstcmfw-comments', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-comments.php' );
}

// Admin interface
if ( 1 == get_option( 'bstcmfw-widgets', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-widgets.php' );
}

if ( 1 == get_option( 'bstcmfw-tags', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-tags.php' );
}

if ( 1 == get_option( 'bstcmfw-posts', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-posts.php' );
}

if ( 1 == get_option( 'bstcmfw-links', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-links.php' );
}

if ( 1 == get_option( 'bstcmfw-dashboard', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-dashboard.php' );
}

if ( 1 == get_option( 'bstcmfw-themeeditor', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-themeeditor.php' );
}

if ( 1 == get_option( 'bstcmfw-cleanadminbar', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-cleanadminbar.php' );
}

if ( 1 == get_option( 'bstcmfw-updatenotifications', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-updatenotifications.php' );
}

// Modifications
if ( 1 == get_option( 'bstcmfw-optimizequery', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-optimizequery.php' );
}

if ( 1 == get_option( 'bstcmfw-gfbuttons', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-gfbuttons.php' );
}

if ( 1 == get_option( 'bstcmfw-gferrors', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-gferrors.php' );
}

if ( 1 == get_option( 'bstcmfw-disableadminbar', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-disableadminbar.php' );
}

if ( 1 == get_option( 'bstcmfw-adddefer', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-adddefer.php' );
}

if ( 1 == get_option( 'bstcmfw-removeversion', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-removeversion.php' );
}

if ( 1 == get_option( 'bstcmfw-jigsaw', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-jigsaw.php' );
}

// Theme support
if ( 1 == get_option( 'bstcmfw-thumbnails', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-thumbnails.php' );
}

if ( 1 == get_option( 'bstcmfw-imagecompression', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-imagecompression.php' );
}

if ( 1 == get_option( 'bstcmfw-woocommerce', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-woocommerce.php' );
}

// Misc
if ( 0 < strlen( get_option( 'bstcmfw-googleapikey', false, 0 ) ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-googleapikey.php' );
}

// Admin footer
if ( 0 < strlen( get_option( 'bstcmfw-footertext', false, 0 ) ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-footertext.php' );
}

if ( 1 == get_option( 'bstcmfw-serverstats', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-serverstats.php' );
}

// Cookie module
require( plugin_dir_path(__FILE__).'/modules/bstcmfw-cookie.php' );

// Gravity Forms anonymize
if ( 1 == get_option( 'bstcmfw-gform-hide-ip', false, 0 ) ) {
	require( plugin_dir_path(__FILE__).'/modules/bstcmfw-gfanonymize.php' );
}

// Gravity Forms remove entry from database
require( plugin_dir_path(__FILE__).'/modules/bstcmfw-gfremove-submission.php' );


?>
