<?php
/**
 * About us section
 *
 * @package compact-one
 */

/**
 * About us section display function
 */
function compact_one_enable_about_section_func() {

		// section title -page.
		$compact_one_about_desc = get_theme_mod( 'compact_one_about_desc' );

		// post categories for sub-sections.
		$compact_one_about_skills_category = get_theme_mod( 'compact_one_about_skills_category' );
		$compact_one_about_co_values_category = get_theme_mod( 'compact_one_about_co_values_category' );

?>
	<section id="compact_one_about_section" class="home_page_section">
		<div class="container">

			<!-- page title and description -->
				<?php
				if ( $compact_one_about_desc ) {

					$about_qry = new WP_Query(
						array(
							'page_id' => $compact_one_about_desc,
						)
					);

					if ( $about_qry->have_posts() ) {
						while ( $about_qry->have_posts() ) {
							$about_qry->the_post();
							?>
							<h2 class="section_title wow fadeInDown"> 
								<span class="section_title_span"><?php the_title(); ?>  </span>
							</h2>
							<hr class="section_title_hr" />
							<div class="compact_one_about_desc"><?php the_content(); ?> </div>
	<?php
						}
					}
					wp_reset_postdata();
				}
			?>
			<div class="row">
				<div class="col-md-6">

			<?php
			if ( $compact_one_about_skills_category ) {
						remove_filter( 'the_content','wpautop' );
						$skills_cat_name = get_cat_name( $compact_one_about_skills_category );
						?>
						<h3 class="tw_subsection_titles"><?php echo esc_html( $skills_cat_name ); ?></h3> 
			<?php
			  $skills_posts = new WP_Query(
				  array(
					  'cat' => $compact_one_about_skills_category,
					  'posts_per_page' => 30,
					  'ignore_sticky_posts' => true,
				  )
			  );
			if ( $skills_posts->have_posts() ) {
				while ( $skills_posts->have_posts() ) {
					$skills_posts->the_post();
					?>
	
							 <div class="progress skill-bar">
						<div class="progress-bar wow fadeInLeft" role="progressbar" aria-valuenow="<?php echo esc_attr( absint( get_the_content() ) ); ?>" aria-valuemin="0" aria-valuemax="100">
							<span class="val"><?php the_content(); ?></span>
						</div>
								</div>
								<span class="progress-title"><?php the_title(); ?></span>
							<?php
				}
			}
						wp_reset_postdata();
						add_filter( 'the_content','wpautop' );
			}
?>
				</div>
				<div class="col-md-6">

				<?php
				if ( $compact_one_about_co_values_category ) {
						$values_cat_name = get_cat_name( $compact_one_about_co_values_category );
						?>
						<h3 class="tw_subsection_titles"><?php echo esc_html( $values_cat_name ); ?></h3> 
			<?php
			  $values_posts = new WP_Query(
				  array(
					  'cat' => $compact_one_about_co_values_category,
					  'posts_per_page' => 30,
					  'ignore_sticky_posts' => true,
				  )
			  );
			if ( $values_posts->have_posts() ) {
				$vn = 0;
			?>
				<div class="tabContent" id="tabContent1">
					<div class="panel-group" id="accordion">
					<?php
					while ( $values_posts->have_posts() ) {
						$values_posts->the_post();
						$vn++;
						?>
					
						 <div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo esc_attr( $vn ); ?>"><i class="more-less glyphicon glyphicon-minus"></i><?php the_title(); ?> </a>
								</h4>
							</div>
							<div id="collapse<?php echo esc_attr( $vn ); ?>" class="panel-collapse collapse">
								<div class="panel-body">
									<?php the_content(); ?>
								</div>
							</div>
							</div>
									<?php
					}
			}
								wp_reset_postdata();
								?>
							</div><!-- end of .panel-group -->
						</div><!-- end of .tabContent -->
				<?php
				}
				?>
				</div>
			
			</div><!-- end of row -->
		</div><!-- end of container -->
	</section>
<?php
}
add_action( 'compact_one_enable_about_section', 'compact_one_enable_about_section_func' );
