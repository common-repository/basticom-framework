<?php
/* Enable SVG updates */

add_filter('upload_mimes', 'bstcmfw_enable_svg');

function bstcmfw_enable_svg($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

//bstcmfw_write_log("bstcmfw-svguploads module loaded");

?>