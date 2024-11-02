<?php
/*
Plugin Name: Basticom Framework
Plugin URI: https://www.basticom.nl
Description: WordPress framework
Version: 1.5.1
Author: Basticom
Author URI: http://www.basticom.nl
License: GPL2
Textdomain: basticom-framework
*/

// SETUP
function bstcm_install(){
    //Do some installation work
}
register_activation_hook(__FILE__,'bstcm_install');

// ACTIONS
add_action('admin_init',            'bstcmfw_admin_init');
add_action('init',                  'bstcmfw_init');
add_action('init',                  'bstcmfw_disable_form_entries' );
add_action('init',                  'bstcmfw_custom_rewrites');
add_action('template_redirect',     'bstcmfw_url_rewrite_templates' );
add_action('plugins_loaded',        'bstcmfw_load_textdomain', 12 );
add_action('admin_menu',            'bstcmfw_register_menu_page' );
add_action('admin_enqueue_scripts', 'bstcmfw_admin_scripts');

// FILTERS
add_filter('query_vars',            'bstcmfw_custom_query_vars' );

// LOAD SCRIPTS
function bstcmfw_admin_scripts() {

    wp_register_script('bstcmfw_js_functions',plugin_dir_url( __FILE__ ).'admin/basticom-framework-js.js');
    wp_localize_script( 'bstcmfw_js_functions', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script('bstcmfw_js_functions');

    wp_register_style( 'fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css' );
    wp_enqueue_style( 'fontawesome' );

    wp_register_style( 'bstcmfw_css', plugin_dir_url( __FILE__ ).'admin/basticom-framework-css.css');
    wp_enqueue_style( 'bstcmfw_css' );

}

// LOAD FUNCTIONS
function bstcmfw_init() {

	include('admin/basticom-framework-init.php');
	include('admin/basticom-framework-functions.php');

}


// If WPML is found, use the WPML language setting.
// Else use the default site language
global $bstcmfw_cookie_lang;

if ( function_exists('icl_object_id') ) {
     $bstcmfw_cookie_lang = ICL_LANGUAGE_CODE;
} else {
    $bstcmfw_cookie_lang = substr(get_locale(), 0, 2);
}


function bstcmfw_admin_init(){

    global $bstcmfw_cookie_lang;

	include('admin/basticom-framework-forms.php');

    register_setting( 'bstcmfw-settings', 'bstcmfw-xmlrpc' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-pingbacks' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-atom' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-emojis' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-manifest' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-comments' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-widgets' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-tags' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-links' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-posts' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-dashboard' );

    register_setting( 'bstcmfw-settings', 'bstcmfw-themeeditor' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-cleanadminbar' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-updatenotifications' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-optimizequery' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-gfbuttons' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-gferrors' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-disableadminbar' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-adddefer' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-removeversion' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-jigsaw' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-thumbnails' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-imagecompression' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-woocommerce' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-footertext' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-serverstats' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-googleapikey' );
    register_setting( 'bstcmfw-settings', 'bstcmfw-company' );

	// Cookie fields
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-enable' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-text_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-wrapper-color' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-accept-button-text_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-decline-button-text_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-accept-button-color' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-decline-button-color' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-text-font-color' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-button-font-color' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-exdays' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-footer-accept-scripts_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-footer-decline-scripts_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-header-accept-scripts_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-header-decline-scripts_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-read-more-button-text_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-read-more-link_'.$bstcmfw_cookie_lang );
	register_setting( 'bstcmfw-settings', 'bstcmfw-cookie-location-setting' );

	// Gravity Forms anonymize
	register_setting( 'bstcmfw-settings', 'bstcmfw-gform-hide-ip' );
	register_setting( 'bstcmfw-settings', 'bstcmfw-gform-remove-submission' );

	// iFrame embed
	register_setting('bstcmfw-settings', 'bstcmfw-gform-iframe-background-color');
	register_setting('bstcmfw-settings', 'bstcmfw-gform-iframe-text-color');
	register_setting('bstcmfw-settings', 'bstcmfw-gform-iframe-text_'.$bstcmfw_cookie_lang );
	register_setting('bstcmfw-settings', 'bstcmfw-gform-iframe-button-text_'.$bstcmfw_cookie_lang );
}

// TRANSLATIONS
function bstcmfw_load_textdomain() {
	load_plugin_textdomain( 'basticom-framework', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

// GET WHITELABEL NAME
function bstcmfw_get_whitelabel_name() {
	if ( !empty(get_option( 'bstcmfw-company', false, 0 )) ) {
	    return get_option( 'bstcmfw-company', false, 0 );
	} else {
		return "Basticom";
	}
}

// ADD WP-ADMIN MENU PAGE
function bstcmfw_register_menu_page() {

    add_submenu_page(
	    'options-general.php',
        __( bstcmfw_get_whitelabel_name().' framework', 'bstcmfw' ),
        bstcmfw_get_whitelabel_name(),
        'manage_options',
        'basticom-framework-api/admin/basticom-framework-admin.php',
        'bstcmfw_page',
        'dashicons-editor-kitchensink',
        80
    );

}

// BUILD CONFIGURATION PAGE
function bstcmfw_page() {

    global $bstcmfw_cookie_lang;

    ?>
	<div class="wrap bstcmfw-wrap">
		<h2><?php echo bstcmfw_get_whitelabel_name(); ?> <?php _e( 'framework', 'basticom-framework' ); ?></h2>
		<p>&nbsp;</p>

		<h2><?php _e( 'Introduction', 'basticom-framework' ); ?></h2>
		<p><?php _e( 'The', 'basticom-framework' ); ?> <?php echo bstcmfw_get_whitelabel_name(); ?> <?php _e( 'framework plugin allows you to modify certain core functions of Wordpress as well as finetune some additional settings. Furthermore, this framework provides a set of easy to use PHP functions (instructions) to use within your theme.', 'basticom-framework' ); ?></p>
		<p>&nbsp;</p>

		<h2><?php _e( 'Framework settings', 'basticom-framework' ); ?></h2>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'bstcmfw-settings' );
			do_settings_sections( 'bstcmfw-settings' );
			?>

			<table class="form-table">
			    <tr valign="top">
				    <th scope="row"><i class="fa fa-wifi fa-fw" aria-hidden="true"></i> <?php _e( 'Services', 'basticom-framework' ); ?></th>
				    <td class="bstcmfw-columns-2">
					    <label for="bstcmfw-xmlrpc">
						    <input type="checkbox" value="1" name="bstcmfw-xmlrpc" id="bstcmfw-xmlrpc" <?php if ( 1 == get_option( 'bstcmfw-xmlrpc', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable XMLRPC', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-pingbacks">
						    <input type="checkbox" value="1" name="bstcmfw-pingbacks" id="bstcmfw-pingbacks" <?php if ( 1 == get_option( 'bstcmfw-pingbacks', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable pingbacks', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-atom">
						    <input type="checkbox" value="1" name="bstcmfw-atom" id="bstcmfw-atom" <?php if ( 1 == get_option( 'bstcmfw-atom', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable atom', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-emojis">
						    <input type="checkbox" value="1" name="bstcmfw-emojis" id="bstcmfw-emojis" <?php if ( 1 == get_option( 'bstcmfw-emojis', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable emoji\'s', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-manifest">
						    <input type="checkbox" value="1" name="bstcmfw-manifest" id="bstcmfw-manifest" <?php if ( 1 == get_option( 'bstcmfw-manifest', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable manifest', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-comments">
						    <input type="checkbox" value="1" name="bstcmfw-comments" id="bstcmfw-comments" <?php if ( 1 == get_option( 'bstcmfw-comments', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable comments', 'basticom-framework' ); ?>
						</label>
					</td>
			    </tr>
			    <tr valign="top">
				    <th scope="row"><i class="fa fa-desktop fa-fw" aria-hidden="true"></i> <?php _e( 'Admin interface', 'basticom-framework' ); ?></th>
				    <td class="bstcmfw-columns-2">
					    <label for="bstcmfw-widgets">
						  <input type="checkbox" value="1" name="bstcmfw-widgets" id="bstcmfw-widgets" <?php if ( 1 == get_option( 'bstcmfw-widgets', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable widgets', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-tags">
						  <input type="checkbox" value="1" name="bstcmfw-tags" id="bstcmfw-tags" <?php if ( 1 == get_option( 'bstcmfw-tags', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable tags', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-links">
						  <input type="checkbox" value="1" name="bstcmfw-links" id="bstcmfw-links" <?php if ( 1 == get_option( 'bstcmfw-links', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable links', 'basticom-framework' ); ?>
						</label>
					  <label for="bstcmfw-posts">
						  <input type="checkbox" value="1" name="bstcmfw-posts" id="bstcmfw-posts" <?php if ( 1 == get_option( 'bstcmfw-posts', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable posts', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-dashboard">
						  <input type="checkbox" value="1" name="bstcmfw-dashboard" id="bstcmfw-dashboard" <?php if ( 1 == get_option( 'bstcmfw-dashboard', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Clean-up dashboard panels', 'basticom-framework' ); ?>
						</label>
					  <label for="bstcmfw-themeeditor">
						  <input type="checkbox" value="1" name="bstcmfw-themeeditor" id="bstcmfw-themeeditor" <?php if ( 1 == get_option( 'bstcmfw-themeeditor', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable theme editor', 'basticom-framework' ); ?>
						</label>
					  <label for="bstcmfw-cleanadminbar">
						  <input type="checkbox" value="1" name="bstcmfw-cleanadminbar" id="bstcmfw-cleanadminbar" <?php if ( 1 == get_option( 'bstcmfw-cleanadminbar', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Clean-up admin bar', 'basticom-framework' ); ?>
						</label>
					  <label for="bstcmfw-updatenotifications">
						  <input type="checkbox" value="1" name="bstcmfw-updatenotifications" id="bstcmfw-updatenotifications" <?php if ( 1 == get_option( 'bstcmfw-updatenotifications', false, 0 ) ) { ?>checked="checked"<?php } ?> />
							<?php _e( 'Disable update notifications', 'basticom-framework' ); ?>
						</label>
					</td>
			    </tr>
			    <tr valign="top">
				    <th scope="row"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <?php _e( 'Modifications', 'basticom-framework' ); ?></th>
				    <td class="bstcmfw-columns-2">
					    <label for="bstcmfw-optimizequery">
						    <input type="checkbox" value="1" name="bstcmfw-optimizequery" id="bstcmfw-optimizequery" <?php if ( 1 == get_option( 'bstcmfw-optimizequery', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Optimize WP_Query', 'basticom-framework' ); ?>
							</label>
					    <label for="bstcmfw-gfbuttons">
						    <input type="checkbox" value="1" name="bstcmfw-gfbuttons" id="bstcmfw-gfbuttons" <?php if ( 1 == get_option( 'bstcmfw-gfbuttons', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Convert Gravity Forms buttons', 'basticom-framework' ); ?>
							</label>
					    <label for="bstcmfw-gferrors">
						    <input type="checkbox" value="1" name="bstcmfw-gferrors" id="bstcmfw-gferrors" <?php if ( 1 == get_option( 'bstcmfw-gferrors', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Convert Gravity Forms errors', 'basticom-framework' ); ?>
							</label>
					    <label for="bstcmfw-disableadminbar">
						    <input type="checkbox" value="1" name="bstcmfw-disableadminbar" id="bstcmfw-disableadminbar" <?php if ( 1 == get_option( 'bstcmfw-disableadminbar', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Disable admin bar for users', 'basticom-framework' ); ?>
							</label>
					    <label for="bstcmfw-adddefer">
						    <input type="checkbox" value="1" name="bstcmfw-adddefer" id="bstcmfw-adddefer" <?php if ( 1 == get_option( 'bstcmfw-adddefer', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Add defer tag to scripts', 'basticom-framework' ); ?>
							</label>
					    <label for="bstcmfw-removeversion">
						    <input type="checkbox" value="1" name="bstcmfw-removeversion" id="bstcmfw-removeversion" <?php if ( 1 == get_option( 'bstcmfw-removeversion', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Remove script version strings', 'basticom-framework' ); ?>
							</label>
					    <label for="bstcmfw-jigsaw">
						    <input type="checkbox" value="1" name="bstcmfw-jigsaw" id="bstcmfw-jigsaw" <?php if ( 1 == get_option( 'bstcmfw-jigsaw', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Enable Jigsaw framework', 'basticom-framework' ); ?>
						</label>
					</td>
			    </tr>

				<tr valign="top">
				    <th scope="row"><i class="fa fa-life-ring fa-fw" aria-hidden="true"></i> <?php _e( 'Theme support', 'basticom-framework' ); ?></th>
				    <td class="bstcmfw-columns-2">
					    <label for="bstcmfw-thumbnails">
						    <input type="checkbox" value="1" name="bstcmfw-thumbnails" id="bstcmfw-thumbnails" <?php if ( 1 == get_option( 'bstcmfw-thumbnails', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Thumbnails support', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-imagecompression">
						    <input type="checkbox" value="1" name="bstcmfw-imagecompression" id="bstcmfw-imagecompression" <?php if ( 1 == get_option( 'bstcmfw-imagecompression', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Advanced image compression', 'basticom-framework' ); ?>
						</label>
					    <label for="bstcmfw-woocommerce">
						    <input type="checkbox" value="1" name="bstcmfw-woocommerce" id="bstcmfw-woocommerce" <?php if ( 1 == get_option( 'bstcmfw-woocommerce', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'WooCommerce support', 'basticom-framework' ); ?>
						</label>
					</td>
			    </tr>

				<tr valign="top">
				    <th scope="row"><i class="fa fa-check fa-fw" aria-hidden="true"></i> <?php _e( 'Misc', 'basticom-framework' ); ?></th>
				    <td class="bstcmfw-columns-1">
					    <label for="bstcmfw-googleapikey">
					    	<span class="bstcmfw-column-label"><?php _e( 'ACF Google maps API', 'basticom-framework' ); ?></span>
						    <input type="text" size="65" value="<?php echo get_option( 'bstcmfw-googleapikey', false, 0 ); ?>" name="bstcmfw-googleapikey" id="bstcmfw-googleapikey" />
						</label>
					</td>
				    <td class="bstcmfw-columns-1">
					    <label for="bstcmfw-company">
					    	<span class="bstcmfw-column-label"><?php _e( 'Whitelabel name', 'basticom-framework' ); ?></span>
						    <input type="text" size="65" value="<?php echo get_option( 'bstcmfw-company', false, 0 ); ?>" name="bstcmfw-company" id="bstcmfw-company" />
						</label>
					</td>
			    </tr>

			    <tr valign="top">
				    <th scope="row"><i class="fa fa-copyright fa-fw" aria-hidden="true"></i> <?php _e( 'Footer', 'basticom-framework' ); ?></th>
				    <td class="bstcmfw-columns-1">
						   <label for="bstcmfw-footertext">
						    <span class="bstcmfw-column-label"><?php _e( 'Footer text', 'basticom-framework' ); ?></span>
						    <input type="text" size="65" value="<?php echo get_option( 'bstcmfw-footertext', false, 0 ); ?>" name="bstcmfw-footertext" id="bstcmfw-footertext" />
							</label>
					    <label for="bstcmfw-serverstats">
						    <input type="checkbox" value="1" name="bstcmfw-serverstats" id="bstcmfw-serverstats" <?php if ( 1 == get_option( 'bstcmfw-serverstats', false, 0 ) ) { ?>checked="checked"<?php } ?> />
								<?php _e( 'Show server stats', 'basticom-framework' ); ?>
							</label>
						</td>
			    </tr>
				</table>

				<h2><?php _e( 'GDPR Settings', 'basticom-framework' ); ?></h2>

				<table class="form-table">

					<tr valign="top">

						<th scope="row"><i class="fa fa-user-secret" aria-hidden="true"></i> <?php _e( 'Cookie consent', 'basticom-framework' ); ?></th>

						<td class="bstcmfw-columns-1">
							<label for="bstcmfw-cookie-enable" onClick="bstcmfw_toggle_cookiebar();">
									<input type="checkbox" value="1" name="bstcmfw-cookie-enable" id="bstcmfw-cookie-enable" <?php if ( 1 == get_option( 'bstcmfw-cookie-enable', false, 0 ) ) { ?>checked="checked"<?php } ?> />
									<?php _e( 'Enable cookie message', 'basticom-framework' ); ?>
							</label>

							<div id="bstcmfw-cookie-collapse-div">
								<label for="bstcmfw-cookie-text">
										<span class="bstcmfw-column-label"><?php _e( 'Cookie text', 'basticom-framework' ); ?></span>
                                        <textarea rows="5" cols="54" name="bstcmfw-cookie-text_<?php echo $bstcmfw_cookie_lang; ?>" id="bstcmfw-cookie-text"><?php echo (get_option( 'bstcmfw-cookie-text_'.$bstcmfw_cookie_lang, false, 0 )? get_option( 'bstcmfw-cookie-text_'.$bstcmfw_cookie_lang, false, 0 ) : "Onze website maakt gebruik van cookies en daarmee vergelijkbare technieken. Klik op '{{bstcmfw_cookie_accept_button_text}}' om toestemming te geven voor het plaatsen van cookies."); ?></textarea>
								</label>
								<label for="bstcmfw-cookie-accept-button-text">
										<span class="bstcmfw-column-label"><?php _e( 'Accept button text', 'basticom-framework' ); ?></span>
										<input type="text" name="bstcmfw-cookie-accept-button-text_<?php echo $bstcmfw_cookie_lang; ?>" value="<?php echo (get_option( 'bstcmfw-cookie-accept-button-text_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-cookie-accept-button-text_'.$bstcmfw_cookie_lang, false, 0 ): 'Ik ga akkoord'); ?>" id="bstcmfw-cookie-accept-button-text">
								</label>
								<label for="bstcmfw-cookie-decline-button-text">
										<span class="bstcmfw-column-label"><?php _e( 'Decline button text', 'basticom-framework' ); ?></span>
										<input type="text" name="bstcmfw-cookie-decline-button-text_<?php echo $bstcmfw_cookie_lang; ?>" value="<?php echo (get_option( 'bstcmfw-cookie-decline-button-text_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-cookie-decline-button-text_'.$bstcmfw_cookie_lang, false, 0 ) : 'Niet akkoord'); ?>" id="bstcmfw-cookie-decline-button-text">
								</label>
								<label for="bstcmfw-cookie-read-more-button-text">
										<span class="bstcmfw-column-label"><?php _e( 'Read more button text', 'basticom-framework' ); ?></span>
										<input type="text" name="bstcmfw-cookie-read-more-button-text_<?php echo $bstcmfw_cookie_lang; ?>" value="<?php echo (get_option( 'bstcmfw-cookie-read-more-button-text_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-cookie-read-more-button-text_'.$bstcmfw_cookie_lang, false, 0 ) : 'Lees meer over cookies'); ?>" id="bstcmfw-cookie-read-more-button-text">
								</label>
								<label for="bstcmfw-cookie-exdays">
										<span class="bstcmfw-column-label"><?php _e( 'Cookie expire', 'basticom-framework' ); ?></span>
										<select name="bstcmfw-cookie-exdays" id="bstcmfw-cookie-exdays">
											<option <?php if( get_option( 'bstcmfw-cookie-exdays', false, 0 ) == 1){ echo " selected='selected' "; } ?> value="1"><?php _e( '1 day', 'basticom-framework' ); ?></option>
											<option <?php if( get_option( 'bstcmfw-cookie-exdays', false, 0 ) == 7){ echo " selected='selected' "; } ?> value="7"><?php _e( '1 week', 'basticom-framework' ); ?></option>
											<option <?php if( get_option( 'bstcmfw-cookie-exdays', false, 0 ) == 30){ echo " selected='selected' "; } if( !get_option( 'bstcmfw-cookie-exdays', false, 0 ) ){ echo " selected='selected' "; } ?> value="30"><?php _e( '1 month', 'basticom-framework' ); ?></option>
											<option <?php if( get_option( 'bstcmfw-cookie-exdays', false, 0 ) == 365){ echo " selected='selected' "; } ?> value="365"><?php _e( '1 year', 'basticom-framework' ); ?></option>
										</select>
								</label>

								<label for="bstcmfw-cookie-read-more-link">
									<span class="bstcmfw-column-label"><?php _e( 'Read more link', 'basticom-framework' ); ?></span>
									<?php
                                    wp_dropdown_pages(
                                        array(
                                            'depth'                 => 0,
                                            'child_of'              => 0,
                                            'selected'              => get_option('bstcmfw-cookie-read-more-link_'.$bstcmfw_cookie_lang),
                                            'echo'                  => 1,
                                            'name'                  => 'bstcmfw-cookie-read-more-link_'.$bstcmfw_cookie_lang,
                                            'id'                    => null, // string
                                            'class'                 => null, // string
                                            'show_option_none'      => null, // string
                                            'show_option_no_change' => null, // string
                                            'option_none_value'     => null, // string
                                            'post_type' 			=> 'page',
                                        )
                                    );
                                    ?>
								</label>

								<label for="bstcmfw-cookie-location-setting">
									<span class="bstcmfw-column-label"><?php _e( 'Cookie message location', 'basticom-framework' ); ?></span>
									<select name="bstcmfw-cookie-location-setting" id="bstcmfw-cookie-location-setting">
                                        <option <?php if( get_option( 'bstcmfw-cookie-location-setting', false, 0 ) == 'header'){ echo " selected='selected' "; } ?> value="header"><?php _e( 'Header', 'basticom-framework' ); ?></option>
                                        <option <?php if( get_option( 'bstcmfw-cookie-location-setting', false, 0 ) == 'center'){ echo " selected='selected' "; } ?> value="center"><?php _e( 'Center', 'basticom-framework' ); ?></option>
                                        <option <?php if( get_option( 'bstcmfw-cookie-location-setting', false, 0 ) == 'footer'){ echo " selected='selected' "; } if( !get_option( 'bstcmfw-cookie-location-setting', false, 0 ) ){ echo " selected='selected' "; } ?> value="footer"><?php _e( 'Footer', 'bstcmfw' ); ?></option>
									 </select>
								</label>

								<label for="bstcmfw-cookie-wrapper-color">
									<span class="bstcmfw-column-label"><?php _e( 'Background color', 'basticom-framework' ); ?></span>
								</label>

								<input class="color-field" type="text" value="<?php echo (get_option( 'bstcmfw-cookie-wrapper-color', false, 0 ) ? get_option( 'bstcmfw-cookie-wrapper-color', false, 0 ) : '#353535'); ?>" name="bstcmfw-cookie-wrapper-color" id="bstcmfw-cookie-wrapper-color" />

								<label for="bstcmfw-cookie-accept-button-color">
									<span class="bstcmfw-column-label"><?php _e( 'Accept button color', 'basticom-framework' ); ?></span>
								</label>

                                <input class="color-field" type="text" value="<?php echo (get_option( 'bstcmfw-cookie-accept-button-color', false, 0 ) ? get_option( 'bstcmfw-cookie-accept-button-color', false, 0 ) : '#57a83e'); ?>" name="bstcmfw-cookie-accept-button-color" id="bstcmfw-cookie-accept-button-color" />

								<label for="bstcmfw-cookie-decline-button-color">
									<span class="bstcmfw-column-label"><?php _e( 'Decline button color', 'basticom-framework' ); ?></span>
								</label>

                                <input class="color-field" type="text" value="<?php echo (get_option( 'bstcmfw-cookie-decline-button-color', false, 0 ) ? get_option( 'bstcmfw-cookie-decline-button-color', false, 0 ) : ''); ?>" name="bstcmfw-cookie-decline-button-color" id="bstcmfw-cookie-decline-button-color" />

                                <label for="bstcmfw-cookie-text-font-color">
									<span class="bstcmfw-column-label"><?php _e( 'Text font color', 'basticom-framework' ); ?></span>
								</label>

                                <input class="color-field" type="text" value="<?php echo (get_option( 'bstcmfw-cookie-text-font-color', false, 0 ) ? get_option( 'bstcmfw-cookie-text-font-color', false, 0 ) : '#ffffff'); ?>" name="bstcmfw-cookie-text-font-color" id="bstcmfw-cookie-text-font-color" />

								<label for="bstcmfw-cookie-button-font-color">
									<span class="bstcmfw-column-label"><?php _e( 'Button font color', 'basticom-framework' ); ?></span>
								</label>

                                <input class="color-field" type="text" value="<?php echo (get_option( 'bstcmfw-cookie-button-font-color', false, 0 ) ? get_option( 'bstcmfw-cookie-button-font-color', false, 0 ) : '#ffffff'); ?>" name="bstcmfw-cookie-button-font-color" id="bstcmfw-cookie-button-font-color" />

                                <label for="bstcmfw-cookie-header-accept-scripts">
									<span class="bstcmfw-column-label"><?php _e( 'Header accept scripts', 'basticom-framework' ); ?></span>
									<textarea rows="5" cols="54" name="bstcmfw-cookie-header-accept-scripts_<?php echo $bstcmfw_cookie_lang; ?>" id="bstcmfw-cookie-header-accept-scripts"><?php echo (get_option( 'bstcmfw-cookie-header-accept-scripts_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-cookie-header-accept-scripts_'.$bstcmfw_cookie_lang, false, 0 ) : '<script data-type="accept"></script>'); ?></textarea>
								</label>

                                <label for="bstcmfw-cookie-header-decline-scripts">
									<span class="bstcmfw-column-label"><?php _e( 'Header decline scripts', 'basticom-framework' ); ?></span>
									<textarea rows="5" cols="54" name="bstcmfw-cookie-header-decline-scripts_<?php echo $bstcmfw_cookie_lang; ?>" id="bstcmfw-cookie-header-decline-scripts"><?php echo (get_option( 'bstcmfw-cookie-header-decline-scripts_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-cookie-header-decline-scripts_'.$bstcmfw_cookie_lang, false, 0 ): '<script data-type="decline"></script>'); ?></textarea>
								</label>

                                <label for="bstcmfw-cookie-footer-accept-scripts">
									<span class="bstcmfw-column-label"><?php _e( 'Footer accept scripts', 'basticom-framework' ); ?></span>
									<textarea rows="5" cols="54" name="bstcmfw-cookie-footer-accept-scripts_<?php echo $bstcmfw_cookie_lang; ?>" id="bstcmfw-cookie-footer-accept-scripts"><?php echo (get_option( 'bstcmfw-cookie-footer-accept-scripts_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-cookie-footer-accept-scripts_'.$bstcmfw_cookie_lang, false, 0 ) : '<script data-type="accept"></script>'); ?></textarea>
								</label>

                                <label for="bstcmfw-cookie-footer-decline-scripts">
									<span class="bstcmfw-column-label"><?php _e( 'Footer decline scripts', 'basticom-framework' ); ?></span>
									<textarea rows="5" cols="54" name="bstcmfw-cookie-footer-decline-scripts_<?php echo $bstcmfw_cookie_lang; ?>" id="bstcmfw-cookie-footer-decline-scripts"><?php echo (get_option( 'bstcmfw-cookie-footer-decline-scripts_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-cookie-footer-decline-scripts_'.$bstcmfw_cookie_lang, false, 0 ) : '<script data-type="decline"></script>'); ?></textarea>
								</label>

							</div>

						</td>

					</tr>

				</table>

				<h2><?php _e( 'Iframe settings', 'basticom-framework' ); ?></h2>

				<table class="form-table">
					<tr valign="top">
						<th scope="row"><i class="fa fa-file-o" aria-hidden="true"></i> <?php _e( 'Iframe settings', 'basticom-framework' ); ?></th>
						<td class="bstcmfw-columns-1">
							<label for="bstcmfw-gform-iframe-background-color">
									<span class="bstcmfw-column-label"><?php _e( 'Background color', 'basticom-framework' ); ?></span>
							</label>
							<input class="color-field" type="text" value="<?php echo (get_option( 'bstcmfw-gform-iframe-background-color', false, 0 ) ? get_option( 'bstcmfw-gform-iframe-background-color', false, 0 ) : '#eeeeee'); ?>" name="bstcmfw-gform-iframe-background-color" id="bstcmfw-gform-iframe-background-color" />
							<label for="bstcmfw-gform-iframe-text-color">
									<span class="bstcmfw-column-label"><?php _e( 'Text font color', 'basticom-framework' ); ?></span>
							</label>
							<input class="color-field" type="text" value="<?php echo (get_option( 'bstcmfw-gform-iframe-text-color', false, 0 ) ? get_option( 'bstcmfw-gform-iframe-text-color', false, 0 ) : '#585858'); ?>" name="bstcmfw-gform-iframe-text-color" id="bstcmfw-gform-iframe-background-color" />
							<label for="bstcmfw-gform-iframe-button-text">
									<span class="bstcmfw-column-label"><?php _e( 'Accept button text', 'basticom-framework' ); ?></span>
									<input type="text" name="bstcmfw-gform-iframe-button-text_<?php echo $bstcmfw_cookie_lang; ?>" id="bstcmfw-gform-iframe-button-text" value="<?php echo (get_option( 'bstcmfw-gform-iframe-button-text_'.$bstcmfw_cookie_lang, false, 0 )? get_option( 'bstcmfw-gform-iframe-button-text_'.$bstcmfw_cookie_lang, false, 0 ): 'Ik ga akkoord'); ?>">
							</label>
							<label for="bstcmfw-gform-iframe-text">
									<span class="bstcmfw-column-label"><?php _e( 'Iframe text', 'basticom-framework' ); ?></span>
									<textarea rows="5" cols="54" name="bstcmfw-gform-iframe-text_<?php echo $bstcmfw_cookie_lang; ?>" id="bstcmfw-gform-iframe-text"><?php echo (get_option( 'bstcmfw-gform-iframe-text_'.$bstcmfw_cookie_lang, false, 0 ) ? get_option( 'bstcmfw-gform-iframe-text_'.$bstcmfw_cookie_lang, false, 0 ) : 'Om deze inhoud te bekijken dient u akkoord te gaan met het plaatsen van cookies.'); ?></textarea>
							</label>
						</td>
					</tr>
				</table>

				<?php if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) { ?>

				<h2><?php _e( 'Gravity Forms', 'basticom-framework' ); ?></h2>

				<table class="form-table">
					<tr valign="top">
						<th scope="row"><i class="fa fa-eye" aria-hidden="true"></i> <?php _e( 'Hide IP on form submit', 'basticom-framework' ); ?></th>
						<td class="bstcmfw-columns-1">
							<label for="bstcmfw-gform-hide-ip">
									<input type="checkbox" value="1" name="bstcmfw-gform-hide-ip" id="bstcmfw-gform-hide-ip" <?php if ( 1 == get_option( 'bstcmfw-gform-hide-ip', false, 0 ) ) { ?>checked="checked"<?php } ?> />
									<?php _e( 'Hide IP on submit', 'basticom-framework' ); ?>
							</label>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><i class="fa fa-database" aria-hidden="true"></i> <?php _e( 'Remove entry from DB', 'basticom-framework' ); ?></th>
						<td class="bstcmfw-columns-1">
							<label for="bstcmfw-gform-remove-submission">
								<select id="bstcmfw-gform-remove-submission" name="bstcmfw-gform-remove-submission[]" multiple="multiple">

									<?php $forms = GFAPI::get_forms(); ?>

									<?php foreach($forms as $form) { ?>

                                        <?php if ( in_array( $form['id'], get_option( 'bstcmfw-gform-remove-submission', false, 0 ) ) ) { ?>
                                            <option selected="selected" value="<?php echo $form['id']; ?>"><?php echo $form['title']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $form['id']; ?>"><?php echo $form['title']; ?></option>
                                        <?php } ?>

                                    <?php } ?>

								</select>
							</label>
						</td>
					</tr>

			</table>
			<?php } ?>

    	  <h2>
          	<?php _e( 'Framework PHP functions', 'basticom-framework' ); ?>
          </h2>

          <?php include('docs/basticom-phpfunctions.txt'); ?>

          <p>&nbsp;</p>

          <?php submit_button( 'Save settings', 'primary', false, false ); ?>

		</form>

	</div>

<?php } ?>
