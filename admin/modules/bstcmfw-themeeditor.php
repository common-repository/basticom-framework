<?php
/* Disable theme-editor */

add_action( 'admin_menu', 'bstcmfw_remove_themeditor_menu', 999 );

function bstcmfw_remove_themeditor_menu() {
  $page = remove_submenu_page( 'themes.php', 'theme-editor.php' );
}

//bstcmfw_write_log("bstcmfw-themeeditor module loaded");

?>