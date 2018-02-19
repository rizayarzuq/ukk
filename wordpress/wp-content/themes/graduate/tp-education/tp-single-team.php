<?php
/**
 * The template for displaying all team single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Graduate
 */

get_header(); ?>
	<div class="container page-section">
		

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'tp-education/template-parts/content-single', 'team' );

			endwhile; // End of the loop.
			?>

		<?php
		if ( graduate_is_sidebar_enable() ) {
			get_sidebar();
		} ?>
	</div><!-- .container -->
<?php	
get_footer();
