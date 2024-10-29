<?php
/* Gravity Forms anonymize */

add_filter( 'gform_ip_address', '__return_empty_string' );

//bstcmfw_write_log("bstcmfw-gfanonymize module loaded");

?>
