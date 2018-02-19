<?php
/**
 * Testimonial section
 *
 * @package compact-one
 */

/**
 * Testimonial section display function
 */
function compact_one_enable_testimonial_section_func() {

	$compact_one_testimonial_category = get_theme_mod( 'compact_one_testimonial_category' );

	// section title -page.
	$compact_one_testimonial_title_page = get_theme_mod( 'compact_one_testimonial_title_page' );

	if ( ! empty( $compact_one_testimonial_category ) ) {
		$cat_obj_test  = get_term( $compact_one_testimonial_category, 'category' );
		$cat_type_test = $cat_obj_test->name;

		$args_test = array(
			'posts_per_page'      => 30,
			'offset'           => 0,
			'category_name' => $cat_type_test,
			'orderby'          => 'post_date',
			'order'            => 'ASC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => false,
		);
		$testimonial_posts = new WP_Query( $args_test );
	}
?>
	<section id="compact_one_testimonial_section" class="home_page_section" >
		<!-- page title and img -->
		<?php
		if ( $compact_one_testimonial_title_page ) {

			$tst_qry = new WP_Query(
				array(
					'page_id' => $compact_one_testimonial_title_page,
				)
			);

			if ( $tst_qry->have_posts() ) {
				while ( $tst_qry->have_posts() ) {
					$tst_qry->the_post();
					if ( has_post_thumbnail() ) {
						$compact_one_tst_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					}
						?>
							<div class="compact_one_testimonial_background" style="background:url('<?php echo esc_url( $compact_one_tst_image[0] ); ?>'); background-size:cover; background-position:center;">
							<div class="test_layer">
								<div class="container">
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
					
						
		<?php
		$slide_counter2 = 0;
		if ( ! empty( $compact_one_testimonial_category ) ) {
		?>
			<!-- carousel -->
			<div id="compact_one_testimonial_slider" class="carousel slide carousel-fade" data-ride="carousel">
			<?php
			$tsn = 0;
			if ( $testimonial_posts->have_posts() ) {
			?>
					<ol class="carousel-indicators">
					<?php
					while ( $testimonial_posts->have_posts() ) :
						$testimonial_posts->the_post();
						$tsn++;
				?>
					<li class="<?php echo ( 0 === $slide_counter2 ) ? 'active' : ''; ?>" data-slide-to="<?php echo esc_attr( $slide_counter2 ); ?>" data-target="#compact_one_testimonial_slider"></li>
				<?php
					$slide_counter2++;
					endwhile;
				?>
					</ol>
			<?php
			}
		?>
						
			<div class="carousel-inner" role="listbox">
			<?php
				$slide_counter1 = 1;
				$tsn2 = 0;
			if ( $testimonial_posts->have_posts() ) {
				while ( $testimonial_posts->have_posts() ) :
						$testimonial_posts->the_post();
						$tsn2++;
						// Getting ID of the current post.
						$post_id = get_the_ID();

						// Getting individual options of each post.
						$tw_testimonial_img        = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
						$tw_testimonial_title      = get_the_title( $post_id );
						$tw_testimonial_text  = get_the_content();
						$thumbnail_id = get_post_thumbnail_id( $post_id );
						$img_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
?>
						<div class="testimonial_main_div item <?php echo ( 1 === $slide_counter1 ) ? 'active' : ''; ?>">
							<div class="testimonial_img"><img src="<?php echo esc_url( $tw_testimonial_img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>"/></div>
							<div class="testimonial_main_text">
								<p class="testimonial_author"><?php echo esc_html( $tw_testimonial_title ); ?></p>
								<p class="testimonial_text"><?php echo esc_html( $tw_testimonial_text ); ?></p>
							</div>					    
						</div>	
						<?php
						$slide_counter1++;
						endwhile;
			}

			?>

			</div><!-- end of carousel inner -->
<?php
		} //end of if
?>
		</div>
			</div><!-- end of container -->
		</div>
	</div>
</section>
<?php
}
add_action( 'compact_one_enable_testimonial_section', 'compact_one_enable_testimonial_section_func' );
