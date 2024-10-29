<?php
/* Disable XML RPC requests */

add_filter( 'xmlrpc_methods', 'bstcmfw_block_xmlrpc_attacks' );

function bstcmfw_block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}

//bstcmfw_write_log("bstcmfw-xmlrpc module loaded");

?>