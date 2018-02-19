<?php
/**
* Map Section options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add Map Section enable section
$wp_customize->add_section( 'graduate_map_section', array(
	'title'             => esc_html__( 'Map Section','graduate' ),
	'description'		=> esc_html__( 'Map Section Options', 'graduate' ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add Map Section enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[map_section_enable]', array(
	'default'           => $options['map_section_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[map_section_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_map_section',
	'type'              => 'select',
	'choices'           => graduate_enable_disable_options()
) );

// Add Map Section title
$wp_customize->add_setting( 'graduate_theme_options[map_section_title]', array(
	'default'           => $options['map_section_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage'
) );

$wp_customize->add_control( 'graduate_theme_options[map_section_title]', array(
	'label'             => esc_html__( 'Title', 'graduate' ),
	'section'           => 'graduate_map_section',
	'type'              => 'text',
	'active_callback'   => 'graduate_is_map_section_active'
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'graduate_theme_options[map_section_title]', array(
		'selector'            => '#map-section .entry-header h2.entry-title',
		'settings'            => 'graduate_theme_options[map_section_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'graduate_partial_map_section_title',
    ) );
}

// Add Map Section title
$wp_customize->add_setting( 'graduate_theme_options[map_section_shortcode]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'graduate_theme_options[map_section_shortcode]', array(
	'label'             => esc_html__( 'Input Map Shortcode', 'graduate' ),
	'section'           => 'graduate_map_section',
	'type'              => 'text',
	'active_callback'   => 'graduate_is_map_section_active'
) );
