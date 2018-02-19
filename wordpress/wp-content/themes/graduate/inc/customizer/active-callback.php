<?php
/**
 * Customizer active callbacks
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if ( ! function_exists( 'graduate_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function graduate_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'graduate_theme_options[pagination_enable]' )->value();
	}
endif;

if ( ! function_exists( 'graduate_is_top_bar_active' ) ) :
	/**
	 * Check if top bar is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_top_bar_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[top_bar_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_slider_active' ) ) :
	/**
	 * Check if slider is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_slider_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[slider_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_about_content_active' ) ) :
	/**
	 * Check if about content is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_about_content_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[about_content_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_trending_courses_active' ) ) :
	/**
	 * Check if trending courses is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_trending_courses_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[trending_courses_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_trending_courses_category_active' ) ) :
	/**
	 * Check if trending courses content is category.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_trending_courses_category_active( $control ) {
		if ( graduate_is_trending_courses_active( $control ) && 'category' == $control->manager->get_setting( 'graduate_theme_options[trending_courses_content_type]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_trending_courses_taxonomy_active' ) ) :
	/**
	 * Check if trending courses content is custom taxonomy.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_trending_courses_taxonomy_active( $control ) {
		if ( graduate_is_trending_courses_active( $control ) && 'category' != $control->manager->get_setting( 'graduate_theme_options[trending_courses_content_type]' )->value() && 'demo' != $control->manager->get_setting( 'graduate_theme_options[trending_courses_content_type]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_top_destination_active' ) ) :
	/**
	 * Check if top destination is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_top_destination_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[top_destination_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_top_destination_category_active' ) ) :
	/**
	 * Check if top destination content is category.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_top_destination_category_active( $control ) {
		if ( graduate_is_top_destination_active( $control ) && 'category' == $control->manager->get_setting( 'graduate_theme_options[top_destination_content_type]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_top_destination_taxonomy_active' ) ) :
	/**
	 * Check if top destination content is custom taxonomy.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_top_destination_taxonomy_active( $control ) {
		if ( graduate_is_top_destination_active( $control ) && 'category' != $control->manager->get_setting( 'graduate_theme_options[top_destination_content_type]' )->value() && 'demo' != $control->manager->get_setting( 'graduate_theme_options[top_destination_content_type]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_map_section_active' ) ) :
	/**
	 * Check if map section is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_map_section_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[map_section_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_client_section_active' ) ) :
	/**
	 * Check if client section is enabled.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_client_section_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[client_section_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_news_events_active' ) ) :
	/**
	 * Check if news & events is enabled.
	 *
	 * @since Graduate Pro 1.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_news_events_active( $control ) {
		if ( 'disabled' != $control->manager->get_setting( 'graduate_theme_options[news_events_enable]' )->value() )
			return true;

		return false;
	}
endif;

if ( ! function_exists( 'graduate_is_news_events_content_recent' ) ) :
	/**
	 * Check if news and event content is recent.
	 *
	 * @since Graduate 0.1
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */

	function graduate_is_news_events_content_recent( $control ) {
		if ( graduate_is_news_events_active( $control ) && 'recent' == $control->manager->get_setting( 'graduate_theme_options[news_events_content_type]' )->value() )
			return true;

		return false;
	}
endif;