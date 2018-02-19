<?php
/**
 * Customizer Partial Functions
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if ( ! function_exists( 'graduate_partial_top_bar_phone' ) ) :
	// Top Bar Phone
	function graduate_partial_top_bar_phone() {
		$options = graduate_get_theme_options();
		return esc_html( $options['top_bar_detail_phone'] );
	}
endif;

if ( ! function_exists( 'graduate_partial_top_bar_location' ) ) :
	// Top Bar Phone
	function graduate_partial_top_bar_location() {
		$options = graduate_get_theme_options();
		return esc_html( $options['top_bar_detail_location'] );
	}
endif;

if ( ! function_exists( 'graduate_partial_trending_course_title' ) ) :
	// Trending Course Title
	function graduate_partial_trending_course_title() {
		$options = graduate_get_theme_options();
		return esc_html( $options['trending_courses_title'] );
	}
endif;

if ( ! function_exists( 'graduate_partial_top_destination_title' ) ) :
	// Top Destination Title
	function graduate_partial_top_destination_title() {
		$options = graduate_get_theme_options();
		return esc_html( $options['top_destination_title'] );
	}
endif;

if ( ! function_exists( 'graduate_partial_map_section_title' ) ) :
	// Map Section Title
	function graduate_partial_map_section_title() {
		$options = graduate_get_theme_options();
		return esc_html( $options['map_section_title'] );
	}
endif;

if ( ! function_exists( 'graduate_partial_news_events_title' ) ) :
	// news and event Title
	function graduate_partial_news_events_title() {
		$options = graduate_get_theme_options();
		return esc_html( $options['news_events_title'] );
	}
endif;