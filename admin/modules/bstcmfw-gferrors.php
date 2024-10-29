<?php
/* Convert GravityForms errors */

add_filter( 'gform_validation_message', 'bstcmfw_change_gform_error_message', 10, 2 );

function bstcmfw_change_gform_error_message($message, $form) {
	 return $message;
}

//bstcmfw_write_log("bstcmfw-gferrirs module loaded");

?>