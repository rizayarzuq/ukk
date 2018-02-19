<?php
/**
 * Template part for displaying testimonial post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

$options = graduate_get_theme_options();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section id="testimonial-single">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<figure class="featured-image">
					<?php  
					if ( has_post_thumbnail() )
						the_post_thumbnail( 'thumbnail', array( 'alt' => esc_attr( get_the_title() ) ) );
					?>
				</figure>
				<div class="entry-container">
					<h2><?php the_title(); ?></h2>
					<span class="position">
						<?php  
						// testimonial designation
						if ( function_exists( 'tp_testimonial_designation' ) )
							tp_testimonial_designation();
						?>
					</span>
					<ul class="star-rating">
						<?php  
						// testimonial ratings
						if ( function_exists( 'tp_testimonial_rating' ) )
							tp_testimonial_rating();
						?>
					</ul><!-- .star-rating -->

					<div class="description">
						<p><?php the_content(); ?></p>
					</div><!-- .description -->

					<?php  
					// Testimonial Social Icons
					if ( function_exists( 'tp_testimonial_social' ) )
						tp_testimonial_social();
					?>
				</div><!-- .entry-container -->
			</article>

			<?php  
	    	/**
			* Hook graduate_action_testimonial_pagination
			*  
			* @hooked graduate_testimonial_pagination 
			*/
			do_action( 'graduate_action_testimonial_pagination' );
	    	?>

			<div class="testimonial-thumbs">
				<?php  
				$testimonial_id = get_the_ID();
				$args = array(
					'post_type'			=> 'tp-testimonial',
					'posts_per_page'	=> -1,
					'order'				=> 'ASC',
					);
				$posts = get_posts( $args );
				?>
				<ul>
					<?php foreach ( $posts as $post ) : ?>
						<li class="<?php echo ( $testimonial_id == $post->ID ) ? 'active' : ''; ?>" >
							<a href="<?php the_permalink( $post->ID ); ?>" title="<?php the_title(); ?>">
								<div class="blue-overlay"></div>
								<?php  
								if ( has_post_thumbnail( $post->ID ) ) :
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
								else :
									$image[0] = get_template_directory_uri() . '/assets/uploads/no-featured-image-200x200.jpg';
								endif;
								?>
								<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>" >
							</a>
						</li>
					<?php endforeach; 
					wp_reset_postdata(); ?>
				</ul>
			</div><!-- .testimonial-thumbs -->
		</section><!-- #testimonial-slider -->
	</main><!--#main-->
</div><!--#primary-->
