<?php
/**
 * TP Education Hooks Overwrite
 *
 * @package Graduate
 * @since Graduate 0.1
 */

// Remove Action
remove_action( 'tp_education_archive_class_content_action', 'tp_education_archive_class_content', 10 );
remove_action( 'tp_education_archive_course_content_action', 'tp_education_archive_course_content', 10 );
remove_action( 'tp_education_archive_event_content_action', 'tp_education_archive_event_content', 10 );
remove_action( 'tp_education_archive_team_content_action', 'tp_education_archive_team_content', 10 );
remove_action( 'tp_education_archive_excursion_content_action', 'tp_education_archive_excursion_content', 10 );
remove_action( 'tp_education_archive_affiliation_content_action', 'tp_education_archive_affiliation_content', 10 );
remove_action( 'tp_education_archive_testimonial_content_action', 'tp_education_archive_testimonial_content', 10 );

// Add Action
add_action( 'tp_education_archive_class_content_action', 'graduate_tp_education_posts_content', 10 );
add_action( 'tp_education_archive_course_content_action', 'graduate_tp_education_posts_content', 10 );
add_action( 'tp_education_archive_event_content_action', 'graduate_tp_education_posts_content', 10 );
add_action( 'tp_education_archive_team_content_action', 'graduate_tp_education_posts_content', 10 );
add_action( 'tp_education_archive_excursion_content_action', 'graduate_tp_education_posts_content', 10 );
add_action( 'tp_education_archive_affiliation_content_action', 'graduate_tp_education_posts_content', 10 );
add_action( 'tp_education_archive_testimonial_content_action', 'graduate_tp_education_posts_content', 10 );

if ( ! function_exists( 'graduate_tp_education_posts_content' ) ) :
	/**
	 * TP Education post content format
	 *
	 * @return content format of posts
	 */
	
	function graduate_tp_education_posts_content() { 
		$options = graduate_get_theme_options();
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
		<li class="column-wrapper tp-posts">
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
						<a href="<?php echo esc_url( $date_url ); ?>" class="date"><?php echo date_i18n( esc_html__( "F d, Y", 'graduate' ), strtotime( get_the_date() ) ); ?></a>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php the_excerpt(); ?></p>
					</div><!--.graduate-description-->
					<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html( $options['read_more_text'] ); ?></a>
				</div>
			</div>
		</li><!--.column-wrapper-->
	<?php
	}
endif;