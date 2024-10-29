<?php
/* Gravity Remove After Submit */

function bstcmfw_disable_form_entries() {

	if( get_option('bstcmfw-gform-remove-submission') ) {

		$forms = get_option('bstcmfw-gform-remove-submission');

		foreach($forms as $form) {
			bstcmfw_write_log($form);
			add_action( 'gform_after_submission_'.$form, 'bstcmfw_remove_form_entry' );
		}

	}

	//bstcmfw_write_log("bstcmfw-gform-remove-submission module loaded");

}


function bstcmfw_remove_form_entry($entry) {
	GFAPI::delete_entry( $entry['id'] );
}

?>
