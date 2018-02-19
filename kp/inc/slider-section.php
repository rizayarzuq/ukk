<?php
/**
 * Slider section
 *
 * @package compact-one
 */

/**
 * Slider section display function
 */
function compact_one_enable_slider_func() {
		$compact_one_slider_category = get_theme_mod( 'compact_one_slider_category' );

	if ( ! empty( $compact_one_slider_category ) ) {
		$cat_obj  = get_term( $compact_one_slider_category, 'category' );
		$cat_type = $cat_obj->name;

		// set args for slider.
		$slider_posts = new WP_Query(
			array(
				'cat' => $compact_one_slider_category,
				'posts_per_page' => 30,
				'ignore_sticky_posts' => true,
			)
		);
	}

?>
	<section id="compact_one_slider_section" class="home_page_section">
		<!--<div class="compact_one_slider_layer">-->
			<div id="compact_one_slider" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner compact_one_carousel" role="listbox">
					<?php
					if ( ! empty( $compact_one_slider_category ) ) {
						$slide_counter = 1;
						$sn = 0;

						if ( $slider_posts->have_posts() ) {
							while ( $slider_posts->have_posts() ) :
								$slider_posts->the_post();
								$sn++;

								// Getting ID of the current post.
								$post_id = get_the_ID();

								// Getting individual options of each post.
								$tw_slider_img        = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
								$tw_slider_title      = get_the_title( $post_id );
								if ( ! empty( $tw_slider_img ) ) {
								?>
										<div class="item <?php echo ( 1 === $slide_counter ) ? 'active' : ''; ?>" style="width:100%;">
										<div class="responsive_slider_img" style="background-image:url('<?php echo esc_url( $tw_slider_img ); ?>'); background-size:cover; background-position: center; background-size: cover;"> 								
											<div class="caption">
												<div class="inner-caption">
													<h1><?php echo esc_html( $tw_slider_title ); ?></h1>
													<?php
														add_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
														the_excerpt();
														remove_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
													?>
												</div>
											</div>
										</div>
										</div>
									<?php $slide_counter++; ?>
							<?php
								} else {
								?>
									<div class="item <?php echo ( 1 === $slide_counter ) ? 'active' : ''; ?>" style="width:100%;">
										<div class="caption no-image-caption">
											<div class="inner-caption">
												<h1><?php echo esc_html( $tw_slider_title ); ?></h1>
												<?php
													add_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
													the_excerpt();
													remove_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
												?>
											</div>
										</div>
									</div>
									<?php $slide_counter++; ?>
<?php
								}
							endwhile;
							wp_reset_postdata();
						}
					} else {
					?>
						<div class="item active">
							<div class="responsive_slider_img" style="background-image:url('<?php echo esc_url( get_template_directory_uri() . '/inc/images/slider1.jpg' ); ?>'); background-size:cover; background-position: center; background-size: cover;"> 								
								<div class="caption">
									<div class="inner-caption">
										<h1><?php echo esc_html( 'Slider Caption','compact-one' ); ?></h1>
										<p><?php echo esc_html( 'Slider Description','compact-one' ); ?></p>
									</div>
								</div>
							</div>
						</div>
			<?php
					}
				?>
				
				</div><!-- end of carousel-inner -->
				<div class="container arrows">
					<div class="arrow_left_div">
						<a class="arrow_left" href="#compact_one_slider" data-slide="prev">
						</a>
					</div>
					<div class="arrow_right_div">
						<a class="arrow_right" href="#compact_one_slider" data-slide="next">
						</a>
					</div>
				</div>
			</div>
		<!--</div>--><!-- end of compact_one slider layer -->
	</section>
<?php
}
add_action( 'compact_one_enable_slider', 'compact_one_enable_slider_func' );
