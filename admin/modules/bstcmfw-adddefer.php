<?php
/* Add defer tag to scripts */

add_filter('script_loader_tag', 'bstcmfw_script_tag_defer',10,2);

function bstcmfw_script_tag_defer($tag, $handle) {
    
    // Skip for back-end
    if ( is_admin() ) {
        return $tag;
    }
    
    // Skip for jQuery library
    if (strpos($tag, '/wp-includes/js/jquery/jquery')) {
        return $tag;
    }
    
    // Skip for Google maps library
    if (strpos($tag, 'maps.google.com')) {
        return $tag;
    }

	// Skip for Internet Explorer 9
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.') !==false) {
	    return $tag;
    }
    
    else {
        return str_replace(' src',' defer src', $tag);
    }
    
}

//bstcmfw_write_log("bstcmfw-adddefer module loaded");

?>