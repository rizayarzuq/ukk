<?php
/**
* Breadcrumb options
*
* @package Graduate
* @since Graduate 0.1
*/

$wp_customize->add_section( 'graduate_breadcrumb', array(
	'title'             => esc_html__('Breadcrumb','graduate'),
	'description'       => esc_html__( 'Breadcrumb section options.', 'graduate' ),
	'panel'             => 'graduate_theme_options_panel'
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[breadcrumb_enable]', array(
	'sanitize_callback'	=> 'graduate_sanitize_checkbox',
	'default'          	=> $options['breadcrumb_enable']
) );

$wp_customize->add_control( 'graduate_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'graduate' ),
	'section'          	=> 'graduate_breadcrumb',
	'type'             	=> 'checkbox',
) );
