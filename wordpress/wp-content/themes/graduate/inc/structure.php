<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Graduate
 * @since Graduate 0.1
 */

$options = graduate_get_theme_options();


if ( ! function_exists( 'graduate_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Graduate 0.1
	 */
	function graduate_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'graduate_doctype', 'graduate_doctype', 10 );


if ( ! function_exists( 'graduate_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'graduate_before_wp_head', 'graduate_head', 10 );

if ( ! function_exists( 'graduate_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'graduate' ); ?></a>

		<?php
	}
endif;

add_action( 'graduate_page_start_action', 'graduate_page_start', 10 );

if ( ! function_exists( 'graduate_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'graduate_page_end_action', 'graduate_page_end', 10 );

if ( ! function_exists( 'graduate_top_header' ) ) :
	/**
	 * Header start html codes
	 *
	 *@since Graduate 0.1
	 *
	 */
	function graduate_top_header() { 
		$options = graduate_get_theme_options();
		$top_bar_enable = ! empty( $options['top_bar_enable'] ) ? $options['top_bar_enable'] :'enabled';
		if ( 'enabled' == $top_bar_enable ) :
		?>
			<section id="top-bar">
				<button class="topbar-toggle"><i class="fa fa-phone"></i></button>
				<div class="container topbar-dropdown">
					<div class="pull-left">
						<ul class="address-block">
							<?php if ( ! empty( $options['top_bar_detail_phone'] ) ) : ?>
								<li class="phone"><a href="tel:<?php echo absint( preg_replace( '/\D+/', '', $options['top_bar_detail_phone'] ) ); ?>"><i class="fa fa-phone"></i><?php echo esc_html( $options['top_bar_detail_phone'] ); ?></a></li>
							<?php endif; 
							if ( ! empty( $options['top_bar_detail_location'] ) ) : ?>
								<li class="address"><i class="fa fa-map-marker"></i><?php echo esc_html( $options['top_bar_detail_location'] ); ?></li>
							<?php endif; ?>
						</ul><!-- end .address-block -->
					</div><!-- end .pull-left -->
					<div class="pull-right">
						<?php wp_nav_menu( array( 'theme_location' => 'top-bar', 'menu_id' => 'top-bar-menu', 'fallback_cb' => false, 'depth' => 1, 'menu_class' => 'menu clear' ) );  ?>
					</div><!-- end .pull-right -->
				</div><!-- end .container -->
			</section><!-- #top-bar -->
		<?php
		endif;
	}
endif;
add_action( 'graduate_header_action', 'graduate_top_header', 10 );

if ( ! function_exists( 'graduate_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_header_start() {
		?>
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
endif;
add_action( 'graduate_header_action', 'graduate_header_start', 10 );

if ( ! function_exists( 'graduate_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_site_branding() {
		?>
		<div class="container">
			<div class="site-branding pull-left">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo">
	            		<?php echo get_custom_logo(); ?>
	          		</div>
          		<?php endif; ?>
				<div id="site-header">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html( $description ); ?></p>
					<?php
					endif; ?>
				</div><!--#site-header-->
			</div><!--end .site-branding-->

			<?php if ( is_active_sidebar( 'graduate-header-widget-area' ) ) { ?>
				<div class="pull-right">
					<?php dynamic_sidebar( 'graduate-header-widget-area' ); ?>
				</div><!--.pull-right-->
			<?php } ?>
		</div><!--.container-->
	<?php
	}
endif;
add_action( 'graduate_header_action', 'graduate_site_branding', 20 );

if ( ! function_exists( 'graduate_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;

add_action( 'graduate_header_action', 'graduate_header_end', 40 );

if ( ! function_exists( 'graduate_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'graduate_content_start_action', 'graduate_content_start', 10 );

if ( ! function_exists( 'graduate_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_content_end() {
		?>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'graduate_content_end_action', 'graduate_content_end', 10 );


if ( ! function_exists( 'graduate_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since Graduate 0.1
	 */
	function graduate_add_breadcrumb() {
		$options = graduate_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div class="container">';
				/**
				 * graduate_simple_breadcrumb hook
				 *
				 * @hooked graduate_simple_breadcrumb -  10
				 *
				 */
				do_action( 'graduate_simple_breadcrumb' );
		echo '</div><!-- .container -->';
		return;
	}

endif;
add_action( 'graduate_add_breadcrumb', 'graduate_add_breadcrumb' , 20 );


if ( ! function_exists( 'graduate_footer_start' ) ) :
	/**
	 * Footer Widgets
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_footer_start() { 
		$footer_sidebar_data = graduate_footer_sidebar_class();
		$footer_class = $footer_sidebar_data['class'];
		?>
		<footer id="colophon" class="site-footer <?php echo esc_attr( $footer_class ); ?>" role="contentinfo">
	<?php
	}
endif;
add_action( 'graduate_footer', 'graduate_footer_start', 10 );


if ( ! function_exists( 'graduate_footer_widget' ) ) :
	/**
	 * Footer Widgets
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_footer_widget() {

		$footer_sidebar_data = graduate_footer_sidebar_class();
		$footer_sidebar_data = $footer_sidebar_data['active_sidebar'];
		if ( empty( $footer_sidebar_data ) ) {
			return;
		} ?>
        <div class="container">
        	<div class="row">
		      	<?php foreach( $footer_sidebar_data as $active_widget ) : ?>
					<div class="column-wrapper">
			      		<?php 
			      		if ( is_active_sidebar( esc_html( $active_widget ) ) ){
			      			dynamic_sidebar( esc_html( $active_widget ) );
			      		}
			      		?>
			      	</div>
		      	<?php endforeach; ?>
	      	</div><!-- .row -->
        </div><!-- end .container -->
		<?php
	}
endif;
add_action( 'graduate_footer', 'graduate_footer_widget', 20 );


if ( ! function_exists( 'graduate_footer_site_info' ) ) :
	/**
	 * Footer ends
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_footer_site_info() { 
		$options = graduate_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );
		?>
		<div class="site-info clear">
			<div class="container">
				<div class="pull-left">
					<p>
						<?php echo graduate_santize_allow_tag( $options['copyright_text'] ); ?>
						<span class="sep"> | </span>
						<?php printf( esc_html__( '%1$s by %2$s', 'graduate' ), 'Graduate', '<a href="' . esc_url( 'https://themepalace.com/' ) . '" rel="designer" target="_blank">Theme Palace</a>' ); ?>

				</div><!--.pull-left-->
				<div class="pull-right footer-menu">
					<?php 
					if ( has_nav_menu( 'footer-menu' ) ) :
						wp_nav_menu(
						 	array( 
							 	'theme_location' 	=> 'footer-menu', 
							 	'menu_id' 			=> 'footer-menu',
							 	'depth'				=> 1 
						 	) 
						 ); 
					endif; ?>
				</div><!--.pull-right-->
			</div><!--.container-->
		</div><!--.site-info-->
	<?php
	}
endif;
add_action( 'graduate_footer', 'graduate_footer_site_info', 30 );


if ( ! function_exists( 'graduate_footer_end' ) ) :
	/**
	 * Footer ends
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_footer_end() { ?>
		</footer><!-- #colophon -->
	<?php
	}
endif;
add_action( 'graduate_footer', 'graduate_footer_end', 40 );


if ( ! function_exists( 'graduate_back_to_top' ) ) :
	/**
	 * Footer ends
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_back_to_top() { 
		$options = graduate_get_theme_options();
		if ( $options['scroll_top_visible'] === true ) : ?>
			<div class="backtotop"><i class="fa fa-angle-up"></i></div>
		<?php
		endif;
	}
endif;
add_action( 'graduate_back_to_top', 'graduate_back_to_top', 10 );