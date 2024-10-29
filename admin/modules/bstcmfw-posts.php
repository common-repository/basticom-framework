<?php
/* Disable Posts */

if ( ! function_exists( 'bstcmfw_unregister_post_type' ) ) :
	function bstcmfw_unregister_post_type( $post_type ) {
	    global $wp_post_types;
	    if ( isset( $wp_post_types[ $post_type ] ) ) {
	        unset( $wp_post_types[ $post_type ] );
	        return true;
	    }
	    return false;
	}
endif;

if ( ! function_exists( 'bstcmfw_unregister_taxonomy' ) ) :
	function bstcmfw_unregister_taxonomy( $taxonomy ){
	    global $wp_taxonomies;
	    if ( taxonomy_exists( $taxonomy))
	        unset( $wp_taxonomies[$taxonomy]);
	}
endif;

function bstcmfw_remove_posts_type() {
	bstcmfw_write_log("Removing posts type");
	bstcmfw_unregister_post_type( 'link' );
	bstcmfw_unregister_post_type( 'post' );
	bstcmfw_unregister_taxonomy( 'category' );
	bstcmfw_unregister_taxonomy( 'link_category' );
	
}

bstcmfw_remove_posts_type();

//bstcmfw_write_log("bstcmfw-posts module loaded");

?>