<?php
/* Disable Tags */

add_action('init', 'bstcmfw_remove_tags');

function bstcmfw_remove_tags(){ register_taxonomy('post_tag', array()); }

add_action('init', 'bstcmfw_remove_producttags');

function bstcmfw_remove_producttags(){ register_taxonomy('product_tag', array()); }

//bstcmfw_write_log("bstcmfw-tags module loaded");

?>