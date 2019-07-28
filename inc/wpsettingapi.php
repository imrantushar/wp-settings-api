<?php
if( ! class_exists( 'wpsettingapi' ) ){
	class wpsettingapi {
		public static $sections_array = array();
		public static function load(){
			// Hook it up.
			add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
			// Menu.
			add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
		}

		// add admin page
		public static function admin_menu(){
			add_options_page(
				'WP Settings API',
				'WP Settings API',
				'manage_options',
				'wp_simple_settings',
				array(  __CLASS__, 'plugin_setting_page' )
			);
		}
		
		public static function plugin_setting_page() {
			?>
				<div class="wrap">
		            <h1><?php esc_html_e('WP Settings API', 'wsi'); ?></h1>
		            <form method="post" action="options.php">
		            <?php
			            settings_fields(  'WPSI' );
							do_settings_sections( 'WPSI' );
						submit_button();
					?>
		            </form>
		        </div>
			<?php
		}

		public static function setSection( $section ){
			// Bail if not array.
			if ( ! is_array( $section ) ) {
				return false;
			}

			// Assign to the sections array
			return self::$sections_array[] = $section;
		}

		public static function get_value($args){
			return (get_option( $args['id'] ) != '') ? get_option( $args['id'] ) :  (isset($args['default']) ? $args['default'] : '');
		}

		public static function get_field_description($args){
			if ( ! empty( $args['desc'] ) ) {
				$desc = sprintf( '<p class="description">%s</p>', $args['desc'] );
			} else {
				$desc = '';
			}

			return $desc;
		}

		public static function callback_text($args) {
			$value = esc_attr( self::get_value($args) );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$type  = isset( $args['type'] ) ? $args['type'] : 'text';

			$html  = sprintf( '<input type="%1$s" class="%2$s-text" id="%3$s" name="%4$s" value="%5$s" placeholder="%6$s"/>', $type, $size, $args['section'], $args['id'], $value, $args['placeholder'] );
			$html .= self::get_field_description( $args );

			echo $html;
		}

		public static function callback_textarea( $args ) {

			$value = esc_textarea( self::get_value($args) );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

			$html  = sprintf( '<textarea rows="5" cols="55" class="%1$s-text" id="%2$s" name="%3$s" placeholder="%4$s">%5$s</textarea>', $size, $args['id'], $args['id'], $args['placeholder'], $value );
			$html .= self::get_field_description( $args );

			echo $html;
		}

	
		public static function admin_init(){
			foreach (self::$sections_array as $section) {
				$page = $section['page'];
				$field_section = $section['id'];

				add_settings_section( 
					$section['id'], 
					$section['title'], 
					null, 
					$page 
				);
				foreach ( $section['fields'] as $field ) {

					$args = array(
						'id'            => $field['id'],
						'title'   		=> $field['title'],
						'sub_title'		=> $field['sub_title'],
						'desc'			=> $field['desc'],
						'default'		=> $field['default'],
						'placeholder'	=> $field['placeholder'],
						'type'    		=> $field['type'],
					);

					add_settings_field(
						$field['id'],
						$field['title'],
						array(__CLASS__, 'callback_' . $field['type'] ),
						$page,
						$field_section,
						$args
					);
					register_setting( $page, $field['id']);
				}
			}
		}


	}
	wpsettingapi::load();
}
