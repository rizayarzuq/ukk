<?php
/**
* News & Events options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add News & Events enable section
$wp_customize->add_section( 'graduate_news_events', array(
	'title'             => esc_html__( 'News & Events','graduate' ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add News & Events enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[news_events_enable]', array(
	'default'           => $options['news_events_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[news_events_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_news_events',
	'type'              => 'select',
	'choices'           => graduate_enable_disable_options()
) );

// Add News & Events title.
$wp_customize->add_setting( 'graduate_theme_options[news_events_title]', array(
	'default'           => $options['news_events_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage'
) );

$wp_customize->add_control( 'graduate_theme_options[news_events_title]', array(
	'label'           	=> esc_html__( 'Title', 'graduate' ),
	'section'         	=> 'graduate_news_events',
	'type'            	=> 'text',
	'active_callback' 	=> 'graduate_is_news_events_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'graduate_theme_options[news_events_title]', array(
		'selector'            => '#news-section .entry-header h2.entry-title',
		'settings'            => 'graduate_theme_options[news_events_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'graduate_partial_news_events_title',
    ) );
}

// Add News & Events show title and description.
$wp_customize->add_setting( 'graduate_theme_options[news_events_display_title]', array(
	'default'           => $options['news_events_display_title'],
	'sanitize_callback' => 'graduate_sanitize_checkbox'
) );

$wp_customize->add_control( 'graduate_theme_options[news_events_display_title]', array(
	'label'           	=> esc_html__( 'Display Title & Description', 'graduate' ),
	'section'         	=> 'graduate_news_events',
	'type'            	=> 'checkbox',
	'active_callback' 	=> 'graduate_is_news_events_active',
) );

// Add News & Events Column.
$wp_customize->add_setting( 'graduate_theme_options[news_events_column]', array(
	'default'           => $options['news_events_column'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[news_events_column]', array(
	'label'           	=> esc_html__( 'Select Column Layout', 'graduate' ),
	'section'         	=> 'graduate_news_events',
	'type'            	=> 'select',
	'active_callback' 	=> 'graduate_is_news_events_active',
	'choices'         	=> graduate_trending_course_column()
) );

// Add News & Events type setting and control.
$wp_customize->add_setting( 'graduate_theme_options[news_events_content_type]', array(
	'default'           => $options['news_events_content_type'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[news_events_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'graduate' ),
	'section'         	=> 'graduate_news_events',
	'type'            	=> 'select',
	'active_callback' 	=> 'graduate_is_news_events_active',
	'choices'         	=> graduate_news_taxonomy_content_type()
) );

// Add News & Events Count.
$wp_customize->add_setting( 'graduate_theme_options[news_events_count]', array(
	'default'           => $options['news_events_count'],
	'sanitize_callback' => 'graduate_sanitize_number_range',
	'validate_callback'	=> 'graduate_validate_trending_course_count'
) );

$wp_customize->add_control( 'graduate_theme_options[news_events_count]', array(
	'label'           	=> esc_html__( 'No of Posts', 'graduate' ),
	'section'         	=> 'graduate_news_events',
	'type'            	=> 'number',
	'active_callback' 	=> 'graduate_is_news_events_content_recent',
	'input_attrs'		=> array(
		'max'	=> 8,
		'min'	=> 2,
		'style'	=> 'width:100px'
		)
) );