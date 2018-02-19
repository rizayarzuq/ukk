<?php
/**
 * The template part for displaying single posts.
 *
 * @package compact-one
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php cyberchimps_featured_image(); ?>
	<div class="entry-meta">
		<ul class="s_post_details">
			<?php compact_one_posted_by(); ?>
			<?php compact_one_posted_on(); ?>
			<?php compact_one_posted_in(); ?>
			<?php compact_one_post_comments(); ?>
			<?php cyberchimps_post_tags(); ?>
		</ul>
	</div><!-- .entry-meta -->
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title post_title_single"><span><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span></h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'compact-one' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);
		?>

		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'compact-one' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'compact-one' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
