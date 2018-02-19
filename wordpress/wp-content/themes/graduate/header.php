<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Graduate
	 */

	/**
	 * graduate_doctype hook
	 *
	 * @hooked graduate_doctype -  10
	 *
	 */
	do_action( 'graduate_doctype' );
?>
<head>
<?php
	/**
	 * graduate_before_wp_head hook
	 *
	 * @hooked graduate_head -  10
	 *
	 */
	do_action( 'graduate_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<?php 

	/**
	 * graduate_page_start_action hook
	 *
	 * @hooked graduate_page_start -  10
	 *
	 */
	do_action( 'graduate_page_start_action' ); 
	

	/**
	 * graduate_loader_action hook
	 *
	 * @hooked graduate_add_breadcrumb -  20
	 *
	 */
 do_action( 'graduate_before_header' );

	/**
	 * graduate_header_action hook
	 *
	 * @hooked graduate_header_start -  10
	 * @hooked graduate_site_branding -  20
	 * @hooked graduate_site_navigation -  30
	 * @hooked graduate_header_end -  40
	 * @hooked graduate_mobile_navigation -  50
	 *
	 */
	do_action( 'graduate_header_action' );

	/**
	 * graduate_content_start_action hook
	 *
	 * @hooked graduate_content_start -  10
	 * @hooked graduate_custom_header -  20
	 *
	 */
	do_action( 'graduate_content_start_action' );


	/**
	 * graduate_primary_content hook
	 *
	 * @hooked graduate_add_slider_section -  10
	 * @hooked graduate_add_about_content_section -  20
	 * graduate_add_trending_courses_section - 40
	 * graduate_add_top_destination_section - 50
	 * graduate_add_map_section_section - 70
	 * graduate_add_client_section_section - 80
	 * graduate_add_news_events_section - 100
	 *
	 */
	do_action( 'graduate_primary_content' );
