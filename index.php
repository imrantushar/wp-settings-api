<?php
/**
* Plugin Name: Admin Setting api
*/


include plugin_dir_path( __FILE__ ) . 'inc/wpsettingapi.php';


wpsettingapi::setSection(array(
	'id'    	=> 'wpsi_test_group_setting',
	'title' 	=> __( 'Basic Settings', 'wpsi' ),
	'page'		=> 'WPSI',
	'fields'	=> array(
		array(
			'id'      		=> 'wpsi_test_field',
			'title'   		=> __( 'Text Input', 'wpsi' ),
			'desc'			=> 'this is description',
			'default'		=> 'Default Value',
			'placeholder'	=> '',
			'type'    		=> 'text',
		),
		array(
			'id'      		=> 'wpsi_test_field_two',
			'title'   		=> __( 'textarea Input', 'wpsi' ),
			'desc'			=> 'this is description',
			'placeholder'	=> 'Placeholder',
			'type'    		=> 'textarea',
		),
	)
));




wpsettingapi::setSection(array(
	'id'    	=> 'wpsi_test_group_setting_two',
	'title' 	=> __( 'Basic Settings Two', 'wpsi' ),
	'page'		=> 'reading',
	'fields'	=> array(
		array(
			'id'      		=> 'wpsi_test_field_three',
			'title'   		=> __( 'Text Input', 'wpsi' ),
			'desc'			=> 'this is simple text field',
			'default'		=> 'this is default value',
			'placeholder'	=> 'this is placeholder',
			'type'    		=> 'text',
		),
		array(
			'id'      		=> 'wpsi_test_field_four',
			'title'   		=> __( 'textarea Input', 'wpsi' ),
			'desc'			=> 'this is simple text field',
			'type'    		=> 'textarea',
		),
	)
));