<?php
/*
Framework specific functions for templates
*/

/* Get most top parent item */
function bstcmfw_get_top_parent( $post ) {
	if ($post->post_parent)	{
		$ancestors=get_post_ancestors($post->ID);
		$root=count($ancestors)-1;
		$parent = $ancestors[$root];
	} else {
		$parent = $post->ID;
	}
	return $parent;
}

/* Load template part */
function bstcmfw_load_template_part( $template_name, $part_name=null ) {
    ob_start();
    get_template_part( $template_name, $part_name );
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

/* Load SVG file */
function bstcmfw_load_svg( $src=false, $class=false ) {
	if (!$src) { return "<em style='color:red;'>Geen bronbestand opgegeven</em>"; }
	$svg = file_get_contents(IMAGEFOLDER."/".$src);
	if ($class) { echo "<div class='{$class}'>"; }
	echo $svg;
	if ($class) { echo "</div>"; }
}


function bstcmfw_is_admin_request() {

	$current_url = home_url( add_query_arg( null, null ) );


	$admin_url = strtolower( admin_url() );
	$referrer  = strtolower( wp_get_referer() );


	if ( 0 === strpos( $current_url, $admin_url ) ) {

		if ( 0 === strpos( $referrer, $admin_url ) ) {
			return true;
		} else {

			if ( function_exists( 'wp_doing_ajax' ) ) {
				return ! wp_doing_ajax();
			} else {
				return ! ( defined( 'DOING_AJAX' ) && DOING_AJAX );
			}
		}
	} else {
		return false;
	}
}

?>
