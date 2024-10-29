<?php
/* Basticom Cookie */

// If WPML is found, use the WPML language setting.
// Else use the default language: NL
global $bstcmfw_cookie_lang;

if ( function_exists('icl_object_id') ) {
     $bstcmfw_cookie_lang = ICL_LANGUAGE_CODE;
} else {
	$bstcmfw_cookie_lang = substr(get_locale(), 0, 2);
}


// Modify embed if cookie is enabled and consent is false
if( get_option('bstcmfw-cookie-enable') == 1 ) {
	//if ( !isset($_COOKIE['bstcmfw_cookie_accept']) || $_COOKIE['bstcmfw_cookie_accept'] == 0 ) {
		add_filter( 'embed_oembed_html', 'bstcmfw_modify_embed', 99, 4 ); // Modify embed URL, ONLY WHEN CONSENT IS FALSE
	//}
}

// Load and parse cookie HTML
function bstcmfw_cookie_wrapper () {
    global $bstcmfw_cookie_lang;

	// If bstcmfw cookie is enabled, add cookie HTML to WP footer, check if current page != readmore url
	if ( !is_admin() && get_option('bstcmfw-cookie-enable') == 1 && !is_page( get_option( 'bstcmfw-cookie-read-more-link_'.$bstcmfw_cookie_lang, false, 0 ) ) ) { //!isset( $_COOKIE['bstcmfw_cookie_accept'] ) &&


		// Get content of HTML file
		$html_file = file_get_contents( dirname(__FILE__) . '/includes/bstcmfw-cookie.html');

		// Replace accept/decline button strings
		$cookie_text = get_option( 'bstcmfw-cookie-text_'.$bstcmfw_cookie_lang, false, 0 );
		$cookie_text = strtr($cookie_text, array(
			'{{bstcmfw_cookie_accept_button_text}}' 		=> get_option( 'bstcmfw-cookie-accept-button-text_'.$bstcmfw_cookie_lang, false, 0 ),
			'{{bstcmfw_cookie_decline_button_text}}' 		=> get_option( 'bstcmfw-cookie-decline-button-text_'.$bstcmfw_cookie_lang, false, 0 ),
		));

		// Replace HEX to RGB
		list($r, $g, $b) = sscanf(get_option( 'bstcmfw-cookie-wrapper-color', false, 0 ), "#%02x%02x%02x");

		// Replace strings
		$html = strtr($html_file, array(
			'{{bstcmfw_cookie_text}}' 						=> $cookie_text,
			'{{bstcmfw_cookie_wrapper_color}}' 				=> $r.','.$g.','.$b,
			'{{bstcmfw_cookie_accept_button_text}}'			=> get_option( 'bstcmfw-cookie-accept-button-text_'.$bstcmfw_cookie_lang, false, 0 ),
			'{{bstcmfw_cookie_decline_button_text}}' 		=> get_option( 'bstcmfw-cookie-decline-button-text_'.$bstcmfw_cookie_lang, false, 0 ),
			'{{bstcmfw_cookie_accept_button_color}}'		=> get_option( 'bstcmfw-cookie-accept-button-color', false, 0 ),
			'{{bstcmfw_cookie_decline_button_color}}'	 	=> get_option( 'bstcmfw-cookie-decline-button-color', false, 0 ),
			'{{bstcmfw_cookie_text_font_color}}' 			=> get_option( 'bstcmfw-cookie-text-font-color', false, 0 ),
			'{{bstcmfw_cookie_button_font_color}}' 			=> get_option( 'bstcmfw-cookie-button-font-color', false, 0 ),
			'{{bstcmfw_cookie_exdays}}' 					=> get_option( 'bstcmfw-cookie-exdays', false, 0 ),
			'{{bstcmfw_cookie_read_more_button_text}}'	    => get_option( 'bstcmfw-cookie-read-more-button-text_'.$bstcmfw_cookie_lang, false, 0 ),
			'{{bstcmfw_cookie_read_more_link}}' 			=> get_permalink( get_option( 'bstcmfw-cookie-read-more-link_'.$bstcmfw_cookie_lang, false, 0 ) ),
			'{{bstcmfw_cookie_location_setting}}'			=> get_option( 'bstcmfw-cookie-location-setting', false, 0 )
		));

		echo $html;

	}

}
add_action('wp_footer', 'bstcmfw_cookie_wrapper');


