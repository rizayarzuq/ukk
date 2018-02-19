<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

$options = graduate_get_theme_options();
?>

<div id="tab-1" class="tab-content list-view">
	<div class="row">
		<?php  
		/* Start the Loop */
		while ( have_posts() ) : the_post();
		?>
			<div class="column-wrapper">
				<div class="graduate-item-list">
					<div class="featured-image">
						<a href="<?php the_permalink(); ?>">
							<?php 
							if( has_post_thumbnail() ) :
								the_post_thumbnail( $size = 'graduate_trending_courses', $attr = array( 'alt' => esc_attr( get_the_title() ) ) );
							else :
				                echo '<img src="' . get_template_directory_uri().'/assets/uploads/no-featured-image-300x225.jpg" alt="' . esc_attr( get_the_title() ) . '">';
							endif;
							?>
						</a>
						<?php
						if ( 'post' === get_post_type() ) {
							$date_url = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
						} else {
							if ( function_exists( 'tp_education_post_type_date_link' ) ) {
								$year  = get_the_time('Y');
							    $month = get_the_time('m');
							    $post_type = get_post_type( get_the_id() );
								$date_url = tp_education_post_type_date_link( $post_type, $year, $month );
							} else {
								$date_url = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
							}
						}
						?>
					</div><!-- .featured-image -->
					<div class="graduate-content-wrapper">
						<div class="graduate-description">
							<a href="<?php echo esc_url( $date_url ); ?>" class="date"><?php echo date_i18n( esc_html__( "F d, Y", 'graduate' ), strtotime( get_the_date() ) ); ?></a>
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
						<a href="<?php the_permalink(); ?>">
							<?php 
							if( has_post_thumbnail() ) :
								the_post_thumbnail( $size = 'graduate_trending_courses', $attr = array( 'alt' => esc_attr( get_the_title() ) ) );
							else :
				                echo '<img src="' . get_template_directory_uri().'/assets/uploads/no-featured-image-300x225.jpg" alt="' . esc_attr( get_the_title() ) . '">';
							endif;
							?>
						</a>
					</div><!-- .featured-image -->
					<div class="graduate-content-wrapper">
						<div class="graduate-description">
							<a href="<?php echo esc_url( $date_url ); ?>" class="date"><?php echo date_i18n( esc_html__( "F d, Y", 'graduate' ), strtotime( get_the_date() ) ); ?></a>
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
