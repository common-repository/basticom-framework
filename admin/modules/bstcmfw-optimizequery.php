<?php
/* Optimize Wordpress queries */

add_action( 'pre_get_posts', 'bstcmfw_pre_optimize_queries' );

function bstcmfw_pre_optimize_queries( $query ) {
	if ( $query->is_main_query() ) {
        $query->set( 'update_post_term_cache', false );
        $query->set( 'update_post_meta_cache', false );
    }
}

//bstcmfw_write_log("bstcmfw-optimizequery module loaded");

?>