<?php
/**
 * Reset options
 *
 * @package Graduate
 * @since Graduate 0.1
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'graduate_reset_section', array(
	'title'             => esc_html__('Reset all settings','graduate'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'graduate' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'graduate_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'graduate_sanitize_checkbox',
	'transport'			  => 'postMessage'
) );

$wp_customize->add_control( 'graduate_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'graduate' ),
	'section'           => 'graduate_reset_section',
	'type'              => 'checkbox',
) );