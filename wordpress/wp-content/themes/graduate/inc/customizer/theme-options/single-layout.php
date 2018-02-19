<?php
/**
* Single Post options
*
* @package Graduate
* @since Graduate 0.1
*/

$wp_customize->add_section( 'graduate_single_post', array(
	'title'             => esc_html__('Single Post','graduate'),
	'description'       => esc_html__( 'Single Post options.', 'graduate' ),
	'panel'             => 'graduate_theme_options_panel'
) );

// Author box enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[author_box_enable]', array(
	'sanitize_callback'	=> 'graduate_sanitize_checkbox',
	'default'          	=> $options['author_box_enable']
) );

$wp_customize->add_control( 'graduate_theme_options[author_box_enable]', array(
	'label'            	=> esc_html__( 'Enable Author Detail', 'graduate' ),
	'section'          	=> 'graduate_single_post',
	'type'             	=> 'checkbox',
) );

// Single Post pagination enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[post_pagination_enable]', array(
	'sanitize_callback'	=> 'graduate_sanitize_checkbox',
	'default'          	=> $options['post_pagination_enable']
) );

$wp_customize->add_control( 'graduate_theme_options[post_pagination_enable]', array(
	'label'            	=> esc_html__( 'Enable Post Navigation', 'graduate' ),
	'section'          	=> 'graduate_single_post',
	'type'             	=> 'checkbox',
) );