<?php
/* Disable Atom service */

remove_filter('atom_service_url','atom_service_url_filter');

//bstcmfw_write_log("bstcmfw-atom module loaded");

?>