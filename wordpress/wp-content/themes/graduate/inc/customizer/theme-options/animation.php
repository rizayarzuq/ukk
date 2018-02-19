<?php
/**
* Animation options
*
* @package Graduate
* @since Graduate 0.1
*/

$wp_customize->add_section( 'graduate_animation', array(
	'title'             => esc_html__('Animation','graduate'),
	'description'       => esc_html__( 'Animation option.', 'graduate' ),
	'panel'             => 'graduate_theme_options_panel'
) );

// Animation enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[animation_enable]', array(
	'sanitize_callback'	=> 'graduate_sanitize_checkbox',
	'default'          	=> $options['animation_enable']
) );

$wp_customize->add_control( 'graduate_theme_options[animation_enable]', array(
	'label'            	=> esc_html__( 'Enable Animation', 'graduate' ),
	'section'          	=> 'graduate_animation',
	'type'             	=> 'checkbox',
) );
