<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

?>

<section class="no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'graduate' ); ?></h1>
	</header><!-- .page-header -->

	<div class="entry-content wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'graduate' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'graduate' ); ?></p>

			<div class="widget widget_search">
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'graduate' ); ?></p>

			<div class="widget widget_search">
				<?php
					get_search_form();
		endif; ?>
			</div><!-- .widget_search -->
	</div><!-- .entry-content -->
</section><!-- .no-results -->
