<?php
/**
* About options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add About enable section
$wp_customize->add_section( 'graduate_about_content_section', array(
	'title'             => esc_html__( 'About Section','graduate' ),
	'description'       => esc_html__( 'About section options.', 'graduate' ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add About enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[about_content_enable]', array(
	'default'           => $options['about_content_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[about_content_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_about_content_section',
	'type'              => 'select',
	'choices'           => graduate_enable_disable_options()
) );

// Add About type setting and control.
$wp_customize->add_setting( 'graduate_theme_options[about_content_type]', array(
	'default'           => $options['about_content_type'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[about_content_type]', array(
	'label'           => esc_html__( 'Content Type', 'graduate' ),
	'section'         => 'graduate_about_content_section',
	'type'            => 'select',
	'active_callback' => 'graduate_is_about_content_active',
	'choices'         => graduate_about_content_type()
) );

// Page Content Type
$wp_customize->add_setting( 'graduate_theme_options[about_content_page]', array(
	'sanitize_callback' => 'graduate_sanitize_page'
) );

$wp_customize->add_control( 'graduate_theme_options[about_content_page]', array(
	'label'           	=> esc_html__( 'Select Page', 'graduate' ),
	'section'        	=> 'graduate_about_content_section',
	'active_callback' 	=> 'graduate_is_about_content_active',
	'type'				=> 'dropdown-pages'
) );
