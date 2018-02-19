<?php
/**
 * The template for displaying team archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

get_header(); ?>

<section id="team-sections" class="three-columns page-section">
	<div class="container">
		<div class="row wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.3s">
			<?php
			if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				$i = 1;
				while ( have_posts() ) : the_post();
					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'tp-education/template-parts/content', 'team' );
					if ( $i % 3 == 0 ) { ?>
						</div><!-- .row -->
						<div class="row wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.3s">
					<?php }
					$i++;
				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; 

			/**
			* Hook - graduate_action_pagination.
			*
			* @hooked graduate_default_pagination 
			* @hooked graduate_numeric_pagination 
			*/
			do_action( 'graduate_action_pagination' ); 
			?>
		</div><!-- .row -->
	</div><!-- .container -->   
</section><!-- #team-sections -->

<?php
get_footer();
