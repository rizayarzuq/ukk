<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Theme Palace
 *
 * @package Graduate
 * @since Graduate 0.1
 */

/**
 * Register widget area. *
 */
function graduate_widgets_init() {
	// Sidebar Widget Area
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'graduate' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'graduate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Optional Sidebar Widget Area
	register_sidebar( array(
		'name'          => esc_html__( 'Optional Sidebar', 'graduate' ),
		'id'            => 'graduate-optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'graduate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Header Widget Area
	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget Area', 'graduate' ),
		'id'            => 'graduate-header-widget-area',
		'description'   => esc_html__( 'This Widget Area is for Header Section.', 'graduate' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// Footer Widget Area
	register_sidebars( 4, array(
		'name'          => esc_html__( 'Footer Widget Area %d', 'graduate' ),
		'id'            => 'graduate-footer-widget-area',
		'description'   => esc_html__( 'This Widget Area is for Footer Section.', 'graduate' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'graduate_widgets_init' );

/*
 * Add social link widget
 */
require get_template_directory() . '/inc/widgets/social-link.php';
/*
 * Add latest post widget
 */
require get_template_directory() . '/inc/widgets/latest-post-widget.php';
