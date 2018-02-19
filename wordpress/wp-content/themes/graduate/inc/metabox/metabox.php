<?php
/**
 * Graduate metabox file.
 *
 * This is the template that includes all the other files for metaboxes of Graduate theme
 *
 * @package Graduate
 * @since Graduate 0.1
 */

// Include slider layout meta
require get_template_directory() . '/inc/metabox/sidebar-layout.php';

// Include header image meta
require get_template_directory() . '/inc/metabox/header-image.php';

if ( ! function_exists( 'graduate_custom_meta' ) ) :
	/**
	 * Adds meta box to the post editing screen
	 */
	function graduate_custom_meta() {
		$post_type = array( 'post', 'page' );
		if ( class_exists( 'TP_Education' ) ) {
			$additional_post_types = array( 'tp-class', 'tp-event', 'tp-excursion', 'tp-course', 'tp-team', 'tp-testimonial', 'tp-affiliation' );
			$post_type = array_merge( $post_type, $additional_post_types );

		}
		
		// Sidebar layout meta
	    add_meta_box( 'graduate_sidebar_layout_meta', esc_html__( 'Sidebar Layout', 'graduate' ), 'graduate_sidebar_position_callback', $post_type );
		
		// Header image meta
	    add_meta_box( 'graduate_header_image', esc_html__( 'Header Image', 'graduate' ), 'graduate_header_image_callback', $post_type );
	}
endif;
add_action( 'add_meta_boxes', 'graduate_custom_meta' );


