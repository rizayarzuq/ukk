<?php
/**
 * Compact_One functions and definitions.
 *
 * @link
 *
 * @package compact_one
 */

/**
 * Load text domain.
 */
function compact_one_text_domain() {
	load_theme_textdomain( 'compact-one', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'compact_one_text_domain' );

/**
 * Load core.
 */
require_once( get_template_directory() . '/core/init.php' );
require_once( get_template_directory() . '/inc/breadcrumbs.php' );

/**
 * Enqueue scripts and styles
 */
function compact_one_enqueue() {
	$directory_uri  = get_template_directory_uri();

	wp_enqueue_style( 'animate-style', $directory_uri . '/inc/css/animate.css', false, '3.5.1' );

	wp_enqueue_script( 'waypoints', $directory_uri . '/js/jquery.waypoints.min.js', '', '',true );
	wp_enqueue_script( 'jquerycountup', $directory_uri . '/js/jquery.counterup.js', '', '',true );

	wp_enqueue_script( 'script-wow', get_template_directory_uri() . '/js/wow.min.js' );
	wp_enqueue_script( 'jquery-easing', $directory_uri . '/js/jquery.easing.min.js', array( 'jquery' ), '' );
	wp_enqueue_script( 'jquery-scrolling-nav', $directory_uri . '/js/scrolling-nav.js', array( 'jquery' ), '' );
	wp_enqueue_script( 'isotope-main', $directory_uri . '/js/isotope.pkgd.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'compact_one_custom_js',get_template_directory_uri() . '/js/custom.js',array( 'jquery' ),'', true );

	wp_enqueue_style( 'roboto-font', '//fonts.googleapis.com/css?family=Roboto:400,400i,500,700', false );
	wp_enqueue_style( 'lato-font', '//fonts.googleapis.com/css?family=Lato:400,700', false );
	wp_enqueue_style( 'fontawesome-style', $directory_uri . '/inc/css/font-awesome.min.css', false, '4.7.0' );

}
add_action( 'wp_enqueue_scripts', 'compact_one_enqueue' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/**
 * Title tag support.
 */
function compact_one_theme_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'compact_one_theme_setup' );

/**
 * Require the section and customizer files.
 */
require_once( get_template_directory() . '/inc/customizer.php' );
require_once( get_template_directory() . '/inc/slider-section.php' );
require_once( get_template_directory() . '/inc/about-us-section.php' );
require_once( get_template_directory() . '/inc/features-section.php' );
require_once( get_template_directory() . '/inc/work-section.php' );
require_once( get_template_directory() . '/inc/team-section.php' );
require_once( get_template_directory() . '/inc/testimonial-section.php' );
require_once( get_template_directory() . '/inc/contact-section.php' );
require_once( get_template_directory() . '/inc/custom-functions.php' );
require_once( get_template_directory() . '/inc/admin/admin-about.php' );

/**
 * Modify wpkses allowed html .
 */
function compact_one_wpkses_post_tags() {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);

	return $tags;
}
add_filter( 'wp_kses_allowed_html', 'compact_one_wpkses_post_tags', 10, 2 );

/**
 * Styles for header
 */
function compact_one_custom_styles() {
	// check if slider is enabled else modify menu.
	$compact_one_enable_slider_section = get_theme_mod( 'compact_one_enable_slider_section', 1 );
	if ( empty( $compact_one_enable_slider_section ) || ( ! isset( $compact_one_enable_slider_section ) ) ) {
	?>
		<style>
			.page-template-template-home .navbar-default
			{
					background: rgba(58, 101, 145, 0.9);
					position: relative;
					margin-top: 0;
			}
			.page-template-template-home .sticky-header2 .navbar-default
			{
				position:fixed;
			}
		</style>
<?php
	}

	// slider gradient and caption.
	$compact_one_slider_gradient = get_theme_mod( 'compact_one_slider_gradient', 'enable' );
	$compact_one_slider_caption_background = get_theme_mod( 'compact_one_slider_caption_background', 'background-color' );

	if( $compact_one_slider_gradient == 'disable' )
	{
	?>
		<style>
			#compact_one_slider .caption
			{
				background:transparent;
			}
		</style>
<?php
	}
	if( $compact_one_slider_caption_background == 'text-border' )
	{
	?>
		<style>
			#compact_one_slider .caption .inner-caption
			{
				border:1px solid #fff;
				background:transparent;
			}
		</style>
<?php
	}
	if( $compact_one_slider_caption_background == 'none' )
	{
	?>
		<style>
			#compact_one_slider .caption .inner-caption
			{
				border:none;
				background:transparent;
			}
		</style>
<?php
	}

}
add_action( 'wp_head', 'compact_one_custom_styles', 100 );

/**
 * Add theme specific social option design
 *
 * @param array $orig social icon list.
 */
function compact_one_social_icon_options( $orig ) {
	$new = array(
		'theme-specific' => get_template_directory_uri() . '/inc/images/icons-theme.png',
	);
	$new = array_merge( $new, $orig );
	return $new;
}
add_filter( 'cyberchimps_social_icon_options','compact_one_social_icon_options' );

if ( ! function_exists( 'compact_one_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function compact_one_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'compact-one' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'compact-one' ) );
				next_post_link( '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'compact-one' ) );
			?>
			</div><!-- .nav-links -->
			</nav><!-- .navigation -->
			<?php
	}
endif;

/**
 * Customizer partial refresh
 *
 * @param array $wp_customize Customizer options.
 */
function compact_one_customize_edit_links( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector' => '.site-title a',
			'render_callback' => 'compact_one_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector' => '.blog-description p',
			'render_callback' => 'compact_one_customize_partial_blogdescription',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'theme_backgrounds', array(
			'selector' => '#social',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'footer_copyright_text', array(
			'selector' => '#copyright',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'nav_menu_locations[primary]', array(
			'selector' => '#navigation',
		)
	);
	// home page sections.
	$wp_customize->selective_refresh->add_partial(
		'compact_one_about_title', array(
			'selector' => '#compact_one_about_section .section_title_span',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'compact_one_features_title', array(
			'selector' => '#compact_one_features_section .section_title_span',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'compact_one_work_title', array(
			'selector' => '#compact_one_work_section .section_title_span',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'compact_one_team_title', array(
			'selector' => '#compact_one_team_section .section_title_span',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'compact_one_testimonial_title', array(
			'selector' => '#compact_one_testimonial_section .section_title_span',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'compact_one_contact_title', array(
			'selector' => '#compact_one_contact_section .section_title_span',
		)
	);

}
/**
 * Customizer partial refresh - blogname
 */
function compact_one_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Customizer partial refresh - blog-description
 */
function compact_one_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

add_action( 'customize_register', 'compact_one_customize_edit_links' );

/**
 * Link to tutorial
 */
function compact_one_tutorial_link() {
	$class = 'notice notice-info is-dismissible';
	$message = __( 'How To Setup Compact One Theme : Step-by-Step Video Tutorials', 'compact-one' );
	$tutorial_link = 'https://cyberchimps.com/compact-one-tutorials';

	printf( '<div class="%1$s"><p><a href=%2$s target="_blank">%3$s</a></p></div>', esc_attr( $class ), esc_url( $tutorial_link ), esc_html( $message ) );
}
add_action( 'admin_notices', 'compact_one_tutorial_link' );

/**
 * Function to register multiple checkboxes option
 */
function compact_one_load_customize_controls() {

    require_once( trailingslashit( get_template_directory() ) . 'inc/control-checkbox-multiple.php' );
}
add_action( 'customize_register', 'compact_one_load_customize_controls', 0 );

/**
 * Exclude post with Category from blog and archive page. 
*/
function compact_one_exclude_post_cat( $query ){
    $cat = get_theme_mod( 'compact_one_exclude_post_cat' );
    
    if( $cat && ! is_admin() && $query->is_main_query() ){
        $cat = array_diff( array_unique( $cat ), array('') );
        if( $query->is_home() || $query->is_archive() ) {
			$query->set( 'category__not_in', $cat );
		}
    }    
}
add_filter( 'pre_get_posts', 'compact_one_exclude_post_cat' );
