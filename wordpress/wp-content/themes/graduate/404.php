<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Graduate
 */

get_header(); ?>
<div class="container page-section">
	<section class="error-404 not-found">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/404-300.png" alt="<?php _e( '404', 'graduate' ); ?>">
		<header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'graduate' ); ?></h1>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'graduate' ); ?></p>
			<?php
				get_search_form();
			?>
		</div><!-- .entry-content -->
	</section><!-- .error-404 -->
</div><!--.container-->
<?php
get_footer();
