<?php
/* Enable Admin footer stats */

$plugin_header_translate = array( __('Server IP & Memory Usage Display', 'basticom-framework'), __('Show the memory limit, current memory usage and IP address in the admin footer.', 'basticom-framework') );

if ( is_admin() ) {

	class ip_address_memory_usage {

		var $memory = false;
		var $server_ip_address = false;

		public function __construct() {
			add_action( 'admin_init', 'ipmem_load_language' );
			function ipmem_load_language() {
				load_plugin_textdomain( 'server-ip-memory-usage', false,  dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
			}
            $this->memory = array();
            add_action( 'init', array (&$this, 'check_limit') );
			add_filter( 'admin_footer_text', array (&$this, 'add_footer') );
		}

        function check_limit() {

			$memory = substr(ini_get('memory_limit'), 0, -1);
			echo "<pre>test: limit: {$memory}</pre>";
            $this->memory['limit'] = (int) $memory;
        }

		function check_memory_usage() {

			$this->memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 2) : 0;

			if ( !empty($this->memory['usage']) && !empty($this->memory['limit']) ) {
				$this->memory['percent'] = round ($this->memory['usage'] / $this->memory['limit'] * 100, 0);
				$this->memory['color'] = 'font-weight:normal;';
				if ($this->memory['percent'] > 75) $this->memory['color'] = 'font-weight:bold;color:#E66F00';
				if ($this->memory['percent'] > 90) $this->memory['color'] = 'font-weight:bold;color:red';
			}
		}

		function format_wp_limit( $size ) {
			$value  = substr( $size, -1 );
			$return = substr( $size, 0, -1 );

			switch ( strtoupper( $value ) ) {
				case 'P' :
					$return*= 1024;
				case 'T' :
					$return*= 1024;
				case 'G' :
					$return*= 1024;
				case 'M' :
					$return*= 1024;
				case 'K' :
					$return*= 1024;
			}
			return $return;
		}
		function check_wp_limit() {
			$memory = $this->format_wp_limit( WP_MEMORY_LIMIT );
			$memory = size_format( $memory );
			return ($memory) ? $memory : __( 'N/A', 'server-ip-memory-usage' );
		}

		function add_footer($content) {
			$this->check_memory_usage();
			//$server_ip_address = $_SERVER[ 'SERVER_ADDR' ];
			$server_ip_address = (!empty($_SERVER[ 'SERVER_ADDR' ]) ? $_SERVER[ 'SERVER_ADDR' ] : "");
			if ($server_ip_address == "") { // Added for IP Address in IIS
				$server_ip_address = (!empty($_SERVER[ 'LOCAL_ADDR' ]) ? $_SERVER[ 'LOCAL_ADDR' ] : "");
			}
			$content .= '<span style=""><i class="fa fa-server" aria-hidden="true"></i> ' . __( ' ', 'basticom-framework' ) . '' . $this->memory['usage'] . ' MB ' . __( 'of', 'basticom-framework' ) . ' ' . ini_get('memory_limit'). 'B | ' . __( ' ', 'basticom-framework' ) . '' . $this->check_wp_limit() . ' | ' . $server_ip_address . ' | PHP ' . PHP_VERSION . ' @' . (PHP_INT_SIZE * 8) . 'BitOS</span>';
			return $content;
		}

	}

	//add_action( 'plugins_loaded', create_function('', '$memory = new ip_address_memory_usage();') );
	$memory = new ip_address_memory_usage();
}

//bstcmfw_write_log("bstcmfw-serverstats module loaded");

?>
