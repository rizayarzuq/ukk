<?php
/**
* Client Section options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add Client Section enable section
$wp_customize->add_section( 'graduate_client_section', array(
	'title'             => esc_html__( 'Client Section','graduate' ),
	'description'		=> esc_html__( 'Client Section Options', 'graduate' ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add Client Section enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[client_section_enable]', array(
	'default'           => $options['client_section_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[client_section_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_client_section',
	'type'              => 'select',
	'choices'           => graduate_enable_disable_options()
) );

// Add Client Section type setting and control.
$wp_customize->add_setting( 'graduate_theme_options[client_section_content_type]', array(
	'default'           => $options['client_section_content_type'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[client_section_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'graduate' ),
	'section'         	=> 'graduate_client_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'graduate_is_client_section_active',
	'choices'         	=> graduate_client_content_type()
) );

// Add Client Section Count.
$wp_customize->add_setting( 'graduate_theme_options[client_section_count]', array(
	'default'           => $options['client_section_count'],
	'sanitize_callback' => 'graduate_sanitize_number_range',
	'validate_callback'	=> 'graduate_validate_client_section_count'
) );

$wp_customize->add_control( 'graduate_theme_options[client_section_count]', array(
	'label'           	=> esc_html__( 'No of Clients', 'graduate' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 15. Please input the valid number and save. Then referesh the page to see the change.', 'graduate' ),
	'section'         	=> 'graduate_client_section',
	'type'            	=> 'number',
	'active_callback' 	=> 'graduate_is_client_section_active',
	'input_attrs'		=> array(
		'max'	=> 15,
		'min'	=> 1,
		'style'	=> 'width:100px'
		)
) );

for( $i = 1; $i <= $options['client_section_count']; $i++ ) {

	// page content type setting and control.
	$wp_customize->add_setting( 'graduate_theme_options[client_section_page_'. $i .']', array(
		'sanitize_callback' => 'graduate_sanitize_page'
	) );

	$wp_customize->add_control( 'graduate_theme_options[client_section_page_'. $i .']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'graduate' ), $i ),
		'section'         	=> 'graduate_client_section',
		'type'            	=> 'dropdown-pages',
		'active_callback' 	=> 'graduate_is_client_section_active',
	) );
	
}