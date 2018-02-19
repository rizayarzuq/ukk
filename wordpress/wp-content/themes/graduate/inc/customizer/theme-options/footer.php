<?php
/**
 * Footer options
 *
 * @package Graduate
 * @since Graduate 0.1
 */

/*Footer Section*/
$wp_customize->add_section( 'graduate_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'graduate' ),
		'priority'   			=> 900,
		'panel'      			=> 'graduate_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'graduate_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'graduate_santize_allow_tag',
	)
);
$wp_customize->add_control( 'graduate_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Footer Text', 'graduate' ),
		'section'    			=> 'graduate_section_footer',
		'type'		 			=> 'textarea',
    )
);

// scroll top visible
$wp_customize->add_setting( 'graduate_theme_options[scroll_top_visible]',
	array(
		'default'       		=> $options['scroll_top_visible'],
		'sanitize_callback'		=> 'graduate_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'graduate_theme_options[scroll_top_visible]',
    array(
		'label'      			=> esc_html__( 'Display Scroll Top Button', 'graduate' ),
		'section'    			=> 'graduate_section_footer',
		'type'		 			=> 'checkbox',
    )
);