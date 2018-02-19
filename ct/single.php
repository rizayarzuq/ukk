<?php
/**
 * The template for displaying all single posts.
 *
 * @package CT Corporate
 */

get_header();
// Boxed or Fullwidth
$boxedornot = ct_corporate_boxedornot();

$sidebar_layout = get_theme_mod('layout_picker');

$sidebar_class = ct_corporate_check_sidebar();

?>

	<?php ct_corporate_breadcrumb(); ?>
	<!-- End the Breadcrumb -->

	<?php if ($boxedornot == 'fullwidth') {?>
		<!-- Start the container -->
        <div class="container full-width-container">
    <?php }?>
	<?php if(!empty($sidebar_layout)){ ?>
		<div id="primary" class="content-area <?php echo esc_attr($sidebar_class); ?>">
	<?php } else { ?>
		<div id="primary" class="content-area">
	<?php } ?>
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'single' ); ?>

					<?php ct_corporate_post_navigation(); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main>
			<!-- End #main -->
		</div>
		<!-- End #primary -->

	<?php
		if(!empty($sidebar_layout)){
			 if( ($sidebar_layout == 2) || ($sidebar_layout == 3)) {  ?>
				<?php if( $sidebar_layout == 2) { $sidebar = "left-sidebar";}  if( $sidebar_layout == 3) { $sidebar = "right-sidebar";} ?>
		   		 <div id="secondary" class="widget-area clearfix <?php echo esc_attr($sidebar); ?>" role="complementary">
					<?php get_sidebar();?>
				</div>
	<?php }  }  else{ ?>
		<div id="secondary" class="widget-area clearfix right-sidebar" role="complementary">
			<?php get_sidebar();?>
		</div>
	<?php } ?>

	<?php if ($boxedornot == 'fullwidth') {?>
        </div>
        <!-- End the Container -->
    <?php }?>

<?php get_footer(); ?>