<?php
/* Clean-up adminbar */

add_action('wp_before_admin_bar_render', 'bstcmfw_cleanup_admin_bar', 0);

function bstcmfw_cleanup_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('widgets');
    $wp_admin_bar->remove_menu('themes');
    $wp_admin_bar->remove_menu('background');
    $wp_admin_bar->remove_menu('customize-background');
    $wp_admin_bar->remove_menu('header');
    $wp_admin_bar->remove_menu('customize-header');
    $wp_admin_bar->remove_menu('customize');
}

//bstcmfw_write_log("bstcmfw-cleanadminbar module loaded");

?>