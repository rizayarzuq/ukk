<?php
/**
 * Team section
 *
 * @package compact-one
 */

/**
 * Team section display function
 */
function compact_one_enable_team_section_func() {

	// section title -page.
	$compact_one_team_title_page = get_theme_mod( 'compact_one_team_title_page' );
	$compact_one_team_category = get_theme_mod( 'compact_one_team_category' );
	if ( ! empty( $compact_one_team_category ) ) {
			$cat_obj_team  = get_term( $compact_one_team_category, 'category' );
			$cat_type_team = $cat_obj_team->name;

			$args_team = array(
				'posts_per_page'      => 30,
				'offset'           => 0,
				'category_name' => $cat_type_team,
				'orderby'          => 'post_date',
				'order'            => 'ASC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => false,
			);
			$team_posts = new WP_Query( $args_team );
	}
?>
	<section id="compact_one_team_section" class="home_page_section">
		<div class="container">
			<!-- page title and description -->
			<?php
			if ( $compact_one_team_title_page ) {

				$team_qry = new WP_Query(
					array(
						'page_id' => $compact_one_team_title_page,
					)
				);

				if ( $team_qry->have_posts() ) {
					while ( $team_qry->have_posts() ) {
						$team_qry->the_post();
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
			<div class="row">
				<?php
				if ( ! empty( $compact_one_team_category ) ) {
					$tn = 0;
					if ( $team_posts->have_posts() ) {
						while ( $team_posts->have_posts() ) :
							$team_posts->the_post();
							$tn++;

							$post_id = get_the_ID();
							$tw_showcase_img = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
							$tw_showcase_title = get_the_title( $post_id );
							$thumbnail_id = get_post_thumbnail_id( $post_id );
							$img_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
							?>

							<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="tw_team_div">
									<div class="tw_showcase_img_div">
										<img src="<?php echo esc_url( $tw_showcase_img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
										<a href="#portfolioModal<?php echo esc_attr( $post_id ); ?>" class="portfolio-link" data-toggle="modal">
											<div class="team_member_details">
												<h3 class="tw_showcase_title"><?php echo esc_html( $tw_showcase_title ); ?></h3>
												<?php
														add_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
														remove_filter( 'the_excerpt', 'wpautop' );
														?>
														<p class="tw_showcase_desc"><?php the_excerpt(); ?> </p>
													<?php
														add_filter( 'the_excerpt', 'wpautop' );
														remove_filter( 'excerpt_length', 'compact_one_sections_excerpt_length' );
														?>
											</div>
										</a>
									</div>
								
								</div>
							</div>
				<?php
					endwhile;
						wp_reset_postdata();
					} // end of if
				}
			?>
			</div>
		</div><!-- end of container -->

<?php
if ( ! empty( $compact_one_team_category ) ) {
	$myposts = new WP_Query( $args_team );

	$tn2 = 0;
	if ( $myposts->have_posts() ) {
		while ( $myposts->have_posts() ) :
			$myposts->the_post();
			$tn2++;
			$tw_showcase_desc = get_the_content();
			$mypost_id = get_the_ID();
		?>
		<div class="portfolio-modal modal fade" id="portfolioModal<?php echo esc_attr( $mypost_id ); ?>" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-content">
					<div class="close-modal" data-dismiss="modal">
						<div class="lr">
							<div class="rl">
							</div>
						</div>
					</div>
					<div class="container-full-width">
						<div class="row">
							<div class="col-lg-12">
								<div class="modal-body">   
									<p class="item-intro text-muted"><?php echo esc_html( $tw_showcase_desc ); ?></p>
								
									   </div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php
	endwhile;
		wp_reset_postdata();
	} // end of if
}
?>
	</section>
<?php
}
add_action( 'compact_one_enable_team_section', 'compact_one_enable_team_section_func' );
