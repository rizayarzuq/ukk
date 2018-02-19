<?php
/**
 * Template Name: Home Page
 *
 * @package compact-one
 */

// get header.
get_header();

/*====fetch options =============*/

$compact_one_enable_slider_section = get_theme_mod( 'compact_one_enable_slider_section', 1 );
$compact_one_enable_about_section = get_theme_mod( 'compact_one_enable_about_section', 1 );
$compact_one_enable_features_section = get_theme_mod( 'compact_one_enable_features_section', 1 );
$compact_one_enable_work_section = get_theme_mod( 'compact_one_enable_work_section', 1 );
$compact_one_enable_team_section = get_theme_mod( 'compact_one_enable_team_section', 1 );
$compact_one_enable_testimonial_section = get_theme_mod( 'compact_one_enable_testimonial_section', 1 );
$compact_one_enable_contact_section = get_theme_mod( 'compact_one_enable_contact_section', 1 );

if ( $compact_one_enable_slider_section ) {
	 do_action( 'compact_one_enable_slider', 'compact_one_enable_slider_func' );
}
if ( $compact_one_enable_about_section ) {
	 do_action( 'compact_one_enable_about_section', 'compact_one_enable_about_section_func' );
}
if ( $compact_one_enable_features_section ) {
	 do_action( 'compact_one_enable_features_section', 'compact_one_enable_features_section_func' );
}
if ( $compact_one_enable_work_section ) {
	 do_action( 'compact_one_enable_work_section', 'compact_one_enable_work_section_func' );
}
if ( $compact_one_enable_team_section ) {
	 do_action( 'compact_one_enable_team_section', 'compact_one_enable_team_section_func' );
}
if ( $compact_one_enable_testimonial_section ) {
	 do_action( 'compact_one_enable_testimonial_section', 'compact_one_enable_testimonial_section_func' );
}
if ( $compact_one_enable_contact_section ) {
	 do_action( 'compact_one_enable_contact_section', 'compact_one_enable_contact_section_func' );
}

// get footer.
get_footer();
