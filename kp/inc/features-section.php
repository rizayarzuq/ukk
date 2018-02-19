<?php
/**
 * Features section
 *
 * @package compact-one
 */

/**
 * Features section display function
 */
function compact_one_enable_features_section_func() {

	// section title -page.
	$compact_one_feature_title_page = get_theme_mod( 'compact_one_feature_title_page' );

	$compact_one_features_category = get_theme_mod( 'compact_one_features_category' );
	if ( ! empty( $compact_one_features_category ) ) {
		$cat_obj  = get_term( $compact_one_features_category, 'category' );
		$cat_type = $cat_obj->name;
		$args = array(
			'offset'           => 0,
			'category_name' => $cat_type,
			'orderby'          => 'post_date',
			'order'            => 'ASC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => false,
			'posts_per_page'    => 30,
		);
		$boxes_posts = new WP_Query( $args );
	}

	$box_counter    = 1;
?>
	<section id="compact_one_features_section" class="home_page_section">
		<div class="compact_one_features_section_background">
			<div class="container">
				<!-- page title and description -->
				<?php
				if ( $compact_one_feature_title_page ) {

					$features_qry = new WP_Query(
						array(
							'page_id' => $compact_one_feature_title_page,
						)
					);

					if ( $features_qry->have_posts() ) {
						while ( $features_qry->have_posts() ) {
							$features_qry->the_post();
							?>
							<h2 class="section_title wow fadeInDown"> 
								<span class="section_title_span"><?php the_title(); ?>  </span>
							</h2>
							<hr class="section_title_hr" />
	<?php
						}
					}
					wp_reset_postdata();
				}
			?>
				<div class="row feature_main_row">
					<div class="feature_main_img wow fadeInRight">
						<?php
						if ( $compact_one_feature_title_page ) {

							$features_qry = new WP_Query(
								array(
									'page_id' => $compact_one_feature_title_page,
								)
							);

							if ( $features_qry->have_posts() ) {
								while ( $features_qry->have_posts() ) {
									$features_qry->the_post();
									if ( has_post_thumbnail() ) {
										$compact_one_features_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
										$post_id = get_the_ID();
										$thumbnail_id = get_post_thumbnail_id( $post_id );
										$img_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
										?>
												<img src="<?php echo esc_url( $compact_one_features_image[0] ); ?>" class="features_img" alt="<?php echo esc_attr( $img_alt ); ?>">
				<?php
									}
								}
							}
							wp_reset_postdata();
						}
							?>
					</div>
					
					<div class="col-xs-12 col-sm-8 col-md-8">
						<div class="boxes row">
							<?php
							if ( ! empty( $compact_one_features_category ) ) {
								$cn = 0;
								if ( $boxes_posts->have_posts() ) {
									while ( $boxes_posts->have_posts() ) :
										$boxes_posts->the_post();
										$cn++;

										// Break after desired number of boxes displayed.
										if ( $box_counter > 2 ) {
											echo '</div><div class="boxes row">';
											$box_counter = 1;
										}
										$post_id = get_the_ID();
										$tw_boxes_img = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
										$tw_boxes_title = get_the_title( $post_id );
										$thumbnail_id = get_post_thumbnail_id( $post_id );
										$img_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );

										?>
										<div class="feature_each col-xs-12 col-sm-12 col-md-6">
											<div class="row wow fadeInLeft">
												<div class="col-xs-3 col-sm-3 col-md-3">
													<?php if ( ! empty( $tw_boxes_img ) ) { ?>
															<div class="feature_each_img">
																<img src="<?php echo esc_url( $tw_boxes_img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
															</div>
														<?php } ?>
												</div>
												<div class="col-xs-9 col-sm-9 col-md-9">
													<h3 class="feature_each_title"><?php echo esc_html( $tw_boxes_title ); ?> </h3>
													<?php
														add_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
														remove_filter( 'the_excerpt', 'wpautop' );
														?>
														<p class="feature_each_desc"><?php the_excerpt(); ?> </p>
													<?php
														add_filter( 'the_excerpt', 'wpautop' );
														remove_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
														?>
												</div>  
											</div>
											</div>
										<?php
										  $box_counter++;
									endwhile;
									wp_reset_postdata();
								} // end of if
							}

							?>
						</div>	<!-- end .boxes .row-->
					</div>
				
				</div>
			</div><!-- end of container -->
		</div>
	</section>
<?php
}
add_action( 'compact_one_enable_features_section', 'compact_one_enable_features_section_func' );
