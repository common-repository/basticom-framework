<?php
/* Enable advanced image compression theme support */

add_theme_support( 'advanced-image-compression' );
add_filter('jpeg_quality', function($arg){return 100;});

//bstcmfw_write_log("bstcmfw-imagecompression module loaded");

?>