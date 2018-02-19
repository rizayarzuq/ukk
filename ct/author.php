<?php
/**
 * The template for displaying author pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CT Corporate
 */

get_header();
// Boxed or Fullwidth
$boxedornot = ct_corporate_boxedornot();

$sidebar_layout = get_theme_mod('layout_picker');

$sidebar_class = ct_corporate_check_sidebar();
?>

	<?php  ct_corporate_breadcrumb(); ?>
	<!-- End the breadcrumb -->

	<?php if ($boxedornot == 'fullwidth') {?>
		<!-- Start the container. If full width layout is selected in the Customizer.-->
        <div class="container full-width-container">
    <?php }?>

	<?php if ($boxedornot == 'fullwidth') {?>
		<!-- Start the container -->
        <div class="container full-width-container">
    <?php }?>
	<?php if(!empty($sidebar_layout)){ ?>
		<div id="primary" class="content-area <?php echo esc_attr( $sidebar_class ); ?>">
	<?php } else { ?>
		<div id="primary" class="content-area">
	<?php } ?>

		<main id="main" class="site-main author-page" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="post-author">

				<div class="author-img text-center">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 );?>
				</div>

				<div class="author-desc">

					<h5><?php esc_html_e('Article By','ct-corporate'); ?> <a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"><?php the_author_meta('display_name'); ?></a></h5>
					<p><?php the_author_meta('description'); ?></p>

					<div class="author-links">
								<?php
									$author_id = get_the_author_meta('ID');
                                    $user_info = get_userdata($author_id);
                                    $author_url = $user_info->user_url;

								$author_url = preg_replace('#^https?://#', '', rtrim($author_url,'/'));

								if (!empty($author_url)) : ?>

									<a class="upper author-link-website" title="<?php esc_html_e('Author website','ct-corporate'); ?>" href="<?php echo esc_url($author_url); ?>"><i class="fa fa-globe"></i> <?php esc_html_e('Author website','ct-corporate'); ?></a>

								<?php endif;

								$author_mail = get_the_author_meta('email');

								$show_mail = get_the_author_meta('showemail');

								if ( !empty($author_mail) && ($show_mail == "yes") ) : ?>

									<a class="upper author-link-mail" title="<?php echo esc_attr($author_mail); ?>" href="mailto:<?php echo esc_attr(antispambot($author_mail)); ?>"><?php echo esc_html($author_mail); ?></a>

								<?php endif; ?>
					</div>
					<!-- Author-links -->

				</div>
				<!-- Author Desc -->
			</div>
			<!-- Post Author -->
			<!-- End the Post Author -->

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php
							get_template_part( 'template-parts/content', get_post_format() );
						?>
					</div>
				    <!-- End Entry-content -->

				    <footer class="entry-footer clearfix">
				        <?php ct_corporate_entry_footer(); ?>
				    </footer>
				    <!-- End Entry Footer -->

				</article>
				<!-- End Article Post -->

			<?php endwhile; ?>

			<?php ct_corporate_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main>
		<!-- End the #main -->
	</div>
	<!-- End the #primary -->
	<?php
		if(!empty($sidebar_layout)){
			 if( ($sidebar_layout == 2) || ($sidebar_layout == 3)) {  ?>
				<?php if( $sidebar_layout == 2) { $sidebar = "left-sidebar";}  if( $sidebar_layout == 3) { $sidebar = "right-sidebar";} ?>
		   		 <div id="secondary" class="widget-area clearfix <?php echo esc_attr( $sidebar ); ?>" role="complementary">
					<?php get_sidebar();?>
				</div>
	<?php }  }  else{ ?>
		<div id="secondary" class="widget-area clearfix right-sidebar" role="complementary">
			<?php get_sidebar();?>
		</div>
	<?php } ?>

	<?php if ($boxedornot == 'fullwidth') {?>
        </div>
		<!-- End the container.-->
    <?php }?>

<?php get_footer();