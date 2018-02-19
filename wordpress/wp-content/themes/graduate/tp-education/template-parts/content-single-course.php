<?php
/**
 * Template part for displaying course posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

$options = graduate_get_theme_options();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php 
		$header_image_meta = graduate_header_image_meta_option();
		if ( ! $header_image_meta || is_front_page() ) :
			if ( ! get_header_image() ) :
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
			endif;
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content no-margin-top wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
		<div class="entry-meta">
			<?php 
			$tp_course_professor = get_post_meta( get_the_id(), 'tp_course_professor_value', true );
			$tp_course_professor = ! empty( $tp_course_professor ) ? $tp_course_professor : '';
			if ( ! empty( $tp_course_professor ) ) :
				$args = array(
					'post_type'	=> 'tp-team',
					'p'			=> $tp_course_professor
					);
				$posts = get_posts( $args );
				if( ! empty( $posts ) ) :
					foreach ( $posts as $post ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
				?>
						<div class="pull-left">
							<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
								<div class="image">
									<a href="<?php the_permalink( $post->ID ); ?>">
										<img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>" >
									</a>
								</div>
							<?php endif; ?>
							<div class="user">
								<small><?php _e( 'Professor', 'graduate' ); ?></small>
	                      		<small><a href="<?php the_permalink( $post->ID ); ?>" class="name"><?php the_title(); ?></a></small>
							</div>
						</div>
					<?php endforeach;
				endif; 
				wp_reset_postdata();
			endif;
			?>
			<div class="pull-left categories">
				<small><?php esc_html_e( 'Categories', 'graduate' ); ?></small>
				<small>
					<?php 
					if ( function_exists( 'tp_education_get_terms' ) ) :
						tp_education_get_terms( 'tp-course-category', get_the_id() ); 
					endif;
					?>
				</small>
			</div>

			<div class="pull-left categories">
				<small><?php esc_html_e( 'Likes', 'graduate' ); ?></small>
				<small>
				<?php 
				if ( function_exists( 'tp_education_like_button' ) ) :
					echo tp_education_like_button(); 
				endif;
				?>
				</small>
			</div>

			<div class="pull-left reviews">
				<small><?php esc_html_e( 'Reviews', 'graduate' ); ?></small>
				<small class="reviews-number">( <?php echo absint( get_comments_number() ) . ' ' . __( 'Reviews', 'graduate' ); ?> )</small>
			</div>

		</div><!--.entry-meta-->

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="details-image">
				<?php the_post_thumbnail( 'full', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
			</div>
		<?php } ?>
		<div class="tab pull-left">
			<ul class="tabs">
				<li class="tab-link active" data-tab="tab-3"><a href="#."><?php esc_html_e( 'Courses', 'graduate' ); ?></a></li>
				<li class="tab-link" data-tab="tab-4"><a href="#."><?php esc_html_e( 'Curriculum', 'graduate' ); ?></a></li>
				<li class="tab-link" data-tab="tab-5"><a href="#."><?php esc_html_e( 'Counselors', 'graduate' ); ?></a></li>
				<li class="tab-link" data-tab="tab-6"><a href="#."><?php esc_html_e( 'Reviews', 'graduate' ); ?></a></li>
			</ul><!--.tabs-->
		</div><!--.tab/pull-left-->

		<div class="courses-list two-columns">

			<div id="tab-3" class="tab-content active">
				<div class="tab-pane">
					<div class="details-text">
						<h2><?php esc_html_e( 'COURSE DESCRIPTION', 'graduate' ); ?></h2>
						<p>
						<?php 
						the_content( sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'graduate' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );
						?>
						</p>
					</div><!--.details-text-->
				</div><!--.row-->
			</div><!--.tab-3-->

			<div id="tab-4" class="tab-content">
				<div class="tab-pane">
					<div class="details-text">
						<h2><?php esc_html_e( 'RELATED COURSES', 'graduate' ); ?></h2>
						<ul>
							<?php 
							$term_id = array();
							$terms = wp_get_post_terms( get_the_ID(), 'tp-course-category', array( "fields" => "all" ) );
							foreach ( $terms as $term ) :
								$term_id[] = $term->term_id;
							endforeach;
							$args = array(
				                'post_type'         => $post_type,
				                'post__not_in'		=> array( get_the_id() ),
				                'tax_query'         => array(
				                    array(
				                        'taxonomy'  => 'tp-course-category',
				                        'field'     => 'id',
				                        'terms'     => $term_id
				                    )
				                )
				            );
				            $posts = get_posts( $args );
				            foreach ( $posts as $post )	: ?>
								<li><span><a href="<?php the_permalink( $post->ID ); ?>"><?php the_title(); ?></a></span></li>
				            <?php endforeach; 
				            wp_reset_postdata(); ?>			
						</ul>
					</div><!--.details-text-->

				</div><!--.tab-pane-->
			</div><!--.tab-4-->

			<div id="tab-5" class="tab-content">
				<div class="tab-pane">
					<div class="details-text">
						<h2><?php esc_html_e( 'COUNSELORS DETAIL', 'graduate' ); ?></h2>
						<ul class="comment-list">
							<?php  
							$tp_course_counselors = get_post_meta( get_the_id(), 'tp_course_counselors_value', true );
							$tp_course_counselors = ! empty( $tp_course_counselors ) ? $tp_course_counselors : '';
							if ( ! empty( $tp_course_counselors ) && $tp_course_counselors[0] !== 0 ) :
								$args = array(
									'post_type'	=> 'tp-team',
									'post__in'	=> $tp_course_counselors
								);
								$posts = get_posts( $args );
								foreach ( $posts as $post ) : ?>

								<li>
									
									<?php 
									if ( has_post_thumbnail( $post->ID ) )
										the_post_thumbnail( 'thumbnail', array( 'alt' => esc_attr( get_the_title( $post->ID ) ) ) );
									else 
	                                	echo '<img src="' . get_template_directory_uri() .'/assets/uploads/no-featured-image-200x200.jpg" alt="'. esc_attr( get_the_title() ) .'">';
									?>
									<span>
										<a href="<?php the_permalink( $post->ID ); ?>"><?php the_title(); ?></a>
										<?php 
										if ( function_exists( 'tp_team_designation' ) ) :
											tp_team_designation(); 
										endif;
										?>
									</span>

									<span class="course-counselor-detail">
										<?php echo graduate_trim_content( 25, $post  ); ?>
									</span>

								</li>

								<?php endforeach; 
						        wp_reset_postdata(); 
					        else : ?>
					        	<h5><?php esc_html_e( 'No Counselor Found !', 'graduate' ); ?></h5>
					        <?php endif; ?>	
						</ul>
					</div><!--.details-text-->

				</div><!--.tab-pane-->
			</div><!--.tab-5-->

			<div id="tab-6" class="tab-content">
				<div class="tab-pane">
					<div class="details-text">
						<?php  
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					</div><!--.details-text-->

				</div><!--.tab-pane-->
			</div><!--.tab-6-->

		</div><!--.courses-list-->


		<div class="course-features">
			<h2><?php esc_html_e( 'COURSE FEATURE', 'graduate' ); ?></h2>
			<ul>
				<?php if ( class_exists( 'TP_Education' ) ) : ?>
					<li><?php tp_course_price(); ?></li>
					<li><?php tp_course_type(); ?></li>
					<li><?php tp_course_students(); ?></li>
					<li><?php tp_course_duration(); ?></li>
					<li><?php tp_course_skills(); ?></li>
					<li><?php tp_course_language(); ?></li>
					<li><?php tp_course_assessment(); ?></li>
				<?php endif; ?>
			</ul>
		</div><!--.course-features-->

		<?php 
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'graduate' ),
				'after'  => '</div>',
			) );

		?>

	</div><!-- .entry-content -->

	<?php  
	/**
	* Hook graduate_action_post_pagination
	*  
	* @hooked graduate_post_pagination 
	*/
	do_action( 'graduate_action_post_pagination' );

	$courses = wp_count_posts( 'tp-course' );
	$courses = $courses->publish;

	if ( $courses > 1 ) :
		$args = array(
			'post_type'			=> 'tp-course',
			'posts_per_page'	=> 3,
			'order'				=> 'rand',
			'post__not_in'		=> array( get_the_ID() ),
			);

		$posts = get_posts( $args );
		if ( ! empty( $posts ) ) :
		?>
			<div class="related-courses">
				<h2><?php _e( 'YOU MAY LIKE', 'graduate' ); ?></h2>
				<div class="three-columns">
					<div class="row wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="0.3s">
						<?php foreach ( $posts as $post ) : ?>
							<div class="column-wrapper">
								<div class="course-item clear">
									<div class="featured-image">
										<?php 
										if( has_post_thumbnail( $post->ID ) ) :
											the_post_thumbnail( 'graduate_trending_courses', array( 'alt' => esc_attr( get_the_title( $post->ID ) ) ) );
										else :
							                echo '<img src="' . get_template_directory_uri().'/assets/uploads/no-featured-image-300x225.jpg" alt="' . esc_attr( get_the_title( $post->ID ) ) . '">';
										endif;
										?>
									</div><!--.featured-image-->
									<?php  
									$year  = get_the_time('Y');
								    $month = get_the_time('m');
								    $post_type = 'tp-course';
									$date_url = tp_education_post_type_date_link( $post_type, $year, $month );
									$length = ! empty( $options['long_excerpt_length'] ) ? $options['long_excerpt_length'] : 20;
									?>
									<div class="course-contents-wrapper">
										<div class="course-content">
											<a href="<?php echo esc_url( $date_url ); ?>" class="date"><?php echo date_i18n( esc_html__( "F d, Y", 'graduate' ), strtotime( get_the_date() ) ); ?></a>
											<h3><a href="<?php the_permalink( $post->ID ); ?>"><?php echo esc_html( get_the_title( $post->ID ) ); ?></a></h3>
											<p><?php echo esc_html( graduate_trim_content( absint( $length ), $post ) ); ?></p>
										</div><!--.course-content-->
										<div class="users clear">
											<a href="<?php the_permalink( $post->ID ); ?>" class="button"><?php echo esc_html( $options['read_more_text'] ); ?></a>
										</div><!--.users-->
									</div><!-- .course-contents-wrapper -->
								</div><!-- .course-item -->
							</div><!--.column-wrapper-->
						<?php endforeach; 
						wp_reset_postdata(); ?>
					</div><!--.row-->
				</div><!--.related-courses-->
			</div><!--.related-courses-->  

		<?php endif; 
	endif; ?>
</article><!-- #post-## -->
