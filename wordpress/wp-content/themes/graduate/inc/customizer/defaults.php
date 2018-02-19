<?php
/**
 * Customizer default options
 *
 * @package Graduate
 * @since Graduate 0.1
 * @return array An array of default values
 */

function graduate_get_default_theme_options() {
	$graduate_default_options = array(

		// Theme Options
		'theme_header_typography' 			=> 'default',
		'site_layout'         				=> 'wide',
		'sidebar_position'         			=> 'right-sidebar',
		'long_excerpt_length'           	=> 15,
		'read_more_text'		        	=> esc_html__( 'Read More', 'graduate' ),
		'breadcrumb_enable'         		=> true,
		'animation_enable'         			=> true,
		'pagination_enable'         		=> true,
		'pagination_type'         			=> 'default',
		'copyright_text'                  	=> sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved', '1: Year, 2: Site Title with home URL', 'graduate' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        		=> true,
		'reset_options'      				=> false,
		'enable_frontpage_content' 			=> true,
		'author_box_enable'					=> true,
		'post_pagination_enable'			=> true,
		'primary_menu_search'				=> true,
		'search_text'						=> esc_html__( 'Search For', 'graduate' ),

		// Top Bar
		'top_bar_enable'					=> 'enabled',
		'top_bar_detail_phone'				=> esc_html__( '+00 0000000000', 'graduate' ),
		'top_bar_detail_location'			=> esc_html__( 'Jackson Height, NY', 'graduate' ),

		// Slider
		'slider_enable'						=> 'static-frontpage',
		'slider_content_type'				=> 'page',
		'no_of_slider'						=> 3,

		// About Content
		'about_content_enable'				=> 'static-frontpage',
		'about_content_type'				=> 'page',

		// Trending Courses
		'trending_courses_enable'			=> 'static-frontpage',
		'trending_courses_content_type'		=> 'category',
		'trending_courses_display_title'	=> true,
		'trending_courses_column'			=> 4,
		'trending_courses_count'			=> 3,
		'trending_courses_title'			=> esc_html__( 'Trending Courses', 'graduate' ),

		// Top Destination
		'top_destination_enable'			=> 'static-frontpage',
		'top_destination_display_title'		=> true,
		'top_destination_content_type'		=> 'category',
		'top_destination_count'				=> 6,
		'top_destination_title'				=> esc_html__( 'Top Destinations', 'graduate' ),

		// Map
		'map_section_enable'				=> 'disabled',
		'map_section_title'					=> esc_html__( 'Universities Overview', 'graduate' ),

		// Client Section
		'client_section_enable'				=> 'static-frontpage',
		'client_section_content_type'		=> 'page',
		'client_section_count'				=> 6,

		// News & Event
		'news_events_enable'				=> 'static-frontpage',
		'news_events_column'				=> 4,
		'news_events_count'					=> 3,
		'news_events_title'					=> esc_html__( 'Latest News & Events', 'graduate' ),
		'news_events_display_title'			=> true,
		'news_events_content_type'			=> 'recent',
		

	);

	$output = apply_filters( 'graduate_default_theme_options', $graduate_default_options );
	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}