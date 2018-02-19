<?php
/**
 * The template for displaying all custom single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Graduate
 */

get_header(); ?>
	<div class="container page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'tp-education/template-parts/content-custom', 'single' );

				/**
				* Hook graduate_action_post_pagination
				*  
				* @hooked graduate_post_pagination 
				*/
				do_action( 'graduate_action_post_pagination' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		if ( graduate_is_sidebar_enable() ) {
			get_sidebar();
		} ?>
	</div><!-- .container -->
<?php	
get_footer();
