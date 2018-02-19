<?php
/**
* Top Destination options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add Top Destination enable section
$wp_customize->add_section( 'graduate_top_destination', array(
	'title'             => esc_html__( 'Top Destination','graduate' ),
	'description'		=> sprintf( '<b>%1$s:</b> %2$s', esc_html__( 'Info', 'graduate' ), esc_html__( ' New Custom Category ( Taxonomy ) will be added automatically to Content Type as its registered. To see list of custom categories ( Terms ), select custom category in content type and save. Then refresh the page to see the list of custom categories.', 'graduate' ) ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add Top Destination enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[top_destination_enable]', array(
	'default'           => $options['top_destination_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[top_destination_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_top_destination',
	'type'              => 'select',
	'choices'           => graduate_enable_disable_options()
) );

// Add Top Destination title.
$wp_customize->add_setting( 'graduate_theme_options[top_destination_title]', array(
	'default'           => $options['top_destination_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage'
) );

$wp_customize->add_control( 'graduate_theme_options[top_destination_title]', array(
	'label'           	=> esc_html__( 'Title', 'graduate' ),
	'section'         	=> 'graduate_top_destination',
	'type'            	=> 'text',
	'active_callback' 	=> 'graduate_is_top_destination_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'graduate_theme_options[top_destination_title]', array(
		'selector'            => '#top-destinations .entry-header h2.entry-title',
		'settings'            => 'graduate_theme_options[top_destination_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'graduate_partial_top_destination_title',
    ) );
}

// Add Top Destination show title and description.
$wp_customize->add_setting( 'graduate_theme_options[top_destination_display_title]', array(
	'default'           => $options['top_destination_display_title'],
	'sanitize_callback' => 'graduate_sanitize_checkbox'
) );

$wp_customize->add_control( 'graduate_theme_options[top_destination_display_title]', array(
	'label'           	=> esc_html__( 'Display Title & Description', 'graduate' ),
	'section'         	=> 'graduate_top_destination',
	'type'            	=> 'checkbox',
	'active_callback' 	=> 'graduate_is_top_destination_active',
) );

// Add Top Destination type setting and control.
$wp_customize->add_setting( 'graduate_theme_options[top_destination_content_type]', array(
	'default'           => $options['top_destination_content_type'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[top_destination_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'graduate' ),
	'section'         	=> 'graduate_top_destination',
	'type'            	=> 'select',
	'active_callback' 	=> 'graduate_is_top_destination_active',
	'choices'         	=> graduate_trending_taxonomy_content_type()
) );

// Category Content Type
$wp_customize->add_setting(  'graduate_theme_options[top_destination_content_category]', array(
	'sanitize_callback' => 'absint',
) ) ;

$wp_customize->add_control( new Graduate_Dropdown_Category_Control ( $wp_customize,'graduate_theme_options[top_destination_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'graduate' ),
	'section'           => 'graduate_top_destination',
	'type'              => 'dropdown-category',
	'active_callback'	=> 'graduate_is_top_destination_category_active'
) ) );

// Taxonomy Content Type
$wp_customize->add_setting(  'graduate_theme_options[top_destination_'. $options['top_destination_content_type'] .']', array(
	'sanitize_callback' => 'absint',
) ) ;

$wp_customize->add_control( new Graduate_Dropdown_Taxonomies_Control ( $wp_customize,'graduate_theme_options[top_destination_'. $options['top_destination_content_type'] .']', array(
	'label'             => esc_html__( 'Select Term', 'graduate' ),
	'section'           => 'graduate_top_destination',
	'taxonomy'          => $options['top_destination_content_type'],
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'graduate_is_top_destination_taxonomy_active'
) ) );

// Add Top Destination Count.
$wp_customize->add_setting( 'graduate_theme_options[top_destination_count]', array(
	'default'           => $options['top_destination_count'],
	'sanitize_callback' => 'graduate_sanitize_number_range',
	'validate_callback' => 'graduate_validate_top_destination_count',

) );

$wp_customize->add_control( 'graduate_theme_options[top_destination_count]', array(
	'label'           	=> esc_html__( 'No of Posts', 'graduate' ),
	'section'         	=> 'graduate_top_destination',
	'type'            	=> 'number',
	'active_callback' 	=> 'graduate_is_top_destination_active',
	'input_attrs'		=> array(
		'max'	=> 12,
		'min'	=> 6,
		'style'	=> 'width:100px'
		)
) );