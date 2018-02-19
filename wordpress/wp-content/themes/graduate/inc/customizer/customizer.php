<?php
/**
 * Theme Palace Theme Customizer.
 *
 * @package Graduate
 */


/*
 * Load Upgrade To Pro Button
 */
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function graduate_customize_register( $wp_customize ) {
	$options = graduate_get_theme_options();

	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/custom-controls.php';

	// Load customize active callback functions.
	require get_template_directory() . '/inc/customizer/active-callback.php';

	// Load customize partial functions.
	require get_template_directory() . '/inc/customizer/partial.php';

	// Load validation callback functions.
	require get_template_directory() . '/inc/customizer/validation.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add panel for common theme options
	$wp_customize->add_panel( 'graduate_section_options_panel' , array(
	    'title'      => esc_html__( 'Homepage Sections','graduate' ),
	    'description'=> esc_html__( 'Graduate Section Options.', 'graduate' ),
	    'priority'   => 150,
	) );

	// top bar
	require get_template_directory() . '/inc/customizer/sections/top-bar.php';

	// slider
	require get_template_directory() . '/inc/customizer/sections/slider.php';

	// about content
	require get_template_directory() . '/inc/customizer/sections/about-content.php';

	// trending courses
	require get_template_directory() . '/inc/customizer/sections/trending-courses.php';

	// top destination
	require get_template_directory() . '/inc/customizer/sections/top-destination.php';

	// map section
	require get_template_directory() . '/inc/customizer/sections/map-section.php';

	// client section
	require get_template_directory() . '/inc/customizer/sections/client-section.php';

	// news and events section
	require get_template_directory() . '/inc/customizer/sections/news-events.php';

	// Add panel for common theme options
	$wp_customize->add_panel( 'graduate_theme_options_panel' , array(
	    'title'      => esc_html__( 'Theme Options','graduate' ),
	    'description'=> esc_html__( 'Graduate Theme Options.', 'graduate' ),
	    'priority'   => 150,
	) );

	// load animation
	require get_template_directory() . '/inc/customizer/theme-options/animation.php';

	// load layout
	require get_template_directory() . '/inc/customizer/theme-options/layout.php';

	// load single layout
	require get_template_directory() . '/inc/customizer/theme-options/single-layout.php';

	// load static homepage option
	require get_template_directory() . '/inc/customizer/theme-options/homepage-static.php';

	// load excerpt option
	require get_template_directory() . '/inc/customizer/theme-options/excerpt.php';

	// load search option
	require get_template_directory() . '/inc/customizer/theme-options/search.php';

	// load breadcrumb option
	require get_template_directory() . '/inc/customizer/theme-options/breadcrumb.php';

	// load pagination option
	require get_template_directory() . '/inc/customizer/theme-options/pagination.php';

	// load footer option
	require get_template_directory() . '/inc/customizer/theme-options/footer.php';

	// load reset option
	require get_template_directory() . '/inc/customizer/theme-options/reset.php';
}
add_action( 'customize_register', 'graduate_customize_register' );

/*
 * Load customizer sanitization functions.
 */
require get_template_directory() . '/inc/customizer/sanitize.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function graduate_customize_preview_js() {
	wp_enqueue_script( 'graduate_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'graduate_customize_preview_js' );


/**
 * Custom scripts and styles on customize.php
 *
 * @since Corporate Education 0.1
 */
function graduate_customize_scripts() {
	wp_enqueue_script( 'graduate_custom_customizer', get_template_directory_uri() . '/assets/js/custom-customizer.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );

	$graduate_data = array(
		'reset_message' => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'graduate' )
	);

	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'graduate_custom_customizer', 'graduate_data', $graduate_data );
}
add_action( 'customize_controls_enqueue_scripts', 'graduate_customize_scripts');

if ( !function_exists( 'graduate_reset_options' ) ) :
	/**
	 * Reset all options
	 *
	 * @since Graduate 0.1
	 *
	 * @param bool $checked Whether the reset is checked.
	 * @return bool Whether the reset is checked.
	 */
	function graduate_reset_options() {
		$options = graduate_get_theme_options();
		if ( true === $options['reset_options'] ) {
			// Reset custom theme options.
			set_theme_mod( 'graduate_theme_options', array() );
			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
	    }
	  	else {
		    return false;
	  	}
	}
endif;
add_action( 'customize_save_after', 'graduate_reset_options' );

