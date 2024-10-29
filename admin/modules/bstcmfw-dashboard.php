<?php
/* Clean-up dashboard */

add_action('wp_dashboard_setup', 'bstcmfw_clean_dashboard_widgets');

function bstcmfw_clean_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['pb_backupbuddy_stats']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
}

//bstcmfw_write_log("bstcmfw-dashboard module loaded");

?>