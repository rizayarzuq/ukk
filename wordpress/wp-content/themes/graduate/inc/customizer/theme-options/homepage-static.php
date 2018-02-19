<?php
/**
* Homepage (Static ) options
*
* @package Graduate
* @since Graduate 0.1
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'graduate_theme_options[enable_frontpage_content]', array(
	'sanitize_callback'   => 'graduate_sanitize_checkbox',
	'default'             => $options['enable_frontpage_content']
) );

$wp_customize->add_control( 'graduate_theme_options[enable_frontpage_content]', array(
	'label'       => esc_html__( 'Enable Content', 'graduate' ),
	'description' => esc_html__( 'Check to enable content on static front page only.', 'graduate' ),
	'section'     => 'static_front_page',
	'type'        => 'checkbox'
) );