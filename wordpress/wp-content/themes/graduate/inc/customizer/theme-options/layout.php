<?php
/**
* Layout options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add sidebar section
$wp_customize->add_section( 'graduate_layout', array(
	'title'               => esc_html__('Layout','graduate'),
	'description'         => esc_html__( 'Layout section options.', 'graduate' ),
	'panel'               => 'graduate_theme_options_panel'
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'graduate_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'graduate_sanitize_select',
	'default'             => $options['sidebar_position']
) );

$wp_customize->add_control( 'graduate_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Sidebar Position', 'graduate' ),
	'section'             => 'graduate_layout',
	'type'                => 'select',
	'choices'			  => graduate_sidebar_position(),
) );

// Site layout setting and control.
$wp_customize->add_setting( 'graduate_theme_options[site_layout]', array(
	'sanitize_callback'   => 'graduate_sanitize_select',
	'default'             => $options['site_layout']
) );

$wp_customize->add_control( 'graduate_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'graduate' ),
	'section'             => 'graduate_layout',
	'type'                => 'select',
	'choices'			  => graduate_site_layout(),
) );
