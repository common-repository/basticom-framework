<?php
/* Enable Admin footer text */

add_filter('admin_footer_text', 'bstcmfw_custom_footer');

function bstcmfw_custom_footer () {
	echo "<span style='display:inline-block;width:auto;margin-right:20px;'><i class='fa fa-code' aria-hidden='true'></i> ";
	echo get_option( 'bstcmfw-footertext', false, 0 );
	echo "</span>";
}

//bstcmfw_write_log("bstcmfw-footertext module loaded");

?>
