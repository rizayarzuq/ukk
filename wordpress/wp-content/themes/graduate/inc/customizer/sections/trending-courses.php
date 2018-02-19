<?php
/**
* Trending Courses options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add Trending Courses enable section
$wp_customize->add_section( 'graduate_trending_courses', array(
	'title'             => esc_html__( 'Trending Courses','graduate' ),
	'description'		=> sprintf( '<b>%1$s:</b> %2$s', esc_html__( 'Info', 'graduate' ), esc_html__( ' New Custom Category ( Taxonomy ) will be added automatically to Content Type as its registered. To see list of custom categories ( Terms ), select custom category in content type and save. Then refresh the page to see the list of custom categories.', 'graduate' ) ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add Trending Courses enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[trending_courses_enable]', array(
	'default'           => $options['trending_courses_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[trending_courses_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_trending_courses',
	'type'              => 'select',
	'choices'           => graduate_enable_disable_options()
) );

// Add Trending Courses title.
$wp_customize->add_setting( 'graduate_theme_options[trending_courses_title]', array(
	'default'           => $options['trending_courses_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage'
) );

$wp_customize->add_control( 'graduate_theme_options[trending_courses_title]', array(
	'label'           	=> esc_html__( 'Title', 'graduate' ),
	'section'         	=> 'graduate_trending_courses',
	'type'            	=> 'text',
	'active_callback' 	=> 'graduate_is_trending_courses_active',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'graduate_theme_options[trending_courses_title]', array(
		'selector'            => '#trending-courses .entry-header h2.entry-title',
		'settings'            => 'graduate_theme_options[trending_courses_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'graduate_partial_trending_course_title',
    ) );
}

// Add Trending Courses show title and description.
$wp_customize->add_setting( 'graduate_theme_options[trending_courses_display_title]', array(
	'default'           => $options['trending_courses_display_title'],
	'sanitize_callback' => 'graduate_sanitize_checkbox'
) );

$wp_customize->add_control( 'graduate_theme_options[trending_courses_display_title]', array(
	'label'           	=> esc_html__( 'Display Title & Description', 'graduate' ),
	'section'         	=> 'graduate_trending_courses',
	'type'            	=> 'checkbox',
	'active_callback' 	=> 'graduate_is_trending_courses_active',
) );

// Add Trending Courses Column.
$wp_customize->add_setting( 'graduate_theme_options[trending_courses_column]', array(
	'default'           => $options['trending_courses_column'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[trending_courses_column]', array(
	'label'           	=> esc_html__( 'Select Column Layout', 'graduate' ),
	'section'         	=> 'graduate_trending_courses',
	'type'            	=> 'select',
	'active_callback' 	=> 'graduate_is_trending_courses_active',
	'choices'         	=> graduate_trending_course_column()
) );

// Add Trending Courses type setting and control.
$wp_customize->add_setting( 'graduate_theme_options[trending_courses_content_type]', array(
	'default'           => $options['trending_courses_content_type'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[trending_courses_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'graduate' ),
	'section'         	=> 'graduate_trending_courses',
	'type'            	=> 'select',
	'active_callback' 	=> 'graduate_is_trending_courses_active',
	'choices'         	=> graduate_trending_taxonomy_content_type()
) );

// Category Content Type
$wp_customize->add_setting(  'graduate_theme_options[trending_courses_content_category]', array(
	'sanitize_callback' => 'absint',
) ) ;

$wp_customize->add_control( new Graduate_Dropdown_Category_Control ( $wp_customize,'graduate_theme_options[trending_courses_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'graduate' ),
	'section'           => 'graduate_trending_courses',
	'type'              => 'dropdown-category',
	'active_callback'	=> 'graduate_is_trending_courses_category_active'
) ) );

// Taxonomy Content Type
$wp_customize->add_setting(  'graduate_theme_options[trending_courses_'. $options['trending_courses_content_type'] .']', array(
	'sanitize_callback' => 'absint',
) ) ;

$wp_customize->add_control( new Graduate_Dropdown_Taxonomies_Control ( $wp_customize,'graduate_theme_options[trending_courses_'. $options['trending_courses_content_type'] .']', array(
	'label'             => esc_html__( 'Select Term', 'graduate' ),
	'section'           => 'graduate_trending_courses',
	'taxonomy'          => $options['trending_courses_content_type'],
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'graduate_is_trending_courses_taxonomy_active'
) ) );

// Add Trending Courses Count.
$wp_customize->add_setting( 'graduate_theme_options[trending_courses_count]', array(
	'default'           => $options['trending_courses_count'],
	'sanitize_callback' => 'graduate_sanitize_number_range',
	'validate_callback'	=> 'graduate_validate_trending_course_count'
) );

$wp_customize->add_control( 'graduate_theme_options[trending_courses_count]', array(
	'label'           	=> esc_html__( 'No of Posts', 'graduate' ),
	'section'         	=> 'graduate_trending_courses',
	'type'            	=> 'number',
	'active_callback' 	=> 'graduate_is_trending_courses_active',
	'input_attrs'		=> array(
		'max'	=> 8,
		'min'	=> 2,
		'style'	=> 'width:100px'
		)
) );