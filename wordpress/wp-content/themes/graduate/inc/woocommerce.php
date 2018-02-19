<?php
/**
 * Woocommerce
 *
 * @package Graduate
 * @since Graduate 0.1
 */

/**
 * Make theme WooCommerce ready
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );

add_filter( 'woocommerce_show_page_title', 'graduate_show_title' );
if ( ! function_exists( 'graduate_show_title' ) ) :
	function graduate_show_title() {
	  return;
	}
endif;

add_action('woocommerce_before_main_content', 'graduate_primary_content_start', 20);

if ( ! function_exists( 'graduate_primary_content_start' ) ) :
	function graduate_primary_content_start() {
	  echo '<div class="container page-section">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">';
	}
endif;

add_action('woocommerce_after_main_content', 'graduate_primary_content_end', 10);
add_action('woocommerce_sidebar', 'graduate_page_section_end', 20);

if ( ! function_exists( 'graduate_primary_content_end' ) ) :
	function graduate_primary_content_end() {
	  echo '</main>
	  </div>';
	}
endif;

if ( ! function_exists( 'graduate_page_section_end' ) ) :
	function graduate_page_section_end() {
	  echo '</div>';
	}
endif;
