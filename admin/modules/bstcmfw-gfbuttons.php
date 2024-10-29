<?php
/* Convert GravityForms buttons */

add_filter( 'gform_submit_button', 'bstcmfw_form_submit_button', 10, 5 );

function bstcmfw_form_submit_button ( $button, $form ){
    return "<button class='button' id='gform_submit_button_{$form['id']}'><span>{$form['button']['text']}</span></button>";
}

//bstcmfw_write_log("bstcmfw-gfbuttons module loaded");

?>
