<?php
/**
 * Graduate functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Graduate
 */

if ( ! function_exists( 'graduate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function graduate_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Theme Palace, use a find and replace
	 * to change 'graduate' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'graduate', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//add woocommerce support
	add_theme_support( 'woocommerce' );
	if ( class_exists( 'WooCommerce' ) ) {
    	global $woocommerce;

    	if( version_compare( $woocommerce->version, '3.0.0', ">=" ) ) {
      		add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}
  	}
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 250, 250, true );
	add_image_size( 'graduate_trending_courses', 350, 263, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 		=> esc_html__( 'Primary', 'graduate' ),
		'top-bar' 		=> esc_html__( 'Top Bar Menu', 'graduate' ),
		'footer-menu' 	=> esc_html__( 'Footer Menu', 'graduate' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'graduate_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// This setup supports logo, site-title & site-description
	add_theme_support( 'custom-logo', array(
		'height'      => 70,
		'width'       => 200,
		'flex-height' => false,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'graduate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function graduate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'graduate_content_width', 640 );
}
add_action( 'after_setup_theme', 'graduate_content_width', 0 );


if ( ! function_exists( 'graduate_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function graduate_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Montserrat Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'graduate' ) ) {
		$fonts[] = 'Playfair Display';
	}

	/* translators: If there are characters in your language that are not supported by Courgette, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Rubik font: on or off', 'graduate' ) ) {
		$fonts[] = 'Rubik';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function graduate_scripts() {

	$options = graduate_get_theme_options();
	$graduate_animation = $options['animation_enable'];

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'graduate-fonts', graduate_fonts_url(), array(), null );

	// font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/plugins/css/font-awesome.min.css' );

	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/plugins/css/slick.min.css' );

	// slick-theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/plugins/css/slick-theme.min.css' );

	// jquery-sidr-light
	wp_enqueue_style( 'jquery-sidr-light', get_template_directory_uri() . '/assets/plugins/css/jquery.sidr.light.min.css' );

	if ( $graduate_animation === true ) {
		// animate
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/plugins/css/animate.min.css' );
	}

	// custom stylesheet 
	wp_enqueue_style( 'graduate-style', get_stylesheet_uri() );

	// custom color css
	wp_enqueue_style( 'graduate-blue', get_template_directory_uri() . '/assets/css/blue.min.css' );

	// jquery sidr
	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/assets/plugins/js/jquery.sidr.min.js', array( 'jquery' ), '', true );

	// jquery slick
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/plugins/js/slick.min.js', array( 'jquery' ), '', true );

	if ( $graduate_animation === true ) {
		// jquery wow
		wp_enqueue_script( 'jquery-wow', get_template_directory_uri() . '/assets/plugins/js/wow.min.js', array( 'jquery' ), '', true );

		// custom animation
		wp_enqueue_script( 'graduate-animation', get_template_directory_uri() . '/assets/js/animation.min.js', array( 'jquery' ), '', true );
	}

	// Load the html5 shiv.
	wp_enqueue_script( 'graduate-html5', get_template_directory_uri() . '/assets/js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'graduate-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'graduate-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), '20151215', true );

	wp_enqueue_script( 'graduate-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// custom script
	wp_register_script( 'graduate-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), '', true );

	$current_site = site_url();
	$data = array( 'current_site' => $current_site );

	wp_localize_script( 'graduate-custom', 'data', $data );

	// custom script
	wp_enqueue_script( 'graduate-custom' );
}
add_action( 'wp_enqueue_scripts', 'graduate_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';

