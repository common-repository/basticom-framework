// Trigger Cookie on button Click
function bstcmfw_set_cookie_consent(cname , exdays, cvalue) {

	bstcmfw_set_cookie_arguments(cname , exdays, cvalue);
	bstcmfw_set_cookie_scripts();

	if ( 1 == cvalue ) {
		jQuery('[src*=bstcmfw-embed-consent]').each(
			function() {
				var iframe_source = jQuery(this).attr('src');
				jQuery(this).attr( 'src', iframe_source );
			}
		);
		//console.log( jQuery('[src*=bstcmfw-embed-consent]').attr( 'src' ) );// = attr('src', jQuery(this).attr('src'));
	}
}

// Set default scripts based on cookie settings (1: print accept scripts, 0: print decline scripts)
jQuery( document ).ready(



	function() {
		'use strict';


        // Get first two characters
        var cookie_lang = document.documentElement.lang.substring(0, 2);

		jQuery.ajax(
			{
				type: "POST",
				url: bstcmfw_ajax_cookie.ajaxurl,
				dataType: "JSON",
				data: {
    				action: 'get_scripts_hook',
    				cookie_accept: bstcmfw_get_cookie( 'bstcmfw_cookie_accept' ),
                    cookie_lang: cookie_lang
    			},
			success: function( data ) {
					jQuery( data.header ).appendTo( "head" );
					jQuery( data.footer ).appendTo( "body" );

					if ( 1 != bstcmfw_get_cookie( 'bstcmfw_cookie_accept' ) && '0' != bstcmfw_get_cookie( 'bstcmfw_cookie_accept' ) ) {
						jQuery('.bstcmfw-cookie-wrapper').show();
						jQuery('.bstcmfw-cookie-overlay').show();
					}

				}
			}
		);

	}
);

// Set cookie
function bstcmfw_set_cookie_arguments(cname , exdays, cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


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


// Collapse CookieContainer on click
function bstcmfw_toggle_cookiebar() {
	var checkbox = document.getElementById("bstcmfw-cookie-enable");
	var container = document.getElementById("bstcmfw-cookie-collapse-div");

	if (checkbox.checked){
		container.style.display = "block";
	} else {
		container.style.display = "none";
	}
}

// Check if CookieCheckbox is checked on pageload
document.addEventListener("DOMContentLoaded", function() {
	if(document.getElementById("bstcmfw-cookie-enable") !== null) {
		var checkbox = document.getElementById("bstcmfw-cookie-enable");
		var container = document.getElementById("bstcmfw-cookie-collapse-div");

		if (checkbox.checked){
			container.style.display = "block";
		} else {
			container.style.display = "none";
		}
}

});


// Set JavaSripts
function bstcmfw_set_cookie_scripts() {

	var cookie_accept = bstcmfw_get_cookie("bstcmfw_cookie_accept");

    // Get first two characters
    var cookie_lang = document.documentElement.lang.substring(0, 2);

	jQuery.ajax(
		{
			type: "POST",
			url: bstcmfw_ajax_cookie.ajaxurl,
			dataType: "JSON",
			data: {
    			action: 'get_scripts_hook',
    			cookie_accept: cookie_accept,
                cookie_lang: cookie_lang
    		},
		success: function( data )
			{
				if ( jQuery( '[data-type=decline]').length ) {
					jQuery( '[data-type=decline]').remove();
				}

				jQuery( data.header ).appendTo( "head" );
				jQuery( data.footer ).appendTo( "body" );

				jQuery('.bstcmfw-cookie-wrapper').hide();
				jQuery('.bstcmfw-cookie-overlay').hide();
			}
		}
	);

}
