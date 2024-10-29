<?php
/* Disable ping backs */



   unset( $headers['X-Pingback'] );
   return $headers;


//bstcmfw_write_log("bstcmfw-pingbacks module loaded");

?>
