<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

$options = graduate_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="tab-1" class="tab-content list-view">
		<div class="row">
			<?php  
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			?>
				<div class="column-wrapper">
					<div class="graduate-item-list">
						<div class="featured-image">
							<?php 
							if( has_post_thumbnail() ) :
								the_post_thumbnail( $size = 'graduate_trending_courses', $attr = array( 'alt' => esc_attr( get_the_title() ) ) );
							else :
				                echo '<img src="' . get_template_directory_uri().'/assets/uploads/no-featured-image-300x225.jpg" alt="' . esc_attr( get_the_title() ) . '">';
							endif;
							?>
						</div><!-- .featured-image -->
						<div class="graduate-content-wrapper">
							<div class="graduate-description">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php the_excerpt(); ?></p>
							</div><!--.graduate-description-->
							<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html( $options['read_more_text'] ); ?></a>
						</div>
					</div>
				</div><!--.column-wrapper-->
			<?php endwhile; ?>
		</div><!--.row-->
	</div><!--#tab-1-->

	<div id="tab-2" class="tab-content active">
		<div class="row wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="0.6s">
			<?php  
			/* Start the Loop */
			$i = 1;
			while ( have_posts() ) : the_post();
			?>
				<div class="column-wrapper">
					<div class="graduate-item-list">
						<div class="featured-image">
							<?php 
							if( has_post_thumbnail() ) :
								the_post_thumbnail( $size = 'graduate_trending_courses', $attr = array( 'alt' => esc_attr( get_the_title() ) ) );
							else :
				                echo '<img src="' . get_template_directory_uri().'/assets/uploads/no-featured-image-300x225.jpg" alt="' . esc_attr( get_the_title() ) . '">';
							endif;
							?>
						</div><!-- .featured-image -->
						<div class="graduate-content-wrapper">
							<div class="graduate-description">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php the_excerpt(); ?></p>
							</div><!--.graduate-description-->
							<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html( $options['read_more_text'] ); ?></a>
						</div>
					</div>
				</div><!--.column-wrapper-->
				<?php if( $i%3 == 0 ) : ?>
					</div>
					<div class="row wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="0.6s">
				<?php endif;  
				$i++;
			endwhile; ?>
		</div><!--.row-->
	</div><!--#tab-2-->
</article><!-- #post-## -->
