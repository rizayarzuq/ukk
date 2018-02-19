<?php
/**
 * Navigation section
 *
 * This is the template for the content of header section
 *
 * @package Graduate
 * @since Graduate 0.1
 */

if ( ! function_exists( 'graduate_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_site_navigation() {
		$options = graduate_get_theme_options();
		?>
		<nav id="site-navigation" class="main-navigation">
			<div class="container">
				<?php 
				wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'fallback_cb' => 'graduate_primary_menu_fallback' ) ); 
				if ( $options['primary_menu_search'] === true ) :
				?>
					<div id="search">
						<?php get_search_form(); ?>
					</div><!-- .search -->
				<?php endif; ?>
			</div><!-- end .container -->
		</nav><!--end .main-navigation-->
		<?php
	}
endif;
add_action( 'graduate_header_action', 'graduate_site_navigation', 30 );

if ( ! function_exists( 'graduate_mobile_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Graduate 0.1
	 *
	 */
	function graduate_mobile_navigation() {
		$options = graduate_get_theme_options();
		?>
		<!-- Mobile Menu -->
		<nav id="sidr-left-top" class="mobile-menu sidr left">
			<div class="site-branding text-center">
				<div id="site-header">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html( $description ); ?></p>
					<?php
					endif; ?>
				</div><!-- .site-header -->
			</div><!-- end .site-branding -->
			<?php 
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'fallback_cb' => 'graduate_primary_menu_fallback' ) ); 
			if ( $options['primary_menu_search'] === true ) :
			?>
				<div id="search">
					<?php get_search_form(); ?>
				</div><!-- .search -->
			<?php endif; ?>
		</nav> 

		<a id="sidr-left-top-button" class="menu-button right" href="#sidr-left-top"><i class="fa fa-bars"></i></a>
	<?php
	}
endif;
add_action( 'graduate_header_action', 'graduate_mobile_navigation', 50 );

