<html>

<head>

	<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ) . '../includes/bstcmfw-cookie.css' ?>" media="screen" />

    <?php
        global $bstcmfw_cookie_lang;

        if( ICL_LANGUAGE_CODE ) {
            $bstcmfw_cookie_lang = ICL_LANGUAGE_CODE;
        } else {
            $bstcmfw_cookie_lang = substr(get_locale(), 0, 2);
        }
    ?>

	<script>

		// Get cookie
		function bstcmfw_get_cookie(cname) {
		    var name = cname + "=";
		    var decodedCookie = decodeURIComponent(document.cookie);
		    var ca = decodedCookie.split(';');
		    for(var i = 0; i <ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0) == ' ') {
		            c = c.substring(1);
		        }
		        if (c.indexOf(name) == 0) {
		            return c.substring(name.length, c.length);
		        }
		    }
		    return "";
		}

		function bstcmfw_set_cookie_consent(cname, exdays, cvalue) {
			parent.bstcmfw_set_cookie_consent(cname, exdays, cvalue);
			document.location.href = "<?php echo get_query_var('bstcmfw_embed_source'); ?>";
		}

		if ( 1 == bstcmfw_get_cookie( 'bstcmfw_cookie_accept' ) ) {
			document.location.href = "<?php echo get_query_var('bstcmfw_embed_source'); ?>";
		}

	</script>

</head>

<body style="margin: 0;" id="bstcmfw-embed-consent">

	<span class="bstcmfw-cookie-wrapper bstcmfw-cookie-wrapper--embed" style="background-color: <?php echo get_option('bstcmfw-gform-iframe-background-color'); ?>;">

		<span class="bstcmfw-cookie-inner bstcmfw-cookie-inner--embed">

			<span class="bstcmfw-cookie-text" style="color: <?php echo get_option('bstcmfw-gform-iframe-text-color'); ?>;"><?php echo get_option('bstcmfw-gform-iframe-text_'.$bstcmfw_cookie_lang); ?></span>

			<span class="bstcmfw-cookie-button-wrapper">

				<button class="bstcmfw-cookie-button bstcmfw-cookie-accept-button" style="background-color: <?php echo get_option('bstcmfw-cookie-accept-button-color'); ?>" class="bstcmfw-cookie-button bstcmfw-cookie-accept-button" onclick="bstcmfw_set_cookie_consent( 'bstcmfw_cookie_accept', <?php echo get_option('bstcmfw-cookie-exdays'); ?>, 1 )" ><?php echo get_option('bstcmfw-gform-iframe-button-text_'.$bstcmfw_cookie_lang); ?></button>

			</span>

		</span>

	</span>

</body>

</html>
