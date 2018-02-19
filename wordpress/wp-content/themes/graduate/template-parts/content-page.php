<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graduate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
	$header_image_meta = graduate_header_image_meta_option();
	if ( ! $header_image_meta || is_front_page() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="0.3s">
		<?php if ( is_array( $header_image_meta ) ) {
			$header_image_meta = $header_image_meta[1];
		} 
		if ( 'show-both' == $header_image_meta || false == $header_image_meta ) { ?>
			<div class="blog-image">
				<?php the_post_thumbnail( 'full', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
			</div>
		<?php } 
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'graduate' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'graduate' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
