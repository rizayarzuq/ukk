<?php
/**
 * Contact section
 *
 * @package compact-one
 */

/**
 * Contact section display function
 */
function compact_one_enable_contact_section_func() {
	// section title -page.
	$compact_one_contact_title_page = get_theme_mod( 'compact_one_contact_title_page' );

	// posts.
	$compact_one_contact_left_details = get_theme_mod( 'compact_one_contact_left_details' );
	$compact_one_contact_right_details = get_theme_mod( 'compact_one_contact_right_details' );
	$compact_one_contact_bottom_details = get_theme_mod( 'compact_one_contact_bottom_details' );

?>
	<section id="compact_one_contact_section" class="home_page_section">
		<div class="container">
			<!-- page title and description -->
				<?php
				if ( $compact_one_contact_title_page ) {

					$contct_qry = new WP_Query(
						array(
							'page_id' => $compact_one_contact_title_page,
						)
					);

					if ( $contct_qry->have_posts() ) {
						while ( $contct_qry->have_posts() ) {
							$contct_qry->the_post();
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
				<div class="col-md-8">
					<?php
					if ( $compact_one_contact_left_details ) {
							$ccontact_left = get_post( $compact_one_contact_left_details );
							setup_postdata( $ccontact_left );
?>
							<h3 class="contact_sub_title compact_one_contact_form"><?php echo esc_html( $ccontact_left->post_title ); ?></h3>
							<div>
								<?php the_content(); ?>
							</div>
					<?php
							wp_reset_postdata();
					}
						?>
				
				</div>
				<div class="col-md-4">
					<?php
					if ( $compact_one_contact_right_details ) {
							$ccontact_right = get_post( $compact_one_contact_right_details );
							setup_postdata( $ccontact_right );
?>
							
							<h3 class="contact_sub_title"><?php echo esc_html( $ccontact_right->post_title ); ?></h3>
							<?php
							the_content();
							wp_reset_postdata();
					}
						?>
					
				</div>
			</div>
		</div> <!-- end of container -->
		<div class="contact_maps">
			<?php
			if ( $compact_one_contact_bottom_details ) {
					remove_filter( 'the_content','wpautop' );
					$ccontact_bottom = get_post( $compact_one_contact_bottom_details );
					setup_postdata( $ccontact_bottom );
?>
							
					<?php
					the_content();
					wp_reset_postdata();
					add_filter( 'the_content','wpautop' );
			}
				?>
		</div>
	</section>
<?php
}
add_action( 'compact_one_enable_contact_section', 'compact_one_enable_contact_section_func' );
