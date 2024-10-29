<?php
/* Disable Links */

add_action( 'admin_menu', 'bstcmfw_remove_links' ); 
function bstcmfw_remove_links() {
     remove_menu_page('link-manager.php');
}

//bstcmfw_write_log("bstcmfw-links module loaded");

?>