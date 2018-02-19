<?php
/**
* Search options
*
* @package Graduate
* @since Graduate 0.1
*/

$wp_customize->add_section( 'graduate_search', array(
	'title'             => esc_html__('Search','graduate'),
	'description'       => esc_html__( 'Search section options.', 'graduate' ),
	'panel'             => 'graduate_theme_options_panel'
) );

// Site layout setting and control.
$wp_customize->add_setting( 'graduate_theme_options[primary_menu_search]', array(
	'sanitize_callback'   => 'graduate_sanitize_checkbox',
	'default'             => $options['primary_menu_search']
) );

$wp_customize->add_control( 'graduate_theme_options[primary_menu_search]', array(
	'label'               => esc_html__( 'Enable Primary Menu Search', 'graduate' ),
	'section'             => 'graduate_search',
	'type'                => 'checkbox',
) );

// Search enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[search_text]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['search_text']
) );

$wp_customize->add_control( 'graduate_theme_options[search_text]', array(
	'label'            	=> esc_html__( 'Search Placeholder Text', 'graduate' ),
	'section'          	=> 'graduate_search',
	'type'             	=> 'text',
) );
