<?php
/**
* Slider options
*
* @package Graduate
* @since Graduate 0.1
*/

// Add slider enable section
$wp_customize->add_section( 'graduate_slider_section', array(
	'title'             => esc_html__('Featured Slider','graduate'),
	'description'       => esc_html__( 'Slider section options.', 'graduate' ),
	'panel'             => 'graduate_section_options_panel'
) );

// Add slider enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[slider_enable]', array(
	'default'           => $options['slider_enable'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[slider_enable]', array(
	'label'             => esc_html__( 'Enable on', 'graduate' ),
	'section'           => 'graduate_slider_section',
	'type'              => 'select',
	'choices'           => graduate_enable_disable_options()
) );


// Slider post hr setting and control
$wp_customize->add_setting( 'graduate_theme_options[slider_hr]', array(
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( new graduate_Customize_Horizontal_Line( $wp_customize, 'graduate_theme_options[slider_hr]',
	array(
		'section'         => 'graduate_slider_section',
		'active_callback' => 'graduate_is_slider_active',
		'type'			  => 'hr'
) ) );

// Add slider content type setting and control.
$wp_customize->add_setting( 'graduate_theme_options[slider_content_type]', array(
	'default'           => $options['slider_content_type'],
	'sanitize_callback' => 'graduate_sanitize_select'
) );

$wp_customize->add_control( 'graduate_theme_options[slider_content_type]', array(
	'label'           	=> esc_html__( 'Content Type', 'graduate' ),
	'description'     	=> esc_html__( 'Recommended slider image size is 1200x500 px', 'graduate' ),
	'section'         	=> 'graduate_slider_section',
	'type'            	=> 'select',
	'active_callback' 	=> 'graduate_is_slider_active',
	'choices'         	=> graduate_common_content_type()
) );

// Add slider number setting and control.
$wp_customize->add_setting( 'graduate_theme_options[no_of_slider]', array(
	'default'           => $options['no_of_slider'],
	'sanitize_callback' => 'graduate_sanitize_number_range',
	'validate_callback' => 'graduate_validate_no_of_slider',
) );

$wp_customize->add_control( 'graduate_theme_options[no_of_slider]', array(
	'label'           	=> esc_html__( 'Number of slides', 'graduate' ),
	'description'       => esc_html__( 'Note: Min 1 & Max 5. Please input the valid number and save. Then referesh the page to see the change.', 'graduate' ),
	'section'         	=> 'graduate_slider_section',
	'type'            	=> 'number',
	'active_callback' 	=> 'graduate_is_slider_active',
	'input_attrs'     	=> array(
		'max' 	=> 5,
		'min' 	=> 1,
		'style' => 'width:100px'
	)
) );

/**
 * Page Content Type
 */
for ( $i = 1; $i <= $options['no_of_slider']; $i++ ) {
	// Show page drop-down setting and control
	$wp_customize->add_setting( 'graduate_theme_options[slider_content_page_'.$i.']', array(
		'sanitize_callback' => 'graduate_sanitize_page'
	) );

	$wp_customize->add_control( 'graduate_theme_options[slider_content_page_'.$i.']', array(
		'label'           	=> sprintf( esc_html__( 'Select Page %d', 'graduate' ), $i ),
		'section'        	=> 'graduate_slider_section',
		'active_callback' 	=> 'graduate_is_slider_active',
		'type'				=> 'dropdown-pages'
	) );
}

