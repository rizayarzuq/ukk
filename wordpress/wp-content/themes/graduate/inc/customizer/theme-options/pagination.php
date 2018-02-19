<?php
/**
* pagination options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add sidebar section
$wp_customize->add_section( 'graduate_pagination', array(
	'title'               => esc_html__('Pagination','graduate'),
	'description'         => esc_html__( 'Pagination section options.', 'graduate' ),
	'panel'               => 'graduate_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'graduate_theme_options[pagination_enable]', array(
	'sanitize_callback'   => 'graduate_sanitize_checkbox',
	'default'             => $options['pagination_enable']
) );

$wp_customize->add_control( 'graduate_theme_options[pagination_enable]', array(
	'label'               => esc_html__( 'Pagination Enable', 'graduate' ),
	'section'             => 'graduate_pagination',
	'type'                => 'checkbox',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'graduate_theme_options[pagination_type]', array(
	'sanitize_callback'   => 'graduate_sanitize_select',
	'default'             => $options['pagination_type']
) );

$wp_customize->add_control( 'graduate_theme_options[pagination_type]', array(
	'label'               => esc_html__( 'Pagination Type', 'graduate' ),
	'section'             => 'graduate_pagination',
	'type'                => 'select',
	'choices'			  => graduate_pagination_options(),
	'active_callback'	  => 'graduate_is_pagination_enable'
) );
