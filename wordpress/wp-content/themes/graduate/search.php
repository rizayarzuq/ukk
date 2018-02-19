<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Graduate
 */

get_header(); 
$options = graduate_get_theme_options();
?>
	<div class="container page-section">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section id="graduate">
				<div class="tab-sections clear">
					<div class="choose-graduate pull-left">
						<?php get_search_form(); ?>
					</div><!--.choose-graduate-->

					<div class="tab pull-right">
						<ul class="tabs">
							<li class="tab-link" data-tab="tab-1">
								<a href="#."><i class="fa fa-th-list"></i></a>
							</li>
							<li class="tab-link active" data-tab="tab-2">
								<a href="#."><i class="fa fa-th-large"></i></a>
							</li>
						</ul><!-- end .tabs -->
					</div><!--.tab-->
				</div><!--.tab-sections-->
				<div class="graduate-list three-columns">
					<?php
					if ( have_posts() ) : ?>
						<?php

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );
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
				</div><!--.graduate-list-->   
            </section><!--#team-sections-->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
		if ( graduate_is_sidebar_enable() ) {
			get_sidebar();
		} ?>
	</div><!-- .container -->
<?php
get_footer();

