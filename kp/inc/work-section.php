<?php
/**
 * Work section
 *
 * @package compact-one
 */

/**
 * Work section display function
 */
function compact_one_enable_work_section_func() {

	// section title -page.
	$compact_one_work_section_title = get_theme_mod( 'compact_one_work_section_title' );

	// post categories for sub-section.
	$compact_one_work_profile_category = get_theme_mod( 'compact_one_work_profile_category' );

	$compact_one_work_category_1_id = get_theme_mod( 'compact_one_work_category_1' );
	$compact_one_work_category_2_id = get_theme_mod( 'compact_one_work_category_2' );
	$compact_one_work_category_3_id = get_theme_mod( 'compact_one_work_category_3' );

	$work_args_all = array(
		'posts_per_page'      => 30,
		'offset'           => 0,
		'cat' => array( $compact_one_work_category_1_id, $compact_one_work_category_2_id, $compact_one_work_category_3_id ),
		'orderby'          => 'post_date',
		'order'            => 'ASC',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => false,
	);
	if ( ( ! empty( $compact_one_work_category_1_id )) || ( ! empty( $compact_one_work_category_2_id )) || ( ! empty( $compact_one_work_category_3_id )) ) {
		$compact_one_work_category_all_posts = new WP_Query( $work_args_all );
	}

	if ( ! empty( $compact_one_work_category_1_id ) ) {
		$cat_obj  = get_term( $compact_one_work_category_1_id, 'category' );
		$compact_one_work_category_1_name = $cat_obj->name;
		$compact_one_work_category_1_slug = $cat_obj->slug;
	}

	if ( ! empty( $compact_one_work_category_2_id ) ) {
		$cat_obj2  = get_term( $compact_one_work_category_2_id, 'category' );
		$compact_one_work_category_2_name = $cat_obj2->name;
		$compact_one_work_category_2_slug = $cat_obj2->slug;
	}

	if ( ! empty( $compact_one_work_category_3_id ) ) {
		$cat_obj3  = get_term( $compact_one_work_category_3_id, 'category' );
		$compact_one_work_category_3_name = $cat_obj3->name;
		$compact_one_work_category_3_slug = $cat_obj3->slug;
	}
?>
	<section id="compact_one_work_section" class="home_page_section">
		<div class="container">
			<!-- page title and description -->
			<?php
			if ( $compact_one_work_section_title ) {

				$wrk_qry = new WP_Query(
					array(
						'page_id' => $compact_one_work_section_title,
					)
				);

				if ( $wrk_qry->have_posts() ) {
					while ( $wrk_qry->have_posts() ) {
						$wrk_qry->the_post();
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
			<?php if ( ( ! empty( $compact_one_work_category_1_id )) || ( ! empty( $compact_one_work_category_2_id )) || ( ! empty( $compact_one_work_category_3_id )) ) { ?>
				<div class="button-group filters-button-group compact_one_tabs">
					<button class="button is-checked" data-filter="*"><?php echo esc_html( __( 'All','compact-one' ) ); ?></button>
					<?php if ( ! empty( $compact_one_work_category_1_slug ) ) { ?>
						<button class="button" data-filter=".<?php echo esc_attr( $compact_one_work_category_1_slug ); ?>"><?php echo esc_html( $compact_one_work_category_1_name ); ?>
						</button>
					<?php } ?>
					<?php if ( ! empty( $compact_one_work_category_2_slug ) ) { ?>
						<button class="button" data-filter=".<?php echo esc_attr( $compact_one_work_category_2_slug ); ?>"><?php echo esc_html( $compact_one_work_category_2_name ); ?>
						</button>
					<?php } ?>
					<?php if ( ! empty( $compact_one_work_category_3_slug ) ) { ?>
						<button class="button" data-filter=".<?php echo esc_attr( $compact_one_work_category_3_slug ); ?>"><?php echo esc_html( $compact_one_work_category_3_name ); ?>
						</button>
					<?php } ?>
				</div>
			<?php } ?>
			<div class="grid row">
			<?php

			$wn = 0;
			if ( ! empty( $compact_one_work_category_all_posts ) ) {
				if ( $compact_one_work_category_all_posts->have_posts() ) {

					while ( $compact_one_work_category_all_posts->have_posts() ) :
						$compact_one_work_category_all_posts->the_post();
						$wn++;
						$post_id = get_the_ID();

						$test = get_the_terms( $post_id, 'category' );
						foreach ( $test as $singleterm ) {
							$value_new[] = $singleterm->slug;
						}

						$tw_portfolio_img = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
						$tw_portfolio_title = get_the_title( $post_id );
						$tw_portfolio_desc = get_the_content();
						$tw_portfolio_desc_short = wp_trim_words( $tw_portfolio_desc, 10 );
						$thumbnail_id = get_post_thumbnail_id( $post_id );
						$img_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
			?>
						<div class="element-item col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center tw_portfolio_each <?php echo esc_attr( implode( ' ', $value_new ) ); ?>" >
							<figure class="imghvr-push-up">
								<img src="<?php echo esc_url( $tw_portfolio_img ); ?>" class="img-responsive tw_work_img" alt="<?php echo esc_attr( $img_alt ); ?>">                
								<figcaption>
									<a class="magnific-popup" rel="cyberchimps-lightbox" href="<?php echo esc_url( $tw_portfolio_img ); ?>">
										<i class="fa fa-search fa-2x"></i>
										<div class="tw_portfolio_title_metabox"><?php echo esc_html( $tw_portfolio_title ); ?></div>
										<div class="tw_portfolio_desc_metabox">
											<?php
												add_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
												the_excerpt();
												remove_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
											?>
										</div>
									</a>
								</figcaption>
							</figure>
						</div>
			<?php
						unset( $value_new );
					endwhile;
					wp_reset_postdata();
				} // end of if
			}
		?>
			</div><!-- end of class .grid -->

		</div><!-- end of .container -->

		<div class="company_profile_section">
			<div class="container">
				<div class="row co_profile_row">

				<?php
				if ( $compact_one_work_profile_category ) {
						remove_filter( 'the_content','wpautop' );
						?>
			<?php
			  $profile_posts = new WP_Query(
				  array(
					  'cat' => $compact_one_work_profile_category,
					  'posts_per_page' => 4,
					  'ignore_sticky_posts' => true,
				  )
			  );
			if ( $profile_posts->have_posts() ) {
				while ( $profile_posts->have_posts() ) {
					$profile_posts->the_post();
					?>
	
							 <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 count">
						<?php
						if ( has_post_thumbnail() ) {
											$compact_one_profile_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
											$post_id = get_the_ID();
											$thumbnail_id = get_post_thumbnail_id( $post_id );
											$img_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
											?>
										<img src="<?php echo esc_url( $compact_one_profile_image[0] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
									<?php } ?>
									<p class="ht_pt_count counter"> <?php the_content(); ?></p>
									<p class="ht_pt_heading"><?php the_title(); ?></p>						    		
								</div>
							<?php
				}
			}
						wp_reset_postdata();
						add_filter( 'the_content','wpautop' );
				}
?>
				</div>
			</div>  <!-- end of container -->
		</div>
	</section>
<?php
}
add_action( 'compact_one_enable_work_section', 'compact_one_enable_work_section_func' );
