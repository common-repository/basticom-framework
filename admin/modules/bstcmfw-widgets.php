<?php
/* Disable Widgets */

add_action('widgets_init', 'bstcmfw_unregister_default_wp_widgets', 1);

function bstcmfw_unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
}

add_action( 'admin_menu', 'bstcmfw_remove_widgets_menu', 999 );

function bstcmfw_remove_widgets_menu() {
  $page = remove_submenu_page( 'themes.php', 'widgets.php' );
}

//bstcmfw_write_log("bstcmfw-widgets module loaded");

?>