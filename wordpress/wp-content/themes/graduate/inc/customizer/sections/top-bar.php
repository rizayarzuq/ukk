<?php
/**
* Top bar options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add Top bar enable section
$wp_customize->add_section( 'graduate_top_bar_section', array(
	'title'             => esc_html__( 'Top bar Section','graduate' ),
	'description'       => esc_html__( 'Top bar section options.', 'graduate' ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add Top bar enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[top_bar_enable]', array(
	'default'           => $options['top_bar_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[top_bar_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_top_bar_section',
	'type'              => 'select',
	'choices'           => graduate_top_bar_enable_options()
) );


// Add Top bar phone setting and control.
$wp_customize->add_setting( 'graduate_theme_options[top_bar_detail_phone]', array(
	'default'           => $options['top_bar_detail_phone'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'graduate_theme_options[top_bar_detail_phone]', array(
	'label'             => esc_html__( 'Phone', 'graduate' ),
	'section'           => 'graduate_top_bar_section',
	'type'              => 'text',
	'active_callback'	=> 'graduate_is_top_bar_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'graduate_theme_options[top_bar_detail_phone]', array(
		'selector'            => '#top-bar .address-block li.phone',
		'settings'            => 'graduate_theme_options[top_bar_detail_phone]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'graduate_partial_top_bar_phone',
    ) );
}

// Add Top bar location setting and control.
$wp_customize->add_setting( 'graduate_theme_options[top_bar_detail_location]', array(
	'default'           => $options['top_bar_detail_location'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'graduate_theme_options[top_bar_detail_location]', array(
	'label'             => esc_html__( 'Location', 'graduate' ),
	'section'           => 'graduate_top_bar_section',
	'type'              => 'text',
	'active_callback'	=> 'graduate_is_top_bar_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'graduate_theme_options[top_bar_detail_location]', array(
		'selector'            => '#top-bar .address-block li.address',
		'settings'            => 'graduate_theme_options[top_bar_detail_location]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'graduate_partial_top_bar_location',
    ) );
}