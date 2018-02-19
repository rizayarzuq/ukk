<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

get_header(); ?>
<div class="container page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<section id="graduate">

              	<div class="graduate-list three-columns">
					<?php if ( have_posts() ) : ?>
                		<div class="tab-sections clear">
		              	<?php if( get_query_var( 'monthnum' ) == '' ) : ?>
			                <div class="choose-graduate pull-left">
			                <?php
			                $tp_cat = get_query_var( 'cat' );
			                $tp_cat = get_category( $tp_cat, $output = OBJECT, $filter = 'raw' );
			                $tp_cat_selected = ! empty( $tp_cat->slug ) ? $tp_cat->slug : '' ;
			                $taxonomy = 'category';
			                $args = array(
			                    'hide_empty'         => 0,              
			                    'selected'           => 1,
			                    'hierarchical'       => 1,
			                    'name'               => $taxonomy,
			                    'class'              => '',              
			                    'taxonomy'           => $taxonomy,
			                    'selected'           => $tp_cat_selected,
			                    'value_field'        => 'slug'
			                );

			                wp_dropdown_categories( $args, $taxonomy );
			                ?>
			                </div><!--.choose-graduate-->
		                <?php endif; ?>
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

						<?php
						
							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', get_post_format() );

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
		</div><!-- #primary -->
	<?php
		if ( graduate_is_sidebar_enable() ) {
			get_sidebar();
		} ?>
</div><!-- .container -->
<?php
get_footer();