// Load cookie scripts
function bstcmfw_load_scripts() {

	// Include CSS and JS file
	wp_enqueue_style( 'bstcmfw-cookie-style', plugin_dir_url( __FILE__ ) . '/includes/bstcmfw-cookie.css' );
	wp_enqueue_script( 'bstcmfw-cookie-script', plugin_dir_url( __FILE__ ) . '/includes/bstcmfw-cookie.js', array('jquery') );

	if ( is_admin() ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'bstcmfw-color-pickerscript-handle', plugins_url( '/includes/bstcmfw-colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}

	// Localize theme specific Javascript functions
	wp_localize_script(
		'bstcmfw-cookie-script',
		'bstcmfw_ajax_cookie',
		array(
			'ajaxurl'  => admin_url( 'admin-ajax.php'),
		),
		'',
		'',
		true
	);

}
add_action( 'wp_enqueue_scripts', 'bstcmfw_load_scripts' );
add_action( 'admin_enqueue_scripts', 'bstcmfw_load_scripts' );



// Get scripts
function bstmcfw_get_scripts() {

    // Check if cookie lang has been posted
    // If cookie_lang is empty, set cookie_lang to default site language
    if( isset( $_POST['cookie_lang'] ) ) {
        $bstcmfw_cookie_lang = $_POST['cookie_lang'];
    } else {
        $bstcmfw_cookie_lang = substr(get_locale(), 0, 2);
    }

    if ( !bstcmfw_is_admin_request() && get_option('bstcmfw-cookie-enable') == 1 ) {
	    $cookie_scripts = array();

    	if ( $_POST['cookie_accept'] == 1 ) {

    		$cookie_scripts['header'] = get_option('bstcmfw-cookie-header-accept-scripts_'.$bstcmfw_cookie_lang);
    		$cookie_scripts['footer'] = get_option('bstcmfw-cookie-footer-accept-scripts_'.$bstcmfw_cookie_lang);

    	} else {

    		$cookie_scripts['header'] = get_option('bstcmfw-cookie-header-decline-scripts_'.$bstcmfw_cookie_lang);
    		$cookie_scripts['footer'] = get_option('bstcmfw-cookie-footer-decline-scripts_'.$bstcmfw_cookie_lang);

    	}

	    echo json_encode($cookie_scripts); die(); // Returned HTML scripts
    }
}
add_action('wp_ajax_get_scripts_hook', 'bstmcfw_get_scripts');
add_action('wp_ajax_nopriv_get_scripts_hook', 'bstmcfw_get_scripts');


// Output default header scripts
function bstcmfw_output_default_scripts_header() {
    global $bstcmfw_cookie_lang;

	if(get_option('bstcmfw-cookie-enable') == 1) {
		if ( !isset($_COOKIE['bstcmfw_cookie_accept']) || $_COOKIE['bstcmfw_cookie_accept'] == 0 ) {
			echo get_option('bstcmfw-cookie-header-decline-scripts_'.$bstcmfw_cookie_lang);
		} else {
			echo get_option('bstcmfw-cookie-header-accept-scripts_'.$bstcmfw_cookie_lang);
		}
	}
}


// Output default footer scripts
function bstcmfw_output_default_scripts_footer() {
    global $bstcmfw_cookie_lang;

	if(get_option('bstcmfw-cookie-enable') == 1) {
		if( !isset($_COOKIE['bstcmfw_cookie_accept']) || $_COOKIE['bstcmfw_cookie_accept'] == 0 ) {
			echo get_option('bstcmfw-cookie-footer-decline-scripts_'.$bstcmfw_cookie_lang);
		} else {
			echo get_option('bstcmfw-cookie-footer-accept-scripts_'.$bstcmfw_cookie_lang);
		}
	}
}


// Custom rewrites
function bstcmfw_custom_rewrites() {

	//add_rewrite_rule('bstcmfw-embed-consent/([^/]*)/?$', 'index.php?post_type=bstcmfw-embed-consent&source=$matches[1]', 'top');
	add_rewrite_rule('bstcmfw-embed-consent/?$', 'index.php?post_type=bstcmfw-embed-consent', 'top');

}


// TEST URL: http://cookiemelding.nl.basticom.nl/bstcmfw-embed-consent/?source=https://www.youtube.com/embed/J10KcbtayNg?feature=oembed
function bstcmfw_url_rewrite_templates() {
    if ( get_query_var( 'bstcmfw_embed_source' ) ) {

        add_filter( 'template_include', function() {
            return dirname(__FILE__) . '/templates/bstcmfw-embed-consent.php';
        });
    }
}


function bstcmfw_custom_query_vars($vars){
	$vars[] = "bstcmfw_embed_source";
	return $vars;
}


// Youtube Embed (ONLY EXECUTE WHEN CONSENT = FALSE)
function bstcmfw_modify_embed($html, $url, $args) {

	$html = str_replace(
		array( 'src="' ),
		array( 'src="'.get_site_url().'/bstcmfw-embed-consent/?bstcmfw_embed_source='),
		$html
	);

	return $html;
}

?>
