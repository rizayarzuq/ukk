<?php
/**
 * The template for displaying all course single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Graduate
 */

get_header(); ?>
	<div class="container page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<section id="courses-details">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'tp-education/template-parts/content-single', 'course' );

					endwhile; // End of the loop.
					?>
				</section><!-- #courses-details -->
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		if ( graduate_is_sidebar_enable() ) {
			get_sidebar();
		} ?>
	</div><!-- .container -->
<?php	
get_footer();
